<?php

namespace Modules\Localization\Http\Middleware;

use Closure;
use App;
use Session;
use Config;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Session::has('locale')){
            $locale = Session::get('locale', Config::get('app.locale'));
        }
        else{
            $locale = 'en';
        }

        App::setLocale($locale);
        return $next($request);
    }
}
