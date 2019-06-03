<?php

namespace Modules\Core\Repositories\Eloquent;

use Modules\Core\Entities\Suggest;
use Modules\Core\Repositories\Contracts\SuggestRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class SuggestRepositoryEloquent
 *
 * @author  luffy007  <285276792@qq.com>
 */
class SuggestRepositoryEloquent extends BaseRepository implements SuggestRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Suggest::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
