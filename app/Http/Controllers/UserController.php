<?php

namespace App\Http\Controllers;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Modules\Localization\Entities\Language;
use Modules\SystemSetting\Entities\Currency;

class UserController extends Controller
{
    public function __construct()
    {

    }

    public function changePassword()
    {
        $user = User::where('id', Auth::id())->with('role')->first();
        $currencies = Currency::whereStatus('1')->get();
        $languages = Language::whereStatus('1')->get();
        $countries = DB::table('countries')->whereActiveStatus(1)->get();
        $cities = DB::table('spn_cities')->where('country_id', $user->country)->select('id', 'name')->get();

        return view('backend.changePassword', compact('cities', 'user', 'currencies', 'languages', 'countries'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => "required",
            'new_password' => "required|same:confirm_password|min:8|different:current_password",
            'confirm_password' => 'required|min:8'
        ]);

        try {
            if (demoCheck()) {
                return redirect()->back();
            }
            $user = Auth::user();
            if (Hash::check($request->current_password, $user->password)) {

                $user->password = Hash::make($request->new_password);
                $result = $user->save();

                if ($result) {
                    send_email($user, $type = 'PASS_UPDATE', $shortcodes = ['time' => now()]);

                    Auth::logout();
                    session(['role_id' => '']);
                    Session::flush();
                    Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                    return redirect()->back();

                } else {
                    Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                    return redirect()->back();

                }
            } else {
                Toastr::error('Current password not match!', 'Failed');
                return redirect()->back();

            }
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function update_user(Request $request)
    {


        $request->validate([
            'name' => "required",
            'email' => "required|unique:users,email," . Auth::id(),
            'phone' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|unique:users,phone,' . Auth::id(),
        ]);

        try {
            if (demoCheck()) {
                return redirect()->back();
            }
            $user = Auth::user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->city = $request->city;
            $user->zip = $request->zip;
            $user->currency_id = $request->currency;
            $user->language_id = $request->language;

            $language = Language::find($request->language);

            $user->language_code = $language->code;
            $user->language_name = $language->name;

            $user->country = $request->country;
            $user->facebook = $request->facebook;
            $user->twitter = $request->twitter;
            $user->linkedin = $request->linkedin;
            $user->instagram = $request->instagram;
            $user->short_details = $request->short_details;

            if (!empty($request->about)) {
                $user->about = $request->about;
            }
            $fileName = "";
            if ($request->file('image') != "") {
                $file = $request->file('image');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/staff/', $fileName);
                $fileName = 'public/uploads/staff/' . $fileName;
                $user->image = $fileName;
            }
            $user->save();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }

    }

    public function changeLanguage($language_code)
    {
        $language = Language::where('status', 1)->where('code', $language_code)->first();
        if ($language) {
            if (Auth::check()) {
                //set session & set user
                $user = Auth::user();
                $user->language_id = $language->id;
                $user->language_code = $language->code;
                $user->language_name = $language->name;
                $user->save();
                Toastr::success('Successfully changed language', 'Success');
                return redirect()->back();
            } else {
                Session::put('locale', $language->code);
                Session::put('language_name', $language->name);
                Session::put('language_rtl', $language->rtl);
                Toastr::success('Successfully changed language', 'Success');
                return redirect()->back();
            }
        } else {
            Toastr::error('Failed to change language', 'Failed');
            return redirect()->back();
        }
    }

    public function getUsersByRole(Request $request)
    {

        try {
            $role_id = $request->get('user_type');
            $users = User::where('role_id', $role_id)->get();
            return $users;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Oops, Something Went Wrong']);

        }
    }
}
