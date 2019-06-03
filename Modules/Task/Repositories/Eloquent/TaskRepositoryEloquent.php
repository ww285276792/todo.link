<?php

namespace Modules\Task\Repositories\Eloquent;

use Modules\Project\Entities\Project;
use Modules\Task\Criteria\TaskCriteria;
use Modules\Task\Entities\Task;
use Modules\Task\Repositories\Contracts\TaskRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class TaskRepositoryEloquent
 *
 * @author  luffy007  <285276792@qq.com>
 */
class TaskRepositoryEloquent extends BaseRepository implements TaskRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Task::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $where
     *
     * @return mixed
     */
    public function getTasksCountByWhere($where)
    {
        return $this
            ->findWhere($where)
            ->count();
    }

    /**
     * @param $project
     * @param $id
     *
     * @return mixed
     */
    public function getTaskByProjectAndId($project, $id)
    {
        return $this->findByField([
            'id' => $id,
            'project_id' => $project->id,
        ])->first();
    }

    /**
     * @param $project
     *
     * @return mixed
     */
    public function getPaginateTasksByProject($project)
    {
        return $this
            ->pushCriteria(new TaskCriteria(request(), $project))
            ->with(['module', 'level', 'assignUser', 'finishUser'])
            ->paginate(request()->get('limit'));
    }

    /**
     * @param Project $project
     *
     * @return mixed
     */
    public function getPostponedTasksCountByProject(Project $project)
    {
        return $this
            ->scopeQuery(function ($query) {
                /**
                 * @var \Illuminate\Database\Query\Builder $query
                 */
                return $query->where('due_date', '<', date('Y-m-d'));
            })
            ->findWhere([
                'project_id' => $project->id,
                'status' => 'open',
            ])
            ->count();
    }

    /**
     * @param Project $project
     *
     * @return mixed
     */
    public function getLastestTasksByProject(Project $project)
    {
        return $this
            ->with(['assignUser'])
            ->scopeQuery(function ($query) {
                /**
                 * @var \Illuminate\Database\Query\Builder $query
                 */
                return $query->limit(10);
            })
            ->orderBy('created_at', 'desc')
            ->findWhere([
                'project_id' => $project->id,
            ]);
    }
}
