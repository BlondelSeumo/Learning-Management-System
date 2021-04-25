<?php

namespace Modules\VimeoSetting\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\VimeoSetting\Entities\Vimeo;

class VimeoSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $videoSetting = Vimeo::where('active_status', 1)->first();
        return view('vimeosetting::index', compact('videoSetting'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('vimeosetting::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // return $request;
        try {

            $vimeoSetting = Vimeo::where('id', $request->id)->first();
            if (empty($vimeoSetting)) {
                $vimeoSetting = new Vimeo();
            }
            $vimeoSetting->vimeo_app_id = $request->vimeo_app_id;
            $vimeoSetting->vimeo_client = $request->vimeo_client;
            $vimeoSetting->vimeo_secret = $request->vimeo_secret;
            $vimeoSetting->vimeo_access = $request->vimeo_access;
            $results = $vimeoSetting->save();

            $key1 = 'VIMEO_APP_ID';
            $key2 = 'VIMEO_CLIENT';
            $key3 = 'VIMEO_SECRET';
            $key4 = 'VIMEO_ACCESS';

            $value1 = $request->vimeo_app_id;
            $value2 = $request->vimeo_client;
            $value3 = $request->vimeo_secret;
            $value4 = $request->vimeo_access;


            $path = base_path() . "/.env";
            $VIMEO_APP_ID = env($key1);
            $VIMEO_CLIENT = env($key2);
            $VIMEO_SECRET = env($key3);
            $VIMEO_ACCESS = env($key4);

            if (file_exists($path)) {
                file_put_contents($path, str_replace(
                    "$key1=" . $VIMEO_APP_ID,
                    "$key1=" . $value1,
                    file_get_contents($path)
                ));
                file_put_contents($path, str_replace(
                    "$key2=" . $VIMEO_CLIENT,
                    "$key2=" . $value2,
                    file_get_contents($path)
                ));
                file_put_contents($path, str_replace(
                    "$key3=" . $VIMEO_SECRET,
                    "$key3=" . $value3,
                    file_get_contents($path)
                ));
                file_put_contents($path, str_replace(
                    "$key4=" . $VIMEO_ACCESS,
                    "$key4=" . $value4,
                    file_get_contents($path)
                ));
            }


            if ($results) {
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

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
