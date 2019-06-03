<?php

namespace Modules\Administrator\Repositories\Eloquent;

use Modules\Administrator\Entities\AdminUser;
use Modules\Administrator\Repositories\Contracts\AdminUserRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class AdminUserRepositoryEloquent
 *
 * @author  luffy007  <285276792@qq.com>
 */
class AdminUserRepositoryEloquent extends BaseRepository implements AdminUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminUser::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
