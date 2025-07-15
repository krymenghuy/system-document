<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class UserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission_key,$action):Response|\Illuminate\Http\RedirectResponse
    {

        if(!checkPermission($permission_key,$action)){
            return redirect()->route('admin.no_permission')->with(['status' => 'warning', 'sms' => __('No Permission')]);
        }

        return $next($request);
    }
}
