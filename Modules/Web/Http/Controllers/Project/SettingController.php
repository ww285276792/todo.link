<?php

namespace Modules\Web\Http\Controllers\Project;

use App\Events\LogEvent;
use Modules\Core\Services\ImageService;
use Modules\Project\Repositories\Eloquent\ProjectRepositoryEloquent;
use Modules\Project\Requests\UpdateSettingRequest;
use Modules\Project\Validators\ProjectValidator;
use Modules\Web\Http\Controllers\BaseController;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class SettingController
 *
 * @author  luffy007  <285276792@qq.com>
 */
class SettingController extends BaseController
{
    /**
     * @var ProjectValidator
     */
    protected $projectValidator;

    /**
     * @var ImageService
     */
    protected $imageService;

    /**
     * @var ProjectRepositoryEloquent
     */
    protected $projectRepositoryEloquent;

    /**
     * SettingController constructor.
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
     * @param UpdateSettingRequest $request
     * @param $uuid
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(UpdateSettingRequest $request, $uuid)
    {
        $data = $this->projectRepositoryEloquent->getProjectByUuid($uuid);

        return view('web::project.setting', compact('data'));
    }

    /**
     * @param UpdateSettingRequest $request
     * @param $uuid
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSettingRequest $request, $uuid, $id)
    {
        try {
            $this->projectValidator->with($request->input())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $project = $this->projectRepositoryEloquent->getProjectByUuidAndId($uuid, $id);

            if ($request->hasFile('image')) {
                $path = $this->imageService->upload('image', $request);
                $request->offsetSet('logo', '/storage/' . $path);
            }

            $this->projectRepositoryEloquent->update($request->only(['name', 'description', 'logo']), $project->id);

            event(new LogEvent($project, trans('project.log_desc.update'), 'name'));

            return redirect(route('setting.edit', ['uuid' => $uuid]))->with('success', trans('common.message.update_success'));
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * @param UpdateSettingRequest $request
     * @param $uuid
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(UpdateSettingRequest $request, $uuid, $id)
    {
        $project = $this->projectRepositoryEloquent->getOwnProjectByUuidAndId($this->userId(), $uuid, $id);
        $project->delete();

        event(new LogEvent($project, trans('project.log_desc.delete'), 'name'));

        return redirect(route('project.index'))->with('success', trans('common.message.delete_success'));
    }
}
