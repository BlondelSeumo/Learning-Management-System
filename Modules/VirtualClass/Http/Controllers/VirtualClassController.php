<?php

namespace Modules\VirtualClass\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use JoisarJignesh\Bigbluebutton\Facades\Bigbluebutton;
use MacsiDigital\Zoom\Facades\Zoom;
use Modules\BBB\Entities\BbbMeeting;
use Modules\BBB\Entities\BbbMeetingUser;
use Modules\CourseSetting\Entities\Category;
use Modules\CourseSetting\Entities\Course;
use Modules\Jitsi\Entities\JitsiMeeting;
use Modules\Jitsi\Entities\JitsiMeetingUser;
use Modules\Localization\Entities\Language;
use Modules\VirtualClass\Entities\ClassSetting;
use Modules\VirtualClass\Entities\VirtualClass;
use Modules\Zoom\Entities\ZoomMeeting;
use Modules\Zoom\Entities\ZoomMeetingUser;
use Modules\Zoom\Entities\ZoomSetting;

class VirtualClassController extends Controller
{
    public function index()
    {
        $data = [
            'languages' => Language::where('status', 1)->get(),
            'classes' => VirtualClass::all(),
            'categories' => Category::all(),
        ];

        return view('virtualclass::class.index')->with($data);
    }

    public function create()
    {
        return view('virtualclass::create');
    }

