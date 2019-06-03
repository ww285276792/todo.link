<?php

namespace Modules\Module\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Exceptions\NotFoundException;
use Modules\Module\Entities\Module;
use Modules\Module\Repositories\Contracts\ModuleRepository;
use Modules\Task\Entities\Task;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class ModuleRepositoryEloquent
 *
 * @author  luffy007  <285276792@qq.com>
 */
class ModuleRepositoryEloquent extends BaseRepository implements ModuleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Module::class;
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
    public function getModulesByProject($project)
    {
        return $this
            ->orderBy('sort', 'asc')
            ->orderBy('created_at', 'desc')
            ->findWhere([
                'project_id' => $project->id
            ]);
    }

    /**
     * @param $project
     * @param $id
     *
     * @return mixed
     */
    public function getModuleByProjectAndId($project, $id)
    {
        $module = $this
            ->findByField([
                'id' => $id,
                'project_id' => $project->id,
            ])->first();

        if (is_null($module)) {
            throw new NotFoundException();
        }

        return $module;
    }

    /**
     * @param $project
     *
     * @return mixed
     */
    public function getModulesProgressByProject($project)
    {
        return $this
            ->withCount([
                'tasks as task_total_count',
                'tasks as task_finished_count' => function ($query) {
                    /**
                     * @var Builder $query
                     */
                    $query->where('status', Task::FINISHED);
                },
                'tasks as task_open_count' => function ($query) {
                    /**
                     * @var Builder $query
                     */
                    $query->where('status', Task::OPEN);
                }
            ])
            ->orderBy('sort')
            ->findByField(
                'project_id', $project->id
            );
    }
}
