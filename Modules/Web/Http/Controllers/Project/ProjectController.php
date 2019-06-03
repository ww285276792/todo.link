<?php

namespace Modules\Web\Http\Controllers\Project;

use App\Events\InitRoleEvent;
use App\Events\LogEvent;
use Illuminate\Http\Request;
use Modules\Core\Services\ImageService;
use Modules\Project\Criteria\Web\ProjectCriteria;
use Modules\Project\Repositories\Eloquent\ProjectRepositoryEloquent;
use Modules\Project\Validators\ProjectValidator;
use Modules\Web\Http\Controllers\BaseController;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ProjectController
 *
 * @author  luffy007  <285276792@qq.com>
 */
class ProjectController extends BaseController
{
    /**
     * @var ProjectRepositoryEloquent
     */
    protected $projectRepositoryEloquent;

    /**
     * @var ProjectValidator
     */
    protected $projectValidator;

    /**
     * @var ImageService
     */
    protected $imageService;

    /**
     * ProjectController constructor.
     *
     * @param ProjectRepositoryEloquent $projectRepositoryEloquent
     * @param ProjectValidator $projectValidator
     * @param ImageService $imageService
     */
    public function __construct(
        ProjectRepositoryEloquent $projectRepositoryEloquent,
        ProjectValidator $projectValidator,
        ImageService $imageService
    )
    {
        parent::__construct();

        $this->projectRepositoryEloquent = $projectRepositoryEloquent;
        $this->projectValidator = $projectValidator;
        $this->imageService = $imageService;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = $this->projectRepositoryEloquent
            ->with('users')
            ->pushCriteria(new ProjectCriteria($request))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('web::project.index', compact('data'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('web::project.create');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $this->projectValidator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $request->offsetSet('user_id', $this->userId());

            if ($request->hasFile('image')) {
                $path = $this->imageService->upload('image', $request);
                $request->offsetSet('logo', '/storage/' . $path);
            }

            $project = $this->projectRepositoryEloquent->create($request->input());
            $project->users()->sync([$this->userId()]);
            $project->modules()->createMany(config('module')['default_modules']);

            event(new InitRoleEvent($project->id, $this->user()));
            event(new LogEvent($project, trans('project.log_desc.create'), 'name'));

            return redirect(route('project.index'))->with('success', trans('common.message.create_success'));
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }
}
