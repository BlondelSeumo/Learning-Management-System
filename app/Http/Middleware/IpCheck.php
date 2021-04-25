<?php

namespace App\Http\Middleware;

use Closure;

class IpCheck
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

        $path = storage_path() . "/app/ip.json";
        if (file_exists($path)) {
            $ipAddresses = json_decode(file_get_contents($path), true);

            if (in_array($request->ip(), $ipAddresses)) {

                abort(403, "Your Ip Blocked By Admin");
            }
        }


        return $next($request);
    }
}