    public function store(Request $request)
    {


        $request->validate([
            'title' => 'required',
            'duration' => 'required',
            'category' => 'required',
            'lang_id' => 'required',
            'sub_category' => 'required',
            'type' => 'required',
            'host' => 'required',
            'start_date' => 'required',
            'end_date' => 'required_if:type,==,1',
            'image' => 'required',
        ]);

        try {

            $class = new VirtualClass();
            $class->title = $request->title;
            $class->fees = $request->free ? 0 : $request->fees;
            $class->duration = $request->duration;
            $class->category_id = $request->category;
            $class->sub_category_id = $request->sub_category;
            $class->type = $request->type;
            $class->host = $request->host;
            $class->lang_id = $request->lang_id;

            if (!empty($request->start_date)) {
                $class->start_date = date('Y-m-d', strtotime($request->start_date));
            }
            if (!empty($request->end_date)) {
                $class->end_date = date('Y-m-d', strtotime($request->end_date));

            }
            if (!empty($request->time)) {
                $class->time = date("H:i", strtotime($request->time));
            }


            if ($request->file('image') != "") {

                $name = md5($request->title . rand(0, 1000)) . '.' . 'png';
                $img = Image::make($request->image);
//                $img->resize(800, 500);
                $upload_path = 'public/uploads/courses/';
                $img->save($upload_path . $name);
                $class->image = 'public/uploads/courses/' . $name;
            }

            $class->save();
            $course = new Course();
            $course->class_id = $class->id;
            $course->user_id = Auth::id();
            $course->lang_id = $request->lang_id;
            $course->price = $request->free ? 0 : $request->fees;
            $course->title = $request->title;
            $course->slug = Str::slug($request->title) == "" ? str_replace(' ','-',$request->title) : Str::slug($request->title);
            if ($request->file('image') != "") {

                $name = md5($request->title . rand(0, 1000)) . '.' . 'png';
                $img = Image::make($request->image);

                $upload_path = 'public/uploads/courses/';
                $img->save($upload_path . $name);
                $course->image = 'public/uploads/courses/' . $name;


                $name = md5($request->title . rand(0, 1000)) . '.' . 'png';
                $img = Image::make($request->image);

                $upload_path = 'public/uploads/courses/';
                $img->save($upload_path . $name);
                $course->thumbnail = 'public/uploads/courses/' . $name;
            }
            $course->type = 3;
            $course->save();


            Toastr::success('Class has been created. Please Create Live Class Event', 'Success!');

            if ($class->host == "Zoom") {
                if ($class->type == 0) {
                    $hasAlready = ZoomMeeting::where('class_id', $class->id)->first();
                    if ($hasAlready) {
                        Toastr::error("Already Assign a meeting", 'Error!');
                        return back();
                    } else {
                        return redirect()->route('virtual-class.createMeeting', $class->id);
                        // zoom meeting create page
                    }
                } else {
                    return redirect()->route('virtual-class.createMeeting', $class->id);
                }
            } elseif ($class->host == "BBB") {
                if (moduleStatusCheck('BBB')) {
                    if ($class->type == 0) {
                        $hasAlready = BbbMeeting::where('class_id', $class->id)->first();

                        if ($hasAlready) {
                            Toastr::error("Already Assign a meeting", 'Error!');
                            return back();
                        } else {
                            return redirect()->route('virtual-class.createMeeting', $class->id);
                            // BBB meeting create page
                        }
                    } else {
                        return redirect()->route('virtual-class.createMeeting', $class->id);
                    }
                } else {
                    Toastr::error('Module not installed yet', 'Error!');

                }

            } elseif ($class->host == "Jitsi") {

                if (moduleStatusCheck('Jitsi')) {
                    if ($class->type == 0) {
                        $hasAlready = JitsiMeeting::where('class_id', $class->id)->first();

                        if ($hasAlready) {
                            Toastr::error("Already Assign a meeting", 'Error!');
                            return back();
                        } else {
                            return redirect()->route('virtual-class.createMeeting', $class->id);
                            // BBB meeting create page
                        }
                    } else {
                        return redirect()->route('virtual-class.createMeeting', $class->id);
                    }
                } else {
                    Toastr::error('Module not installed yet', 'Error!');

                }

            }
            return back();
        } catch (Exception $e) {
            Toastr::error(trans('common.Something Went Wrong'), 'Error!');
            return back();
        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('virtualclass::show');
    }

    public function edit($id)
    {
        $data = [
            'languages' => Language::where('status', 1)->get(),
            'classes' => VirtualClass::all(),
            'class' => VirtualClass::find($id),
            'categories' => Category::all(),
        ];
        return view('virtualclass::class.index')->with($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'duration' => 'required',
            'category' => 'required',
            'sub_category' => 'required',
            'type' => 'required',
            'date' => 'required_if:type,==,0',
            'start_date' => 'required_if:type,==,1',
            'end_date' => 'required_if:type,==,1',
        ]);

        try {
            $class = VirtualClass::find($id);
            $class->title = $request->title;
            $class->duration = $request->duration;
            $class->category_id = $request->category;
            $class->sub_category_id = $request->sub_category;
            $class->fees = $request->free ? 0 : $request->fees;
            $class->type = $request->type;

            if (!empty($request->start_date)) {
                $class->start_date = date('Y-m-d', strtotime($request->start_date));
            }
            if (!empty($request->end_date)) {
                $class->end_date = date('Y-m-d', strtotime($request->end_date));

            }
            if (!empty($request->time)) {
                $class->time = date("H:i", strtotime($request->time));
            }

            if ($request->file('image') != "") {

                $name = md5($request->title . rand(0, 1000)) . '.' . 'png';
                $img = Image::make($request->image);
//                $img->resize(800, 500);
                $upload_path = 'public/uploads/courses/';
                $img->save($upload_path . $name);
                $class->image = 'public/uploads/courses/' . $name;

            }
            $class->save();

            $course = Course::where('class_id', $id)->where('type', 3)->first();
            $course->user_id = Auth::id();
            $course->lang_id = 1;
            $course->title = $request->title;
            $course->slug = Str::slug($request->title) == "" ? str_replace(' ','-',$request->title) : Str::slug($request->title);
            if ($request->file('image') != "") {

                $name = md5($request->title . rand(0, 1000)) . '.' . 'png';
                $img = Image::make($request->image);
//                $img->resize(800, 500);
                $upload_path = 'public/uploads/courses/';
                $img->save($upload_path . $name);
                $course->image = 'public/uploads/courses/' . $name;


                $name = md5($request->title . rand(0, 1000)) . '.' . 'png';
                $img = Image::make($request->image);
//                $img->resize(270, 181);
                $upload_path = 'public/uploads/courses/';
                $img->save($upload_path . $name);
                $course->thumbnail = 'public/uploads/courses/' . $name;
            }
            $course->save();

            Toastr::success('Class has been Updated', 'Success!');
            return redirect()->route('virtual-class.index');
        } catch (Exception $e) {

            Toastr::error(trans('common.Something Went Wrong'), 'Error!');
            return back();
        }
    }

