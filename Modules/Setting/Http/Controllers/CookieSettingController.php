<?php

namespace Modules\Setting\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Entities\CookieSetting;

class CookieSettingController extends Controller
{

    public function index()
    {
        $setting = CookieSetting::first();
        return view('setting::cookie_setting', compact('setting'));
    }


    public function store(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            $cookie = CookieSetting::first();
            if ($cookie) {
                $cookie->title = $request->title;
                $cookie->allow = $request->allow;
                $cookie->btn_text = $request->btn_text;
                $cookie->bg_color = $request->bg_color;
                $cookie->text_color = $request->text_color;
                $cookie->details = $request->details;
                $cookie->save();
            }
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $exception) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }


    }

}
