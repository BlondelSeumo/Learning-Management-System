<?php

namespace App\Http\Middleware;

use Closure;

class RoutePermissionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $route_name)
    {
        if (auth()->check()) {
            if (auth()->user()->role_id == 1) {
                return $next($request);
            } else {
                $roles = app('permission_list');
                $role = $roles->where('id', auth()->user()->role_id)->first();
                if ($role != null && $role->permissions->contains('route', $route_name)) {
                    return $next($request);
                } else {
                    abort('403');
                }
            }
        } else {
            return redirect(route('login'));
        }
        abort('403');
    }
}
