<?php

namespace Modules\Project\Repositories\Eloquent;

use Modules\Project\Entities\ProjectLink;
use Modules\Project\Repositories\Contracts\ProjectLinkRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class ProjectLinkRepositoryEloquent
 *
 * @author  luffy007  <285276792@qq.com>
 */
class ProjectLinkRepositoryEloquent extends BaseRepository implements ProjectLinkRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectLink::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