    public function destroy($id)
    {

        try {

            $class = VirtualClass::find($id);
            if ($class->host == "BBB") {
                if (moduleStatusCheck('BBB')) {
                    $bbbClass = BbbMeeting::where('class_id', $id)->get();
                    $bbbClass->each->delete();
                }
            } elseif ($class->host == 'Zoom') {
                $zoomClass = ZoomMeeting::where('class_id', $id)->get();

                foreach ($zoomClass as $cls) {
                    $meeting = Zoom::meeting()->find($cls->meeting_id);
                    $meeting->delete();
                    $cls->delete();
                }
            }elseif ($class->host == 'Jitsi') {
                if (moduleStatusCheck('Jitsi')) {
                    $JitsiClass = JitsiMeeting::where('class_id', $id)->get();
                    $JitsiClass->each->delete();
                }
            }
            $course = Course::where('class_id', $id)->first();
            $course->delete();
            $class->delete();

            Toastr::success('Class has been Deleted', 'Success!');

            return back();
        } catch (Exception $e) {

            Toastr::error(trans('common.Something Went Wrong'), 'Error!');
            return back();
        }
    }

    public function setting(Request $request)
    {
        $setting = ClassSetting::first();

        return view('virtualclass::class.class_setup', compact('setting'));
    }

    public function settingUpdate(Request $request)
    {
        $setting = ClassSetting::first();
        $setting->default_class = $request->class;
        $setting->save();

        Toastr::success('Class Settings Has been Update Successfully');
        return back();
    }

    public function details($id)
    {

        $class = VirtualClass::findOrFail($id);
        $currency = getSetting()->currency;
        $user = Auth::user();
        return view('virtualclass::class.class_details', compact('class', 'currency', 'user'));
    }

