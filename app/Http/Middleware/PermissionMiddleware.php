<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param $role
     * @param null $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {
        if(!Auth::check() || !$request->user()->can($permission)) {
            abort(403, __('auth.not_allowed'));
        }

        return $next($request);

    }
}
