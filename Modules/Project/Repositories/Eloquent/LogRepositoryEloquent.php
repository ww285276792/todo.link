<?php

namespace Modules\Project\Repositories\Eloquent;

use Modules\Project\Criteria\Web\LogCriteria;
use Modules\Project\Entities\Project;
use Modules\Project\Repositories\Contracts\LogRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Spatie\Activitylog\Models\Activity;

/**
 * Class LogRepositoryEloquent
 *
 * @author  luffy007  <285276792@qq.com>
 */
class LogRepositoryEloquent extends BaseRepository implements LogRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Activity::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param Project $project
     *
     * @return mixed
     */
    public function getLastestLogsByProject(Project $project)
    {
        return $this
            ->scopeQuery(function ($query) {
                /**
                 * @var \Illuminate\Database\Query\Builder $query
                 */
                return $query->limit(10);
            })
            ->orderBy('created_at', 'desc')
            ->findWhere([
                'log_name' => 'project_' . $project->uuid,
            ]);
    }

    /**
     * @param $project
     *
     * @return mixed
     */
    public function getPaginateLogsByProject($project)
    {
        return $this
            ->with(['causer'])
            ->pushCriteria(new LogCriteria(request(), $project->uuid))
            ->orderBy('created_at', 'desc')
            ->paginate(request()->get('limit'));
    }
}
