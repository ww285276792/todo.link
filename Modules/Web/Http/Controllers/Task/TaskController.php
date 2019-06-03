<?php

namespace Modules\Web\Http\Controllers\Task;

use App\Events\LogEvent;
use Illuminate\Http\Request;
use Modules\Core\Repositories\Eloquent\LevelRepositoryEloquent;
use Modules\Project\Repositories\Eloquent\ProjectRepositoryEloquent;
use Modules\Project\Traits\Project;
use Modules\Task\Entities\Task;
use Modules\Task\Repositories\Eloquent\TaskRepositoryEloquent;
use Modules\Task\Requests\CreateTaskRequest;
use Modules\Task\Requests\DeleteTaskRequest;
use Modules\Task\Requests\GetAllTaskRequest;
use Modules\Task\Requests\SetTaskStatusRequest;
use Modules\Task\Requests\UpdateTaskRequest;
use Modules\Task\Validators\TaskValidator;
use Modules\Web\Http\Controllers\BaseController;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class TaskController
 *
 * @author  luffy007  <285276792@qq.com>
 */
class TaskController extends BaseController
{
    use Project;

    /**
     * @var ProjectRepositoryEloquent
     */
    protected $projectRepositoryEloquent;

    /**
     * @var TaskRepositoryEloquent
     */
    protected $taskRepositoryEloquent;

    /**
     * @var LevelRepositoryEloquent
     */
    protected $levelRepositoryEloquent;

    /**
     * @var TaskValidator
     */
    protected $taskValidator;

    /**
     * TaskController constructor.
     *
     * @param TaskRepositoryEloquent $taskRepositoryEloquent
     * @param ProjectRepositoryEloquent $projectRepositoryEloquent
     * @param LevelRepositoryEloquent $levelRepositoryEloquent
     * @param TaskValidator $taskValidator
     */
    public function __construct(
        TaskRepositoryEloquent $taskRepositoryEloquent,
        ProjectRepositoryEloquent $projectRepositoryEloquent,
        LevelRepositoryEloquent $levelRepositoryEloquent,
        TaskValidator $taskValidator
    )
    {
        parent::__construct();

        $this->taskRepositoryEloquent = $taskRepositoryEloquent;
        $this->projectRepositoryEloquent = $projectRepositoryEloquent;
        $this->levelRepositoryEloquent = $levelRepositoryEloquent;
        $this->taskValidator = $taskValidator;
    }

    /**
     * @param GetAllTaskRequest $request
     * @param $uuid
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(GetAllTaskRequest $request, $uuid)
    {
        /**
         * @var \Modules\Project\Entities\Project $project
         */
        $project = $this->getProject($request);
        $data = $this->taskRepositoryEloquent->getPaginateTasksByProject($project);

