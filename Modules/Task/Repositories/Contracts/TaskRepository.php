<?php

namespace Modules\Task\Repositories\Contracts;

use Modules\Project\Entities\Project;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TaskRepository
 *
 * @author  luffy007  <285276792@qq.com>
 */
interface TaskRepository extends RepositoryInterface
{
    /**
     * @param $where
     *
     * @return mixed
     */
    public function getTasksCountByWhere($where);

    /**
     * @param Project $project
     *
     * @return mixed
     */
    public function getPostponedTasksCountByProject(Project $project);

    /**
     * @param Project $project
     *
     * @return mixed
     */
    public function getLastestTasksByProject(Project $project);
}
