<?php

namespace Modules\Zoom\Http\Controllers;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Modules\VirtualClass\Entities\VirtualClass;
use Modules\Zoom\Entities\ZoomMeeting;
use Modules\Zoom\Entities\ZoomMeetingUser;
use Modules\Zoom\Entities\ZoomSetting;
use Zoom;

class MeetingController extends Controller
{
    public function __construct()
    {
        Artisan::call('config:clear');
    }

    /**
     * Display a listing of the resource.
     * @return Application|Factory|RedirectResponse|View
     */
    public function about()
    {
        $module = 'Zoom';

        return $module;
    }

    public function index()
    {

        $data = $this->defaultPageData();
        $data['user'] = Auth::user();
        $data['instructors'] = User::select('id', 'name')->where('role_id', 2)->get();
        $data['classes'] = VirtualClass::select('id', 'title')->where('host', 'Zoom')->where('type', 1)->latest()->get();
        return view('zoom::meeting.meeting', $data);
    }

    private function defaultPageData()
    {
        $user = Auth::user();
        $data['default_settings'] = ZoomSetting::firstOrCreate([
            'user_id' => $user->id
        ], [
            '$user->id' => $user->id,
        ]);


        if (Auth::user()->role_id == 1) {
            $data['meetings'] = ZoomMeeting::orderBy('id', 'DESC')->get();
        } else {
            $data['meetings'] = ZoomMeeting::orderBy('id', 'DESC')->whereHas('participates', function ($query) {
                return $query->where('user_id', Auth::user()->id);
            })
                ->where('status', 1)
                ->get();
        }
        return $data;
    }

