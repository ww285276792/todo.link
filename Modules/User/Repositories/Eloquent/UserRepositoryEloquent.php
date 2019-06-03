<?php

namespace Modules\User\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Modules\Task\Entities\Task;
use Modules\User\Criteria\MemberCriteria;
use Modules\User\Entities\User;
use Modules\User\Repositories\Contracts\UserRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class UserRepositoryEloquent
 *
 * @author  luffy007  <285276792@qq.com>
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $project
     *
     * @return mixed
     */
    public function getPaginateUsersByProject($project)
    {
        return $this
            ->pushCriteria(new MemberCriteria(request(), $project))
            ->with([
                'roles' => function ($query) use ($project) {
                    /**
                     * @var Builder $query
                     */
                    $query->where('project_id', $project->id);
                },
            ])
            ->orderBy('created_at', 'desc')
            ->paginate();
    }

    /**
     * @param $project
     *
     * @return mixed
     */
    public function getUsersProgressByProject($project)
    {
        return $this
            ->pushCriteria(new MemberCriteria(request(), $project))
            ->withCount([
                'tasks as task_total_count' => function ($query) use ($project) {
                    /**
                     * @var Builder $query
                     */
                    $query->where('project_id', $project->id);
                },
                'tasks as task_finished_count' => function ($query) use ($project) {
                    /**
                     * @var Builder $query
                     */
                    $query->where('project_id', $project->id)->where('status', Task::FINISHED);
                },
                'tasks as task_open_count' => function ($query) use ($project) {
                    /**
                     * @var Builder $query
                     */
                    $query->where('project_id', $project->id)->where('status', Task::OPEN);
                }
            ])
            ->get();
    }

    /**
     * @param $project
     * @param $id
     *
     * @return mixed
     */
    public function getUserByProjectAndId($project, $id)
    {
        return $this
            ->with([
                'roles' => function ($query) use ($project) {
                    /**
                     * @var Builder $query
                     */
                    $query->where('project_id', $project->id);
                }
            ])
            ->whereHas('projects', function (Builder $query) use ($project) {
                $query->where('project_id', $project->id);
            })
            ->find($id);
    }
}
