<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkCanManageUsers
{



        /**
     * Answer to unauthorized access request.
     *
     * @param [type] $request [description]
     *
     * @return [type] [description]
     */
    private function respondToUnauthorizedRequest($request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return response(trans('backpack::base.unauthorized'), 401);
        } else {
            return redirect('admin');
        }
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (backpack_auth()->guest()) {
            return $this->respondToUnauthorizedRequest($request);
        }

        if(!backpack_user()->root && !backpack_user()->can('users')){
            return $this->respondToUnauthorizedRequest($request);
        }

        return $next($request);
    }
}
