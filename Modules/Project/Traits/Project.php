<?php

namespace Modules\Project\Traits;

use Illuminate\Http\Request;
use Modules\Project\Repositories\Eloquent\ProjectRepositoryEloquent;

/**
 * Trait Project
 *
 * @author  luffy007  <285276792@qq.com>
 */
trait Project
{
    /**
     * @var ProjectRepositoryEloquent
     */
    protected $projectRepositoryEloquent;

    /**
     * Project constructor.
     *
     * @param ProjectRepositoryEloquent $projectRepositoryEloquent
     */
    public function __construct(
        ProjectRepositoryEloquent $projectRepositoryEloquent
    )
    {
        $this->projectRepositoryEloquent = $projectRepositoryEloquent;
    }

    /**
     * @param Request $request
     *
     * @return null
     */
    public function getProject(Request $request)
    {
        if ($request->route('uuid')) {
            return $this->projectRepositoryEloquent->findByField(
                'uuid', $request->route('uuid')
            )->first();
        }

        return null;
    }
}
