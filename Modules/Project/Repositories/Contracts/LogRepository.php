<?php

namespace Modules\Project\Repositories\Contracts;

use Modules\Project\Entities\Project;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface LogRepository
 *
 * @author  luffy007  <285276792@qq.com>
 */
interface LogRepository extends RepositoryInterface
{
    /**
     * @param Project $project
     *
     * @return mixed
     */
    public function getLastestLogsByProject(Project $project);
}
