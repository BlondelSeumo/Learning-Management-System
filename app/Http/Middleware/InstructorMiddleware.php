<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class InstructorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role->id == 2)
        {

            //check email verification
            if (! $request->user() ||
                ($request->user() instanceof MustVerifyEmail &&
                    ! $request->user()->hasVerifiedEmail())) {
                return $request->expectsJson()
                    ? abort(403, 'Your email address is not verified.')
                    : Redirect::route( 'verification.notice');
            }

            return $next($request);
        } else {
            return redirect()->to('/home');
        }
    }
}