    public function meetingStart($id)
    {

        try {
            $meeting = ZoomMeeting::where('meeting_id', $id)->first();
            if (!$meeting->currentStatus == 'started') {
                Toastr::error('Class not yet start, try later', 'Failed');
                return redirect()->back();
            }
            if (!$meeting->currentStatus == 'closed') {
                Toastr::error('Class are closed', 'Failed');
                return redirect()->back();
            }


            return redirect($meeting->url . '?pwd=' . $meeting->password);

        } catch (Exception $e) {
            Toastr::error($e->getMessage(), trans('common.Failed'));
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {

        $instructor_id = $request->get('instructor_id');
        $class_id = $request->get('class_id');

        $request->validate([

            'class_id' => 'required',
            'instructor_id' => 'required',
            'topic' => 'required',
            'description' => 'nullable',
            'password' => 'required',
            'attached_file' => 'nullable|mimes:jpeg,png,jpg,doc,docx,pdf,xls,xlsx',
            'time' => 'required',
            'durration' => 'required',
            'join_before_host' => 'required',
            'host_video' => 'required',
            'participant_video' => 'required',
            'mute_upon_entry' => 'required',
            'waiting_room' => 'required',
            'audio' => 'required',
            'auto_recording' => 'nullable',
            'approval_type' => 'required',
            'is_recurring' => 'required',
            'recurring_type' => 'required_if:is_recurring,1',
            'recurring_repect_day' => 'required_if:is_recurring,1',
            'recurring_end_date' => 'required_if:is_recurring,1',
        ]);

        try {
            //Available time check for classs
            if ($this->isTimeAvailableForMeeting($request, $id = 0)) {
                Toastr::error('Virtual class time is not available for teacher and student!', 'Failed');
                return redirect()->back();
            }

            //Chekc the number of api request by today max limit 100 request
            if (ZoomMeeting::whereDate('created_at', Carbon::now())->count('id') >= 100) {
                Toastr::error('You can not create more than 100 meeting within 24 hour!', 'Failed');
                return redirect()->back();
            }


            $users = Zoom::user()->where('status', 'active')->setPaginate(false)->setPerPage(300)->get()->toArray();

            $profile = $users['data'][0];
            $start_date = Carbon::parse($request['date'])->format('Y-m-d') . ' ' . date("H:i:s", strtotime($request['time']));
            $meeting = Zoom::meeting()->make([
                "topic" => $request['topic'],
                "type" => $request['is_recurring'] == 1 ? 8 : 2,
                "duration" => $request['durration'],
                "timezone" => config('app.timezone'),
                "password" => $request['password'],
                "start_time" => new Carbon($start_date),
            ]);

            $meeting->settings()->make([
                'join_before_host' => $this->setTrueFalseStatus($request['join_before_host']),
                'host_video' => $this->setTrueFalseStatus($request['host_video']),
                'participant_video' => $this->setTrueFalseStatus($request['participant_video']),
                'mute_upon_entry' => $this->setTrueFalseStatus($request['mute_upon_entry']),
                'waiting_room' => $this->setTrueFalseStatus($request['waiting_room']),
                'audio' => $request['audio'],
                'auto_recording' => $request->has('auto_recording') ? $request['auto_recording'] : 'none',
                'approval_type' => $request['approval_type'],
            ]);

            if ($request['is_recurring'] == 1) {
                $end_date = Carbon::parse($request['recurring_end_date'])->endOfDay();
                $meeting->recurrence()->make([
                    'type' => $request['recurring_type'],
                    'repeat_interval' => $request['recurring_repect_day'],
                    'end_date_time' => $end_date
                ]);
            }
            $meeting_details = Zoom::user()->find($profile['id'])->meetings()->save($meeting);

            DB::beginTransaction();
            $fileName = "";
            if ($request->file('attached_file') != "") {
                $file = $request->file('attached_file');
                $fileName = $request['topic'] . time() . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/zoom-meeting/', $fileName);
                $fileName = 'public/uploads/zoom-meeting/' . $fileName;
            }
            $system_meeting = ZoomMeeting::create([
                'topic' => $request['topic'],
                'instructor_id' => $instructor_id,
                'class_id' => $class_id,
                'description' => $request['description'],
                'date_of_meeting' => $request['date'],
                'time_of_meeting' => $request['time'],
                'meeting_duration' => $request['durration'],

                'host_video' => $request['host_video'],
                'participant_video' => $request['participant_video'],
                'join_before_host' => $request['join_before_host'],
                'mute_upon_entry' => $request['mute_upon_entry'],
                'waiting_room' => $request['waiting_room'],
                'audio' => $request['audio'],
                'auto_recording' => $request->has('auto_recording') ? $request['auto_recording'] : 'none',
                'approval_type' => $request['approval_type'],

                'is_recurring' => $request['is_recurring'],
                'recurring_type' => $request['is_recurring'] == 1 ? $request['recurring_type'] : null,
                'recurring_repect_day' => $request['is_recurring'] == 1 ? $request['recurring_repect_day'] : null,
                'recurring_end_date' => $request['is_recurring'] == 1 ? $request['recurring_end_date'] : null,
                'meeting_id' => $meeting_details->id,
                'password' => $meeting_details->password,
                'start_time' => Carbon::parse($start_date)->toDateTimeString(),
                'end_time' => Carbon::parse($start_date)->addMinute($request['durration'])->toDateTimeString(),
                'attached_file' => $fileName,
                'created_by' => Auth::user()->id,
            ]);


            $user = new ZoomMeetingUser();
            $user->meeting_id = $system_meeting->id;
            $user->user_id = $instructor_id;
            $user->host = 1;
            $user->save();

            DB::commit();

            if ($system_meeting) {
                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->back();
            } else {
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
            }
        } catch (Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    private function isTimeAvailableForMeeting($request, $id)
    {

        if (isset($request['participate_ids'])) {
            $teacherList = $request['participate_ids'];
        } else {
            $teacherList = [Auth::user()->id];
        }

        if ($id != 0) {
            $meetings = ZoomMeeting::where('date_of_meeting', Carbon::parse($request['date'])->format("m/d/Y"))
                ->where('id', '!=', $id)
                ->whereHas('participates', function ($q) use ($teacherList) {
                    $q->whereIn('user_id', $teacherList);
                })
                ->get();
        } else {
            $meetings = ZoomMeeting::where('date_of_meeting', Carbon::parse($request['date'])->format("m/d/Y"))
                ->whereHas('participates', function ($q) use ($teacherList) {
                    $q->whereIn('user_id', $teacherList);
                })
                ->get();
        }
        if ($meetings->count() == 0) {
            return false;
        }
        $checkList = [];

        foreach ($meetings as $key => $meeting) {
            $new_time = Carbon::parse($request['date'] . ' ' . date("H:i:s", strtotime($request['time'])));
            if ($new_time->between(Carbon::parse($meeting->start_time), Carbon::parse($meeting->end_time))) {
                array_push($checkList, $meeting->time_of_meeting);
            }
        }
        if (count($checkList) > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function setTrueFalseStatus($value)
    {
        if ($value == 1) {
            return true;
        }
        return false;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function show($id)
    {

        try {
            $localMeetingData = ZoomMeeting::where('meeting_id', $id)->first();

            $results = Zoom::meeting()->find($id)->toArray();

            if ($results) {
                return view('zoom::meeting.meetingDetails', compact('localMeetingData', 'results'));
            } else {
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
            }
        } catch (Exception $e) {
            Toastr::error($e->getMessage(), trans('common.Failed'));
            return redirect()->back();
        }

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function edit($id)
    {

        try {
            $data = $this->defaultPageData();
            $data['editdata'] = ZoomMeeting::findOrFail($id);
            $data['user'] = Auth::user();
            $data['classes'] = VirtualClass::select('id', 'title')->where('host', 'Zoom')->latest()->get();
            $data['instructors'] = User::select('id', 'name')->whereIn('role_id', [1, 2])->get();
            $data['participate_ids'] = DB::table('zoom_meeting_users')->where('meeting_id', $id)->select('user_id')->pluck('user_id');

            $data['user_type'] = $data['editdata']->participates[0]['role_id'];
            $data['userList'] = User::where('role_id', $data['user_type'])
                ->whereIn('id', $data['participate_ids'])
                ->select('id', 'name', 'role_id')->get();
            if (Auth::user()->role_id != 1) {
                if (Auth::user()->id != $data['editdata']->created_by) {
                    Toastr::error('Class is created by other, you could not modify !', 'Failed');
                    return redirect()->back();
                }
            }
            return view('zoom::meeting.meeting', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage(), trans('common.Failed'));
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'instructor_id' => 'required',
            'class_id' => 'required',
            'topic' => 'required',
            'description' => 'nullable',
            'password' => 'required',
            'attached_file' => 'nullable|mimes:jpeg,png,jpg,doc,docx,pdf,xls,xlsx',
            'time' => 'required',
            'durration' => 'required',
            'join_before_host' => 'required',
            'host_video' => 'required',
            'participant_video' => 'required',
            'mute_upon_entry' => 'required',
            'waiting_room' => 'required',
            'audio' => 'required',
            'auto_recording' => 'nullable',
            'approval_type' => 'required',
            'is_recurring' => 'required',
            'recurring_type' => 'required_if:is_recurring,1',
            'recurring_repect_day' => 'required_if:is_recurring,1',
            'recurring_end_date' => 'required_if:is_recurring,1',
        ]);

        try {
            $system_meeting = ZoomMeeting::findOrFail($id);

            if ($this->isTimeAvailableForMeeting($request, $id = $id)) {
                Toastr::error('Virtual class time is not available !', 'Failed');
                return redirect()->back();
            }

            $users = Zoom::user()->where('status', 'active')->setPaginate(false)->setPerPage(300)->get()->toArray();
            $profile = $users['data'][0];
            $start_date = Carbon::parse($request['date'])->format('Y-m-d') . ' ' . date("H:i:s", strtotime($request['time']));

            $meeting = Zoom::meeting()->find($system_meeting->meeting_id)->make([
                "topic" => $request['topic'],
                "type" => $request['is_recurring'] == 1 ? 8 : 2,
                "duration" => $request['durration'],
                "timezone" => config('app.timezone'),
                "start_time" => new Carbon($start_date),
                "password" => $request['password'],
            ]);

            $meeting->settings()->make([
                'join_before_host' => $this->setTrueFalseStatus($request['join_before_host']),
                'host_video' => $this->setTrueFalseStatus($request['host_video']),
                'participant_video' => $this->setTrueFalseStatus($request['participant_video']),
                'mute_upon_entry' => $this->setTrueFalseStatus($request['mute_upon_entry']),
                'waiting_room' => $this->setTrueFalseStatus($request['waiting_room']),
                'audio' => $request['audio'],
                'auto_recording' => $request->has('auto_recording') ? $request['auto_recording'] : 'none',
                'approval_type' => $request['approval_type'],
            ]);

            if ($request['is_recurring'] == 1) {
                $end_date = Carbon::parse($request['recurring_end_date'])->endOfDay();
                $meeting->recurrence()->make([
                    'type' => $request['recurring_type'],
                    'repeat_interval' => $request['recurring_repect_day'],
                    'end_date_time' => $end_date
                ]);
            }

            Zoom::user()->find($profile['id'])->meetings()->save($meeting);

            DB::beginTransaction();

            $system_meeting->update([
                'instructor_id' => $request['instructor_id'],
                'class_id' => $request['class_id'],
                'topic' => $request['topic'],
                'description' => $request['description'],
                'date_of_meeting' => $request['date'],
                'time_of_meeting' => $request['time'],
                'meeting_duration' => $request['durration'],
                'password' => $request['password'],

                'host_video' => $request['host_video'],
                'participant_video' => $request['participant_video'],
                'join_before_host' => $request['join_before_host'],
                'mute_upon_entry' => $request['mute_upon_entry'],
                'waiting_room' => $request['waiting_room'],
                'audio' => $request['audio'],
                'auto_recording' => $request->has('auto_recording') ? $request['auto_recording'] : 'none',
                'approval_type' => $request['approval_type'],

                'is_recurring' => $request['is_recurring'],
                'recurring_type' => $request['is_recurring'] == 1 ? $request['recurring_type'] : null,
                'recurring_repect_day' => $request['is_recurring'] == 1 ? $request['recurring_repect_day'] : null,
                'recurring_end_date' => $request['is_recurring'] == 1 ? $request['recurring_end_date'] : null,


                'start_time' => Carbon::parse($start_date)->toDateTimeString(),
                'end_time' => Carbon::parse($start_date)->addMinute($request['durration'])->toDateTimeString(),
                'updated_by' => Auth::user()->id,
            ]);

            if ($request->file('attached_file') != "") {
                if (file_exists($system_meeting->attached_file)) {
                    unlink($system_meeting->attached_file);
                }
                $file = $request->file('attached_file');
                $fileName = $request['topic'] . time() . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/zoom-meeting/', $fileName);
                $fileName = 'public/uploads/zoom-meeting/' . $fileName;
                $system_meeting->update([
                    'attached_file' => $fileName
                ]);
            }

            ZoomMeetingUser::where('meeting_id', $id)->delete();


            DB::commit();
            Toastr::success('Class updated successful', 'Success');
            return redirect()->route('zoom.meetings');

        } catch (Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $localMeeting = ZoomMeeting::findOrFail($id);
            if (Auth::user()->role_id != 1) {
                if (Auth::user()->id != $localMeeting->created_by) {
                    Toastr::error('Class is created by other, you could not DELETE !', 'Failed');
                    return redirect()->back();
                }
            }

            $meeting = Zoom::meeting();
            $meeting->find($localMeeting->meeting_id);
            $meeting->delete(true);

           if (file_exists($localMeeting->attached_file)) {
                unlink($localMeeting->attached_file);
            }
            ZoomMeetingUser::where('meeting_id', $id)->delete();
            $localMeeting->delete();
            Toastr::success('Class deleted successful', 'Success');
            return redirect()->route('zoom.meetings');
        } catch (Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function userWiseUserList(Request $request)
    {
        if ($request->has('user_type')) {
            $userList = User::where('role_id', $request['user_type'])
                ->select('id', 'name')->get();
            return response()->json([
                'users' => $userList
            ]);
        }
    }

    private function setNotificaiton($users, $role_id, $updateStatus)
    {
        $now = Carbon::now('utc')->toDateTimeString();
        $notification_datas = [];

        if ($updateStatus == 1) {
            foreach ($users as $key => $user) {
                array_push(
                    $notification_datas,
                    [
                        'user_id' => $user,
                        'role_id' => $role_id,
                        'date' => date('Y-m-d'),
                        'message' => 'Zoom meeting is updated by ' . Auth::user()->name . '',
                        'url' => route('zoom.meetings'),
                        'created_at' => $now,
                        'updated_at' => $now
                    ]
                );
            }
        } else {
            foreach ($users as $key => $user) {
                array_push(
                    $notification_datas,
                    [
                        'user_id' => $user,
                        'role_id' => $role_id,
                        'date' => date('Y-m-d'),
                        'message' => 'Zoom meeting is created by ' . Auth::user()->name . ' with you',
                        'url' => route('zoom.meetings'),
                        'created_at' => $now,
                        'updated_at' => $now
                    ]
                );
            }
        }

    }
}
