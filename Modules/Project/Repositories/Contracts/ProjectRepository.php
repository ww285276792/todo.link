<?php

namespace Modules\Project\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ProjectRepository
 *
 * @author  luffy007  <285276792@qq.com>
 */
interface ProjectRepository extends RepositoryInterface
{
    /**
     * @param $uuid
     *
     * @return mixed
     */
    public function getProjectByUuid($uuid);

    /**
     * @param $uuid
     * @param $id
     *
     * @return mixed
     */
    public function getProjectByUuidAndId($uuid, $id);
}
