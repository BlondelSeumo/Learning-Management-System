<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $lang = $user->userLanguage->code ?? 'en';
        } else {
            if (session()->get('locale')) {
                $lang = session()->get('locale') ?? 'en';
            } else {
                $lang = getSetting()->language->code ?? 'en';
            }
        }

        App::setLocale($lang);
        return $next($request);
    }
}
