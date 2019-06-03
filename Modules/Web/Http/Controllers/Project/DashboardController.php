<?php

namespace Modules\Web\Http\Controllers\Project;

use Modules\Project\Repositories\Eloquent\LogRepositoryEloquent;
use Modules\Project\Repositories\Eloquent\ProjectRepositoryEloquent;
use Modules\Task\Repositories\Eloquent\TaskRepositoryEloquent;
use Modules\Web\Http\Controllers\BaseController;
use Modules\Project\Requests\ShowDashboardRequest;

/**
 * Class DashboardController
 *
 * @author  luffy007  <285276792@qq.com>
 */
class DashboardController extends BaseController
{
    /**
     * @var ProjectRepositoryEloquent
     */
    protected $projectRepositoryEloquent;

    /**
     * @var TaskRepositoryEloquent
     */
    protected $taskRepositoryEloquent;

    /**
     * @var LogRepositoryEloquent
     */
    protected $logRepositoryEloquent;

    /**
     * DashboardController constructor.
     *
     * @param ProjectRepositoryEloquent $projectRepositoryEloquent
     * @param TaskRepositoryEloquent $taskRepositoryEloquent
     * @param LogRepositoryEloquent $logRepositoryEloquent
     */
    public function __construct(
        ProjectRepositoryEloquent $projectRepositoryEloquent,
        TaskRepositoryEloquent $taskRepositoryEloquent,
        LogRepositoryEloquent $logRepositoryEloquent
    )
    {
        parent::__construct();

        $this->projectRepositoryEloquent = $projectRepositoryEloquent;
        $this->taskRepositoryEloquent = $taskRepositoryEloquent;
        $this->logRepositoryEloquent = $logRepositoryEloquent;
    }

    /**
     * @param ShowDashboardRequest $dashboardRequest
     * @param $uuid
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ShowDashboardRequest $dashboardRequest, $uuid)
    {
        $userId = $this->userId();

        /**
         * @var \Modules\Project\Entities\Project $project
         */
        $project = $this->projectRepositoryEloquent->findWhere([
            'uuid' => $uuid
        ])->first();

        $taskCount = $this->taskRepositoryEloquent->getTasksCountByWhere([
            'project_id' => $project->id,
        ]);

        $taskFinishedCount = $this->taskRepositoryEloquent->getTasksCountByWhere([
            'project_id' => $project->id,
            'status' => 'finished',
        ]);

        $selfTaskCount = $this->taskRepositoryEloquent->getTasksCountByWhere([
            'project_id' => $project->id,
            'assign_id' => $userId,
        ]);

        $selfTaskFinishedCount = $this->taskRepositoryEloquent->getTasksCountByWhere([
            'project_id' => $project->id,
            'status' => 'finished',
            'assign_id' => $userId,
        ]);

        $taskPostponedCount = $this->taskRepositoryEloquent->getPostponedTasksCountByProject($project);
        $memberCount = $project->users()->count();
        $tasks = $this->taskRepositoryEloquent->getLastestTasksByProject($project);
        $logs = $this->logRepositoryEloquent->getLastestLogsByProject($project);

        return view('web::dashboard.index', compact(
            'taskCount', 'taskFinishedCount',
            'selfTaskCount', 'selfTaskFinishedCount', 'userId',
            'taskPostponedCount', 'memberCount', 'tasks', 'logs'
        ));
    }
}
