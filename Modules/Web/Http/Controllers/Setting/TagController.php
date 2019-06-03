<?php

namespace Modules\Web\Http\Controllers\Setting;

use App\Events\LogEvent;
use Modules\Project\Repositories\Eloquent\ProjectRepositoryEloquent;
use Modules\Project\Traits\Project;
use Modules\Tag\Repositories\Eloquent\TagRepositoryEloquent;
use Modules\Tag\Requests\CreateTagRequest;
use Modules\Tag\Requests\DeleteTagRequest;
use Modules\Tag\Requests\GetAllTagRequest;
use Modules\Tag\Requests\UpdateTagRequest;
use Modules\Tag\Validators\TagValidator;
use Modules\Web\Http\Controllers\BaseController;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class TagController
 *
 * @author  luffy007  <285276792@qq.com>
 */
class TagController extends BaseController
{
    use Project;

    /**
     * @var TagRepositoryEloquent
     */
    protected $tagRepositoryEloquent;

    /**
     * @var ProjectRepositoryEloquent
     */
    protected $projectRepositoryEloquent;

    /**
     * @var TagValidator
     */
    protected $tagValidator;

    /**
     * TagController constructor.
     *
     * @param TagRepositoryEloquent $tagRepositoryEloquent
     * @param ProjectRepositoryEloquent $projectRepositoryEloquent
     * @param TagValidator $tagValidator
     */
    public function __construct(
        TagRepositoryEloquent $tagRepositoryEloquent,
        ProjectRepositoryEloquent $projectRepositoryEloquent,
        TagValidator $tagValidator
    )
    {
        parent::__construct();

        $this->tagRepositoryEloquent = $tagRepositoryEloquent;
        $this->projectRepositoryEloquent = $projectRepositoryEloquent;
        $this->tagValidator = $tagValidator;
    }

    /**
     * @param GetAllTagRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(GetAllTagRequest $request)
    {
        $data = $this->tagRepositoryEloquent->getTagsByProject($this->getProject($request));

        return view('web::setting.tag.index', compact('data'));
    }

    /**
     * @param CreateTagRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(CreateTagRequest $request)
    {
        return view('web::setting.tag.create');
    }

    /**
     * @param CreateTagRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateTagRequest $request)
    {
        try {
            $this->tagValidator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $request->offsetSet('project_id', $this->getProject($request)->id);
            $tag = $this->tagRepositoryEloquent->create($request->only(['project_id', 'name', 'sort']));

            event(new LogEvent($tag, trans('tag.log_desc.create'), 'name'));

            return redirect(route('setting_tag.index', ['uuid' => $request->route('uuid')]))->with('success', trans('common.message.create_success'));
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * @param $uuid
     * @param $id
     * @param UpdateTagRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($uuid, $id, UpdateTagRequest $request)
    {
        $data = $this->tagRepositoryEloquent->getTagByProjectAndId($this->getProject($request), $id);

        return view('web::setting.tag.edit', compact('data'));
    }

    /**
     * @param UpdateTagRequest $request
     * @param $uuid
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateTagRequest $request, $uuid, $id)
    {
        try {
            $this->tagValidator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $tag = $this->tagRepositoryEloquent->getTagByProjectAndId($this->getProject($request), $id);
            $this->tagRepositoryEloquent->update($request->only(['name', 'sort']), $tag->id);

            event(new LogEvent($tag, trans('tag.log_desc.update'), 'name'));

            return redirect(route('setting_tag.index', ['uuid' => $uuid]))->with('success', trans('common.message.update_success'));
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * @param DeleteTagRequest $request
     * @param $uuid
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DeleteTagRequest $request, $uuid, $id)
    {
        $tag = $this->tagRepositoryEloquent->getTagByProjectAndId($this->getProject($request), $id);
        $tag->delete();

        event(new LogEvent($tag, trans('tag.log_desc.delete'), 'name'));

        return redirect(route('setting_tag.index', ['uuid' => $uuid]))->with('success', trans('common.message.delete_success'));
    }
}
