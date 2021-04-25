<?php

namespace Modules\Zoom\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Modules\Zoom\Entities\ZoomSetting;

class SettingController extends Controller
{
    public function settings()
    {
        $user = Auth::user();
        $setting = ZoomSetting::where('user_id', Auth::id())->first();
        if ($setting) {
            $setting->zoom_api_key_of_user = $user->zoom_api_key_of_user ?? '';
            $setting->zoom_api_serect_of_user = $user->zoom_api_serect_of_user ?? '';
        }


        return view('zoom::settings', compact('setting'));
    }

    public function updateSettings(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $user = Auth::user();
        $request->validate([
            'package_id' => 'required',
            'host_video' => 'required',
            'participant_video' => 'required',
            'join_before_host' => 'required',
            'audio' => 'required',
            'auto_recording' => 'required',
            'approval_type' => 'required',
            'mute_upon_entry' => 'required',
            'waiting_room' => 'required',
            'api_key' => 'required',
            'secret_key' => 'required',
        ]);

        try {
            ZoomSetting::updateOrCreate([
                'user_id' => $user->id,
            ], [
                'user_id' => Auth::id() ?? 1,
                'package_id' => $request['package_id'],
                'host_video' => $request['host_video'],
                'participant_video' => $request['participant_video'],
                'join_before_host' => $request['join_before_host'],
                'audio' => $request['audio'],
                'auto_recording' => $request['auto_recording'],
                'approval_type' => $request['approval_type'],
                'mute_upon_entry' => $request['mute_upon_entry'],
                'waiting_room' => $request['waiting_room'],
            ]);
            $user->zoom_api_key_of_user = $request->get('api_key');
            $user->zoom_api_serect_of_user = $request->get('secret_key');
            $user->save();
            Artisan::call('config:clear');
            Toastr::success('Zoom Setting updated successfully !', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            Toastr::error($e->getMessage(), trans('common.Failed'));
            return redirect()->back();
        }
    }

}
