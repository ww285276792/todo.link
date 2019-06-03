<?php

namespace Modules\Web\Http\Controllers\User;

use App\Events\LogEvent;
use Illuminate\Database\Query\Builder;
use Modules\Core\Repositories\Eloquent\RoleRepositoryEloquent;
use Modules\Project\Entities\Project;
use Modules\Project\Repositories\Eloquent\ProjectRepositoryEloquent;
use Modules\User\Entities\User;
use Modules\Web\Http\Controllers\BaseController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class JoinController
 *
 * @author  luffy007  <285276792@qq.com>
 */
class JoinController extends BaseController
{
    /**
     * @var ProjectRepositoryEloquent
     */
    protected $projectRepositoryEloquent;

    /**
     * @var RoleRepositoryEloquent
     */
    protected $roleRepositoryEloquent;

    /**
     * JoinController constructor.
     *
     * @param ProjectRepositoryEloquent $projectRepositoryEloquent
     * @param RoleRepositoryEloquent $roleRepositoryEloquent
     */
    public function __construct(
        ProjectRepositoryEloquent $projectRepositoryEloquent,
        RoleRepositoryEloquent $roleRepositoryEloquent
    )
    {
        parent::__construct();

        $this->projectRepositoryEloquent = $projectRepositoryEloquent;
        $this->roleRepositoryEloquent = $roleRepositoryEloquent;
    }

    /**
     * @param $uuid
     * @param $token
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function showJoinForm($uuid, $token)
    {
        $project = $this->projectRepositoryEloquent
            ->whereHas('inviteLink', function ($query) use ($token) {
                /**
                 * @var Builder $query
                 */
                $query->where('token', $token);
            })
            ->findByField([
                'uuid' => $uuid,
            ])
            ->first();

        if (!$project) {
            throw new NotFoundHttpException();
        }

        /**
         * @var User $user
         */
        $user = $this->user();
        $re = $user->projects()->where('uuid', $uuid)->get()->count();

        if ($re > 0) {
            return redirect(route('task.index', ['uuid' => $uuid]));
        }

        return view('web::user.join', compact('uuid', 'token', 'project'));
    }

    /**
     * @param $uuid
     * @param $token
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function join($uuid, $token)
    {
        /**
         * @var User $user
         */
        $user = $this->user();
        $re = $user->projects()->where('uuid', $uuid)->get()->count();

        if ($re > 0) {
            return redirect(route('task.index', ['uuid' => $uuid]));
        }

        /**
         * @var Project $project
         */
        $project = $this->projectRepositoryEloquent
            ->whereHas('inviteLink', function ($query) use ($token) {
                /**
                 * @var Builder $query
                 */
                $query->where('token', $token);
            })
            ->findByField([
                'uuid' => $uuid,
            ])
            ->first();

        if (!$project) {
            throw new NotFoundHttpException();
        }

        $role = $this->roleRepositoryEloquent
            ->findByField([
                'project_id' => $project->id,
                'name' => 'member' . $project->id,
            ])->first();

        $project->users()->attach([$user->id]);
        $user->assignRole($role->id);

        event(new LogEvent($user, trans('user.log_desc.join'), 'name'));

        return redirect(route('task.index', ['uuid' => $uuid]));
    }
}
