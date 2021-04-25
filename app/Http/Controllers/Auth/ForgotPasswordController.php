<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Modules\FrontendManage\Entities\LoginPage;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    public function SendPasswordResetLink()
    {
        $page = LoginPage::first();
        return view(theme('auth.passwords.email'), compact('page'));
    }

    public function ResetPassword()
    {
        $page = LoginPage::first();
        return view(theme('auth.passwords.reset'), compact('page'));
    }
}
