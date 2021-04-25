<?php

namespace Modules\Setting\Http\Controllers;

use App\Country;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Localization\Entities\Language;
use Modules\Setting\Model\BusinessSetting;
use Modules\Setting\Model\Currency;
use Modules\Setting\Model\DateFormat;
use Modules\Setting\Model\GeneralSetting;
use Modules\Setting\Model\TimeZone;
use Modules\SystemSetting\Entities\EmailSetting;

class SettingController extends Controller
{
    public function activation()
    {
        $business_settings = BusinessSetting::all();
        $setting = GeneralSetting::first();
        return view('setting::activation', compact('business_settings', 'setting'));
    }


    public function general_settings()
    {
        $business_settings = BusinessSetting::all();
        $setting = GeneralSetting::first();
        $date_formats = DateFormat::all();
        $languages = Language::where('status', 1)->get();
        $countries = Country::where('active_status', 1)->get();
        $currencies = Currency::where('status', 1)->get();
        $timeZones = TimeZone::all();
        return view('setting::general_settings', compact('timeZones', 'currencies', 'countries', 'languages', 'business_settings', 'setting', 'date_formats'));
    }

    public function email_setup()
    {
        $business_settings = BusinessSetting::all();
        $setting = GeneralSetting::first();
        $emailSettings = EmailSetting::all();
        $send_mail_setting = $emailSettings->where('id', 1)->first();
        $smtp_mail_setting = $emailSettings->where('id', 2)->first();
        $send_grid_mail_setting = $emailSettings->where('id', 3)->first();
        return view('setting::email_setup2', compact('emailSettings', 'business_settings', 'setting', 'send_mail_setting', 'smtp_mail_setting', 'send_grid_mail_setting'));
    }

    public function seo_setting()
    {
        $business_settings = BusinessSetting::all();
        $setting = GeneralSetting::first();
        return view('setting::seo_setting', compact('business_settings', 'setting'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\RedirectResponse
     */

    public function index(){
        return redirect()->route('home');
    }
    public function create()
    {
        return view('setting::create');
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
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('setting::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('setting::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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

    public function update_activation_status(Request $request)
    {
        $business_setting = BusinessSetting::findOrFail($request->id);
        if ($business_setting != null) {
            $business_setting->status = $request->status;
            $business_setting->save();
            return 1;
        }
        return 0;
    }
}
