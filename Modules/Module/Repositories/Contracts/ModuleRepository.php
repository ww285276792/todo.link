<?php

namespace Modules\Module\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ModuleRepository
 *
 * @author  luffy007  <285276792@qq.com>
 */
interface ModuleRepository extends RepositoryInterface
{
    /**
     * @param $project
     *
     * @return mixed
     */
    public function getModulesByProject($project);

    /**
     * @param $project
     * @param $id
     *
     * @return mixed
     */
    public function getModuleByProjectAndId($project, $id);

    /**
     * @param $project
     *
     * @return mixed
     */
    public function getModulesProgressByProject($project);
}
