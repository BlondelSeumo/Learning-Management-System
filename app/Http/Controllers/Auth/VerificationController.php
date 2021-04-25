<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Modules\Setting\Model\BusinessSetting;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails {
        verify as parentVerify;
    }

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function resend_mail()
    {
        $user = Auth::user();
        if (BusinessSetting::where('type', 'email_verification')->first()->status != 1) {
            $user->email_verified_at = date('Y-m-d H:m:s');
            $user->save();
        } else {
            $user->sendEmailVerificationNotification();
        }
        return back();
    }

    public function verify(Request $request)
    {

        if ($request->user() && $request->user() != $request->route('id')) {
            Auth::logout();
        }

        if (!$request->user()) {
            Auth::loginUsingId($request->route('id'), true);
        }

        return $this->parentVerify($request);
    }

    public function show(Request $request)
    {

        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/');
        }
        return view(theme('auth.verify'));
    }

    /**
     * The user has been verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function verified(Request $request)
    {
     //after verified

    }
}