    public function createMeeting($id)
    {

        $class = VirtualClass::findOrFail($id);

        if ($class->host == "Zoom") {
            $data = $this->defaultPageData();
            $data['user'] = Auth::user();
            $data['class'] = $class;
            return view('virtualclass::meeting.zoom_meeting', $data);
        } elseif ($class->host == "BBB") {
            if (!moduleStatusCheck('BBB')) {
                Toastr::error('Module not installed yet.', 'Error!');
                return back();
            }
            $data['env']['security_salt'] = config('bigbluebutton.BBB_SECURITY_SALT');
            $data['env']['server_base_url'] = config('bigbluebutton.BBB_SERVER_BASE_URL');
            $data['class'] = $class;
            return view('virtualclass::meeting.bbb_meeting', $data);
        } elseif ($class->host == "Jitsi") {
            if (!moduleStatusCheck('Jitsi')) {
                Toastr::error('Module not installed yet.', 'Error!');
                return back();
            }
            $data['env']['security_salt'] = config('bigbluebutton.BBB_SECURITY_SALT');
            $data['env']['server_base_url'] = config('bigbluebutton.BBB_SERVER_BASE_URL');
            $data['class'] = $class;
            return view('virtualclass::meeting.jitsi_meeting', $data);
        } else {
            Toastr::error(trans('common.Something Went Wrong'), 'Error!');
            return back();
        }
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

    public function createMeetingStore(Request $request, $class_id)
    {
        $class = VirtualClass::findOrFail($class_id);

        if ($class->type == 0) {
            if (strtotime($class->start_date) != strtotime($request->date)) {
                Toastr::error("Date is not correct", 'Error!');
                return back();
            }
        } else {
            if (strtotime($class->start_date) > strtotime($request->date) || (strtotime($request->date) > strtotime($class->end_date))) {
                Toastr::error("Date is not correct", 'Error!');
                return back();
            }
        }


        $instructor_id = Auth::user()->id;
        $request->validate([
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
                Toastr::error('Virtual class time is not available for teacher!', 'Failed');
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
                'class_id' => $class_id,
                'instructor_id' => $instructor_id,
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
                return redirect()->route('virtual-class.details', $class_id);
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

    public function bbbMeetingStore(Request $request, $class_id)
    {
        $class = VirtualClass::findOrFail($class_id);
        if ($class->type == 0) {
            if (strtotime($class->start_date) != strtotime($request->date)) {
                Toastr::error("Date is not correct", 'Error!');
                return back();
            }
        } else {
            if (strtotime($class->start_date) > strtotime($request->date) || (strtotime($request->date) > strtotime($class->end_date))) {
                Toastr::error("Date is not correct", 'Error!');
                return back();
            }
        }
        $topic = $request->get('topic');
        $instructor_id = Auth::user()->id;
        $attendee_password = $request->get('attendee_password');
        $moderator_password = $request->get('moderator_password');
        $date = $request->get('date');
        $time = $request->get('time');

        $welcome_message = $request->get('welcome_message');
        $dial_number = $request->get('dial_number');
        $max_participants = $request->get('max_participants');
        $logout_url = $request->get('logout_url');
        $record = $request->get('record');
        $duration = $request->get('duration');
        $is_breakout = $request->get('is_breakout');
        $moderator_only_message = $request->get('moderator_only_message');
        $auto_start_recording = $request->get('auto_start_recording');
        $allow_start_stop_recording = $request->get('allow_start_stop_recording');
        $webcams_only_for_moderator = $request->get('webcams_only_for_moderator');
        $copyright = $request->get('copyright');
        $mute_on_start = $request->get('mute_on_start');
        $lock_settings_disable_mic = $request->get('lock_settings_disable_mic');
        $lock_settings_disable_private_chat = $request->get('lock_settings_disable_private_chat');
        $lock_settings_disable_public_chat = $request->get('lock_settings_disable_public_chat');
        $lock_settings_disable_note = $request->get('lock_settings_disable_note');
        $lock_settings_locked_layout = $request->get('lock_settings_locked_layout');
        $lock_settings_lock_on_join = $request->get('lock_settings_lock_on_join');
        $lock_settings_lock_on_join_configurable = $request->get('lock_settings_lock_on_join_configurable');
        $guest_policy = $request->get('guest_policy');
        $redirect = $request->get('redirect');
        $join_via_html5 = $request->get('join_via_html5');
        $state = $request->get('state');
        $datetime = $date . " " . $time;
        $datetime = strtotime($datetime);

        $request->validate([
            'topic' => 'required',
            'attendee_password' => 'required',
            'moderator_password' => 'required',
            'date' => 'required',
            'time' => 'required',

        ]);


        try {


            $createMeeting = Bigbluebutton::create([
                'meetingID' => "spn-" . date('ymd' . rand(0, 100)),
                'meetingName' => $topic,
                'attendeePW' => $attendee_password,
                'moderatorPW' => $moderator_password,
                'welcomeMessage' => $welcome_message,
                'dialNumber' => $dial_number,
                'maxParticipants' => $max_participants,
                'logoutUrl' => $logout_url,
                'record' => $record,
                'duration' => $duration,
                'isBreakout' => $is_breakout,
                'moderatorOnlyMessage' => $moderator_only_message,
                'autoStartRecording' => $auto_start_recording,
                'allowStartStopRecording' => $allow_start_stop_recording,
                'webcamsOnlyForModerator' => $webcams_only_for_moderator,
                'copyright' => $copyright,
                'muteOnStart' => $mute_on_start,
                'lockSettingsDisableMic' => $lock_settings_disable_mic,
                'lockSettingsDisablePrivateChat' => $lock_settings_disable_private_chat,
                'lockSettingsDisablePublicChat' => $lock_settings_disable_public_chat,
                'lockSettingsDisableNote' => $lock_settings_disable_note,
                'lockSettingsLockedLayout' => $lock_settings_locked_layout,
                'lockSettingsLockOnJoin' => $lock_settings_lock_on_join,
                'lockSettingsLockOnJoinConfigurable' => $lock_settings_lock_on_join_configurable,
                'guestPolicy' => $guest_policy,
                'redirect' => $redirect,
                'joinViaHtml5' => $join_via_html5,
                'state' => $state,
            ]);

            if ($createMeeting) {
                $local_meeting = BbbMeeting::create([
                    'meeting_id' => $createMeeting['meetingID'],
                    'instructor_id' => $instructor_id,
                    'topic' => $topic,
                    'description' => $request->get('description'),
                    'class_id' => $class_id,
                    'attendee_password' => $attendee_password,
                    'moderator_password' => $moderator_password,
                    'date' => $date,
                    'time' => $time,
                    'datetime' => $datetime,
                    'welcome_message' => $welcome_message,
                    'dial_number' => $dial_number,
                    'max_participants' => $max_participants,
                    'logout_url' => $logout_url,
                    'record' => $record,
                    'duration' => $duration,
                    'is_breakout' => $is_breakout,
                    'moderator_only_message' => $moderator_only_message,
                    'auto_start_recording' => $auto_start_recording,
                    'allow_start_stop_recording' => $allow_start_stop_recording,
                    'webcams_only_for_moderator' => $webcams_only_for_moderator,
                    'copyright' => $copyright,
                    'mute_on_start' => $mute_on_start,
                    'lock_settings_disable_mic' => $lock_settings_disable_mic,
                    'lock_settings_disable_private_chat' => $lock_settings_disable_private_chat,
                    'lock_settings_disable_public_chat' => $lock_settings_disable_public_chat,
                    'lock_settings_disable_note' => $lock_settings_disable_note,
                    'lock_settings_locked_layout' => $lock_settings_locked_layout,
                    'lock_settings_lock_on_join' => $lock_settings_lock_on_join,
                    'lock_settings_lock_on_join_configurable' => $lock_settings_lock_on_join_configurable,
                    'guest_policy' => $guest_policy,
                    'redirect' => $redirect,
                    'join_via_html5' => $join_via_html5,
                    'state' => $state,
                    'created_by' => Auth::user()->id,

                ]);
            }


            $user = new BbbMeetingUser();
            $user->meeting_id = $local_meeting->id;
            $user->user_id = $instructor_id;
            $user->moderator = 1;
            $user->save();


            Toastr::success('Class updated successful', 'Success');
            return redirect()->route('virtual-class.details', $class_id);
        } catch (Exception $e) {
            Toastr::error($e->getMessage(), trans('common.Failed'));
            return redirect()->back();
        }
    }


    public function jitsiMeetingStore(Request $request, $class_id)
    {
        $class = VirtualClass::findOrFail($class_id);

        if ($class->type == 0) {
            if (strtotime($class->start_date) != strtotime($request->date)) {
                Toastr::error("Date is not correct", 'Error!');
                return back();
            }
        } else {
            if (strtotime($class->start_date) > strtotime($request->date) || (strtotime($request->date) > strtotime($class->end_date))) {
                Toastr::error("Date is not correct", 'Error!');
                return back();
            }
        }
        $topic = $request->get('topic');
        $instructor_id = Auth::user()->id;
        $date = $request->get('date');
        $time = $request->get('time');


        $datetime = $date . " " . $time;
        $datetime = strtotime($datetime);

        $request->validate([
            'topic' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);


        try {
            $local_meeting = JitsiMeeting::create([
                'meeting_id' => date('ymdhmi'),
                'instructor_id' => $instructor_id,
                'topic' => $topic,
                'description' => $request->get('description'),
                'class_id' => $class_id,
                'date' => $date,
                'time' => $time,
                'datetime' => $datetime,
                'created_by' => Auth::user()->id,

            ]);

            $user = new JitsiMeetingUser();
            $user->meeting_id = $local_meeting->id;
            $user->user_id = $instructor_id;
            $user->save();


            Toastr::success('Class updated successful', 'Success');
            return redirect()->route('virtual-class.details', $class_id);
        } catch (Exception $e) {
            Toastr::error($e->getMessage(), trans('common.Failed'));
            return redirect()->back();
        }
    }
}
