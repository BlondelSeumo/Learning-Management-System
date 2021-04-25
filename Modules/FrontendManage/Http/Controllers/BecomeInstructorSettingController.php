<?php

namespace Modules\FrontendManage\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Image;
use Modules\FrontendManage\Entities\BecomeInstructor;
use Modules\FrontendManage\Entities\WorkProcess;

class BecomeInstructorSettingController extends Controller
{

    public function index()
    {
        try {
            $settings = BecomeInstructor::latest()->get();
            return view('frontendmanage::becomeInstructor', compact('settings'));

        } catch (Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function allWork()
    {
        try {
            $works = WorkProcess::latest()->get();
            return view('frontendmanage::workProcess', compact('works'));

        } catch (Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }


    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        try {

            $work = new WorkProcess;
            $work->title = $request->title;
            $work->description = $request->description;
            $work->save();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function show($id)
    {
        return view('systemsetting::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            $setting = BecomeInstructor::find($id);
            return response()->json([
                'setting' => $setting
            ], 200);
        } catch (Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }
    }

    public function editWork($id)
    {
        try {
            $work = WorkProcess::find($id);
            return response()->json([
                'work' => $work
            ], 200);
        } catch (Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $request->validate([
            'title' => 'required',
        ]);

        try {

            $setting = BecomeInstructor::find($request->id);

            $setting->title = $request->title;
            $setting->description = $request->description;
            $setting->btn_name = $request->btn_name;
            $setting->btn_link = $request->btn_link;
            $setting->icon = $request->icon;
            $setting->video = $request->video;


            if ($request->hasFile('image')) {

                $strpos = strpos($request->image, ';');
                $sub = substr($request->image, 0, $strpos);
                $name = md5($request->title . rand(0, 1000)) . '.' . 'png';
                $img = Image::make($request->image);
                $img->resize(800, 500);
                $upload_path = 'public/uploads/how_it_works/';
                $img->save($upload_path . $name);
                $setting->image = 'public/uploads/how_it_works/' . $name;
            }

            $setting->save();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }
    }

    public function updateWork(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $request->validate([
            'title' => 'required',
        ]);

        try {

            $work = WorkProcess::find($request->id);
            $work->title = $request->title;
            $work->description = $request->description;
            $work->save();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }
    }

    public function search()
    {
        try {
            $query = \Request::get('s');
            if ($query != '') {
                $settings = BecomeInstructor::where('section', 'like', '%' . $query . '%')
                    ->latest()->paginate(5);
            } else {
                $settings = BecomeInstructor::latest()->paginate(5);
            }

            return response()->json([
                'settings' => $settings
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => trans("lang.Oops, Something Went Wrong")]);

        }
    }

    public function searchWork()
    {
        try {
            $query = \Request::get('s');
            if ($query != '') {
                $works = WorkProcess::where('title', 'like', '%' . $query . '%')
                    ->latest()->paginate(5);
            } else {
                $works = WorkProcess::latest()->paginate(5);
            }

            return response()->json([
                'works' => $works
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => trans("lang.Oops, Something Went Wrong")]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */

    public function status($id)
    {
        try {
            $work = WorkProcess::find($id);

            if ($work->status == 1) {
                $work->status = 0;
                $success = trans('lang.Work Process') . ' ' . trans('lang.Deactivated') . ' ' . trans('lang.Successfully');
            } else {
                $work->status = 1;
                $success = trans('lang.Work Process') . ' ' . trans('lang.Activated') . ' ' . trans('lang.Successfully');
            }

            $work->save();

            return response()->json([
                'success' => $success
            ], 200);

        } catch (Exception $e) {
            return response()->json(['error' => trans("lang.Operation Failed")]);

        }
    }

    public function destroy($id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            $success = trans('lang.Work Process') . ' ' . trans('lang.Deleted') . ' ' . trans('lang.Successfully');
            $work = WorkProcess::find($id);

            $work->delete();

            return response()->json([
                'success' => $success
            ], 200);

        } catch (Exception $e) {
            return response()->json(['error' => trans("lang.Operation Failed")]);
        }
    }

}
