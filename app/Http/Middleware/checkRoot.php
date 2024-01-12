<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkRoot
{


        /**
     * Checked that the logged in user is an administrator.
     *
     * --------------
     * VERY IMPORTANT
     * --------------
     * If you have both regular users and admins inside the same table,
     * change the contents of this method to check that the logged in user
     * is an admin, and not a regular user.
     *
     * @param [type] $user [description]
     *
     * @return bool [description]
     */
    private function checkIfUserIsRoot($user)
    {
        // return ($user->is_admin == 1);
        return $user->root;
    }

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

        if (! $this->checkIfUserIsRoot(backpack_user())) {
            return $this->respondToUnauthorizedRequest($request);
        }
        return $next($request);
    }
}