        return view('web::task.index', array_merge(['data' => $data], $this->getBaseData($project)));
    }

    /**
     * @param \Modules\Project\Entities\Project $project
     *
     * @return array
     */
    public function getBaseData(\Modules\Project\Entities\Project $project)
    {
        $modules = $project->modules()->orderBy('sort')->get();
        $tags = $project->tags()->orderBy('sort')->get();
        $levels = $this->levelRepositoryEloquent->getLevel();
        $members = $project->users;

        return [
            'modules' => $modules,
            'tags' => $tags,
            'levels' => $levels,
            'members' => $members,
        ];
    }

    /**
     * @param CreateTaskRequest $request
     * @param $uuid
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(CreateTaskRequest $request, $uuid)
    {
        /**
         * @var \Modules\Project\Entities\Project $project
         */
        $project = $this->getProject($request);

        return view('web::task.create', $this->getBaseData($project));
    }

    /**
     * @param CreateTaskRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateTaskRequest $request)
    {
        try {
            $this->taskValidator->with($request->all())->passesOrFail();

            /**
             * @var \Modules\Project\Entities\Project $project
             */
            $project = $this->getProject($request);
            $request->offsetSet('project_id', $project->id);
            $request->offsetSet('user_id', $this->userId());

            if (!$this->validateRequest($project, $request)) {
                throw new HttpException(500);
            }

            $task = $this->taskRepositoryEloquent->create($request->except(['status']));

            if ($request->get('tag')) {
                if (!$this->validateTag($project, $request)) {
                    throw new HttpException(500);
                }

                $task->tags()->attach($request->get('tag'));
            }

            event(new LogEvent($task, trans('task.log_desc.create'), 'title'));

            return redirect(route('task.index', ['uuid' => $request->route('uuid')]))->with('success', trans('common.message.create_success'));
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * @param UpdateTaskRequest $request
     * @param $uuid
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(UpdateTaskRequest $request, $uuid, $id)
    {
        /**
         * @var \Modules\Project\Entities\Project $project
         */
        $project = $this->getProject($request);
        $data = $this->taskRepositoryEloquent->getTaskByProjectAndId($project, $id);
        $otags = array_column($data->tags->toArray(), 'id');

        return view('web::task.edit', array_merge(['data' => $data, 'otags' => $otags,], $this->getBaseData($project)));
    }

    /**
     * @param UpdateTaskRequest $request
     * @param $uuid
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateTaskRequest $request, $uuid, $id)
    {
        try {
            $this->taskValidator->with($request->all())->passesOrFail();

            /**
             * @var \Modules\Project\Entities\Project $project
             */
            $project = $this->getProject($request);

            /**
             * @var Task $task
             */
            $task = $this->taskRepositoryEloquent->getTaskByProjectAndId($project, $id);

            if (!$this->validateRequest($project, $request)) {
                throw new HttpException(500);
            }

            if ($request->get('tag')) {
                if (!$this->validateTag($project, $request)) {
                    throw new HttpException(500);
                }

                $task->tags()->sync($request->get('tag'));
            }

            $this->taskRepositoryEloquent->update($request->except(['status', 'project_id', 'user_id']), $task->id);

            event(new LogEvent($task, trans('task.log_desc.update'), 'title'));

            return redirect(route('task.index', ['uuid' => $uuid]))->with('success', trans('common.message.update_success'));
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * @param DeleteTaskRequest $request
     * @param $uuid
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DeleteTaskRequest $request, $uuid, $id)
    {
        /**
         * @var \Modules\Project\Entities\Project $project
         */
        $project = $this->getProject($request);
        $data = $this->taskRepositoryEloquent->getTaskByProjectAndId($project, $id);
        $data->delete();

        event(new LogEvent($data, trans('task.log_desc.delete'), 'title'));

        return redirect(route('task.index', ['uuid' => $uuid]))->with('success', trans('common.message.delete_success'));
    }

    /**
     * @param SetTaskStatusRequest $request
     * @param $uuid
     * @param $id
     * @param $status
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setStatus(SetTaskStatusRequest $request, $uuid, $id, $status)
    {
        /**
         * @var \Modules\Project\Entities\Project $project
         */
        $project = $this->getProject($request);
        $data = $this->taskRepositoryEloquent->getTaskByProjectAndId($project, $id);

        if (!in_array($status, [Task::OPEN, Task::FINISHED])) {
            throw new NotFoundHttpException();
        }

        $updateData = ['status' => $status];

        if ($status == 'finished') {
            $updateData['finish_id'] = $this->userId();
            $updateData['finish_datetime'] = date('Y-m-d H:i:s');
        } else {
            $updateData['finish_id'] = null;
            $updateData['finish_datetime'] = null;
        }

        $this->taskRepositoryEloquent->update($updateData, $id);

        event(new LogEvent($data, trans('task.log_desc.' . $status), 'title'));

        return redirect(route('task.index', ['uuid' => $uuid]))->with('success', trans('task.message.action_success'));
    }

    /**
     * @param \Modules\Project\Entities\Project $project
     * @param Request $request
     *
     * @return bool
     */
    public function validateRequest($project, $request)
    {
        $moduleCount = $project->modules()->where('id', $request->get('module_id'))->count();
        $userCount = 1;

        if ($request->get('assign_id')) {
            $userCount = $project->users()->where('id', $request->get('assign_id'))->count();
        }

        if ($moduleCount < 1 || $userCount < 1) {
            return false;
        }

        return true;
    }

    /**
     * @param \Modules\Project\Entities\Project $project
     * @param Request $request
     *
     * @return bool
     */
    public function validateTag($project, $request)
    {
        $tag = $project->tags->toArray();
        $flag = 1;

        foreach ($request->get('tag') as $item) {
            if (in_array($item, array_column($tag, 'id'))) {
                continue;
            } else {
                $flag = 0;
                break;
            }
        }

        if ($flag == 1) {
            return true;
        } else {
            return false;
        }
    }
}
