<?php

namespace Modules\Web\Http\Controllers\Project;

use Modules\Module\Repositories\Eloquent\ModuleRepositoryEloquent;
use Modules\Project\Repositories\Eloquent\ProjectRepositoryEloquent;
use Modules\Project\Requests\GetAllProgressRequest;
use Modules\Task\Entities\Task;
use Modules\Task\Repositories\Eloquent\TaskRepositoryEloquent;
use Modules\User\Repositories\Eloquent\UserRepositoryEloquent;
use Modules\Web\Http\Controllers\BaseController;

/**
 * Class ProgressController
 *
 * @author  luffy007  <285276792@qq.com>
 */
class ProgressController extends BaseController
{
    /**
     * @var ModuleRepositoryEloquent
     */
    protected $moduleRepositoryEloquent;

    /**
     * @var ProjectRepositoryEloquent
     */
    protected $projectRepositoryEloquent;

    /**
     * @var UserRepositoryEloquent
     */
    protected $userRepositoryEloquent;

    /**
     * @var TaskRepositoryEloquent
     */
    protected $taskRepositoryEloquent;

    /**
     * ProgressController constructor.
     *
     * @param ModuleRepositoryEloquent $moduleRepositoryEloquent
     * @param ProjectRepositoryEloquent $projectRepositoryEloquent
     * @param UserRepositoryEloquent $userRepositoryEloquent
     * @param TaskRepositoryEloquent $taskRepositoryEloquent
     */
    public function __construct(
        ModuleRepositoryEloquent $moduleRepositoryEloquent,
        ProjectRepositoryEloquent $projectRepositoryEloquent,
        UserRepositoryEloquent $userRepositoryEloquent,
        TaskRepositoryEloquent $taskRepositoryEloquent
    )
    {
        parent::__construct();

        $this->moduleRepositoryEloquent = $moduleRepositoryEloquent;
        $this->projectRepositoryEloquent = $projectRepositoryEloquent;
        $this->userRepositoryEloquent = $userRepositoryEloquent;
        $this->taskRepositoryEloquent = $taskRepositoryEloquent;
    }

    /**
     * @param GetAllProgressRequest $request
     * @param $uuid
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(GetAllProgressRequest $request, $uuid)
    {
        /**
         * @var \Modules\Project\Entities\Project $project
         */
        $project = $this->projectRepositoryEloquent->getProjectByUuid($uuid);

        $taskFinishedCount = $this->taskRepositoryEloquent->getTasksCountByWhere([
            'project_id' => $project->id,
            'status' => Task::FINISHED,
        ]);

        $taskCount = $this->taskRepositoryEloquent->getTasksCountByWhere([
            'project_id' => $project->id,
        ]);

        $modules = $this->moduleRepositoryEloquent->getModulesProgressByProject($project);
        $users = $this->userRepositoryEloquent->getUsersProgressByProject($project);

        return view('web::progress.index', compact('modules', 'users', 'taskCount', 'taskFinishedCount'));
    }
}
