<?php

namespace Modules\Web\Http\Controllers\Setting;

use App\Events\LogEvent;
use Modules\Module\Repositories\Eloquent\ModuleRepositoryEloquent;
use Modules\Module\Requests\CreateModuleRequest;
use Modules\Module\Requests\DeleteModuleRequest;
use Modules\Module\Requests\GetAllModuleRequest;
use Modules\Module\Requests\UpdateModuleRequest;
use Modules\Module\Validators\ModuleValidator;
use Modules\Project\Repositories\Eloquent\ProjectRepositoryEloquent;
use Modules\Project\Traits\Project;
use Modules\Web\Http\Controllers\BaseController;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ModuleController
 *
 * @author  luffy007  <285276792@qq.com>
 */
class ModuleController extends BaseController
{
    use Project;

    /**
     * @var ModuleRepositoryEloquent
     */
    protected $moduleRepositoryEloquent;

    /**
     * @var ProjectRepositoryEloquent
     */
    protected $projectRepositoryEloquent;

    /**
     * @var ModuleValidator
     */
    protected $moduleValidator;

    /**
     * ModuleController constructor.
     *
     * @param ModuleRepositoryEloquent $moduleRepositoryEloquent
     * @param ProjectRepositoryEloquent $projectRepositoryEloquent
     * @param ModuleValidator $moduleValidator
     */
    public function __construct(
        ModuleRepositoryEloquent $moduleRepositoryEloquent,
        ProjectRepositoryEloquent $projectRepositoryEloquent,
        ModuleValidator $moduleValidator
    )
    {
        parent::__construct();

        $this->moduleRepositoryEloquent = $moduleRepositoryEloquent;
        $this->projectRepositoryEloquent = $projectRepositoryEloquent;
        $this->moduleValidator = $moduleValidator;
    }

    /**
     * @param GetAllModuleRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(GetAllModuleRequest $request)
    {
        $data = $this->moduleRepositoryEloquent->getModulesByProject($this->getProject($request));

        return view('web::setting.module.index', compact('data'));
    }

    /**
     * @param CreateModuleRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(CreateModuleRequest $request)
    {
        return view('web::setting.module.create');
    }

    /**
     * @param CreateModuleRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateModuleRequest $request)
    {
        try {
            $this->moduleValidator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $request->offsetSet('project_id', $this->getProject($request)->id);
            $module = $this->moduleRepositoryEloquent->create($request->only(['project_id', 'name', 'sort']));

            event(new LogEvent($module, trans('module.log_desc.create'), 'name'));

            return redirect(route('setting_module.index', ['uuid' => $request->route('uuid')]))->with('success', trans('common.message.create_success'));
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * @param $uuid
     * @param $id
     * @param UpdateModuleRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($uuid, $id, UpdateModuleRequest $request)
    {
        $data = $this->moduleRepositoryEloquent->getModuleByProjectAndId($this->getProject($request), $id);

        return view('web::setting.module.edit', compact('data'));
    }

    /**
     * @param UpdateModuleRequest $request
     * @param $uuid
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateModuleRequest $request, $uuid, $id)
    {
        try {
            $this->moduleValidator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $module = $this->moduleRepositoryEloquent->getModuleByProjectAndId($this->getProject($request), $id);
            $this->moduleRepositoryEloquent->update($request->only(['name', 'sort']), $module->id);

            event(new LogEvent($module, trans('module.log_desc.update'), 'name'));

            return redirect(route('setting_module.index', ['uuid' => $uuid]))->with('success', trans('common.message.update_success'));
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * @param DeleteModuleRequest $request
     * @param $uuid
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DeleteModuleRequest $request, $uuid, $id)
    {
        $module = $this->moduleRepositoryEloquent->getModuleByProjectAndId($this->getProject($request), $id);
        $module->delete();

        event(new LogEvent($module, trans('module.log_desc.delete'), 'name'));

        return redirect(route('setting_module.index', ['uuid' => $uuid]))->with('success', trans('common.message.delete_success'));
    }
}
