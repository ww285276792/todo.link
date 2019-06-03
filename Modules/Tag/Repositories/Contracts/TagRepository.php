<?php

namespace Modules\Tag\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TagRepository
 *
 * @author  luffy007  <285276792@qq.com>
 */
interface TagRepository extends RepositoryInterface
{
    /**
     * @param $project
     *
     * @return mixed
     */
    public function getTagsByProject($project);

    /**
     * @param $project
     * @param $id
     *
     * @return mixed
     */
    public function getTagByProjectAndId($project, $id);
}
