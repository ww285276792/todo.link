<?php

namespace Modules\Core\Repositories\Eloquent;

use Modules\Core\Entities\Level;
use Modules\Core\Repositories\Contracts\LevelRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class LevelRepositoryEloquent
 *
 * @author  luffy007  <285276792@qq.com>
 */
class LevelRepositoryEloquent extends BaseRepository implements LevelRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Level::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->orderBy('sort')->all();
    }
}
