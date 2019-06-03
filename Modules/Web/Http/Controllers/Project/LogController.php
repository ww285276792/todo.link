<?php

namespace Modules\Web\Http\Controllers\Project;

use Modules\Project\Repositories\Eloquent\LogRepositoryEloquent;
use Modules\Project\Repositories\Eloquent\ProjectRepositoryEloquent;
use Modules\Project\Requests\GetAllLogRequest;
use Modules\Web\Http\Controllers\BaseController;

/**
 * Class LogController
 *
 * @author  luffy007  <285276792@qq.com>
 */
class LogController extends BaseController
{
    /**
     * @var LogRepositoryEloquent
     */
    protected $logRepositoryEloquent;

    /**
     * @var ProjectRepositoryEloquent
     */
    protected $projectRepositoryEloquent;

    /**
     * LogController constructor.
     *
     * @param LogRepositoryEloquent $logRepositoryEloquent
     * @param ProjectRepositoryEloquent $projectRepositoryEloquent
     */
    public function __construct(
        LogRepositoryEloquent $logRepositoryEloquent,
        ProjectRepositoryEloquent $projectRepositoryEloquent
    )
    {
        parent::__construct();

        $this->logRepositoryEloquent = $logRepositoryEloquent;
        $this->projectRepositoryEloquent = $projectRepositoryEloquent;
    }

    /**
     * @param GetAllLogRequest $request
     * @param $uuid
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(GetAllLogRequest $request, $uuid)
    {
        /**
         * @var \Modules\Project\Entities\Project $project
         */
        $project = $this->projectRepositoryEloquent->getProjectByUuid($uuid);
        $members = $project->users;
        $data =$this->logRepositoryEloquent->getPaginateLogsByProject($project);

        return view('web::log.index', compact('data', 'members'));
    }
}
