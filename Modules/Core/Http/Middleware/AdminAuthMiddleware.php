<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Administrator\Entities\AdminUser;

/**
 * Class AdminAuthMiddleware
 *
 * @author  luffy007  <285276792@qq.com>
 */
class AdminAuthMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('admin/login');
            }
        }

        $uri = \Route::currentRouteName();
        /**
         * @var AdminUser $user
         */
        $user = $request->user('admin');

//        if ($user->roles->first()->name == 'superadministrator') {
//            return $next($request);
//        }

        if ($user->name == 'superadministrator') {
            return $next($request);
        }

        if ($user->can([$uri])) {
            return $next($request);
        } else {
            return redirect()->route('admin.unauthorized');
        }
    }
}
