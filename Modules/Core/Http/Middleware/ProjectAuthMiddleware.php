<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Project\Repositories\Eloquent\ProjectRepositoryEloquent;
use Modules\User\Entities\User;

/**
 * Class ProjectAuthMiddleware
 *
 * @author  luffy007  <285276792@qq.com>
 */
class ProjectAuthMiddleware
{
    /**
     * @var ProjectRepositoryEloquent
     */
    protected $projectRepositoryEloquent;

    /**
     * ProjectAuthMiddleware constructor.
     *
     * @param ProjectRepositoryEloquent $projectRepositoryEloquent
     */
    public function __construct(
        ProjectRepositoryEloquent $projectRepositoryEloquent
    )
    {
        $this->projectRepositoryEloquent = $projectRepositoryEloquent;
    }

    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /**
         * @var User $user
         */
        $user = Auth::guard('web')->user();
        $re = $user->projects()->where('uuid', \request()->route('uuid'))->first();

        if (is_null($re)) {
            return response()->view('error.404');
        }

        view()->share('pid', $re->id);

        return $next($request);
    }
}
