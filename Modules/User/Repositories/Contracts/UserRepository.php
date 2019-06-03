<?php

namespace Modules\User\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository
 *
 * @author  luffy007  <285276792@qq.com>
 */
interface UserRepository extends RepositoryInterface
{
    /**
     * @param $project
     *
     * @return mixed
     */
    public function getUsersProgressByProject($project);

    /**
     * @param $project
     * @param $id
     *
     * @return mixed
     */
    public function getUserByProjectAndId($project, $id);
}
