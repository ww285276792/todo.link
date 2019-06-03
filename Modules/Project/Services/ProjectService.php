<?php

namespace Modules\Project\Services;

use Illuminate\Support\Facades\Auth;
use Modules\Project\Repositories\Eloquent\ProjectRepositoryEloquent;
use Modules\Task\Entities\Task;
use Modules\User\Entities\User;

/**
 * Class ProjectService
 *
 * @author  luffy007  <285276792@qq.com>
 */
class ProjectService
{
    /**
     * @var ProjectRepositoryEloquent
     */
    protected $projectRepositoryEloquent;

    /**
     * ProjectService constructor.
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
     * @return mixed
     */
    public function getProjectName()
    {
        $project = $this->projectRepositoryEloquent->findWhere([
            'uuid' => request()->route('uuid')
        ], ['name'])->first();

        if (count($project) > 0) {
            return $project->name;
        }

        return null;
    }

    /**
     * @return null
     */
    public function getOtherProject()
    {
        /**
         * @var User $user
         */
        $user = Auth::guard('web')->user();
        $project = $user->projects()
            ->where('uuid', '!=', request()->route('uuid'))
            ->get();

        if (count($project) > 0) {
            return $project;
        }

        return [];
    }

    /**
     * @return null
     */
    public function getTaskCount()
    {
        $project = $this->projectRepositoryEloquent->getProjectByUuid(request()->route('uuid'));

        if (count($project) > 0) {
            return $project->tasks()->where('status', Task::OPEN)->count();
        }

        return null;
    }
}
