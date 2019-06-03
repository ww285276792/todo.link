<?php

namespace Modules\Core\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface LevelRepository
 *
 * @author  luffy007  <285276792@qq.com>
 */
interface LevelRepository extends RepositoryInterface
{
    /**
     * @return mixed
     */
    public function getLevel();
}
