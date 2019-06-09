<?php

namespace Modules\Web\Http\Controllers\Project;

use Illuminate\Support\Facades\Storage;
use Modules\Core\Services\EditorImageService;
use Modules\Core\Validators\EditorImageUploadValidator;
use Modules\Project\Repositories\Eloquent\ProjectRepositoryEloquent;
use Modules\Task\Requests\CreateTaskRequest;
use Modules\Web\Http\Controllers\BaseController;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ImageController
 *
 * @author  luffy007  <285276792@qq.com>
 */
class ImageController extends BaseController
{
    /**
     * @var ProjectRepositoryEloquent
     */
    protected $projectRepositoryEloquent;

    /**
     * @var EditorImageUploadValidator
     */
    protected $editorImageUploadValidator;

    /**
     * @var EditorImageService
     */
    protected $editorImageService;

    /**
     * ImageController constructor.
     *
     * @param ProjectRepositoryEloquent $projectRepositoryEloquent
     * @param EditorImageUploadValidator $editorImageUploadValidator
     * @param EditorImageService $editorImageService
     */
    public function __construct(
        ProjectRepositoryEloquent $projectRepositoryEloquent,
        EditorImageUploadValidator $editorImageUploadValidator,
        EditorImageService $editorImageService
    )
    {
        parent::__construct();

        $this->projectRepositoryEloquent = $projectRepositoryEloquent;
        $this->editorImageUploadValidator = $editorImageUploadValidator;
        $this->editorImageService = $editorImageService;
    }

    /**
     * @param CreateTaskRequest $request
     * @param $uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(CreateTaskRequest $request, $uuid)
    {
        try {
            $this->editorImageUploadValidator->with($request->all())->passesOrFail();
            $path = $this->editorImageService->upload('upload', $request, $uuid);

            return response()->json([
                "uploaded" => 1,
                "fileName" => $path,
                "url" => '/project/' . $uuid . '/image/' . $path
            ]);
        } catch (ValidatorException $e) {
            return response()->json([
                'uploaded' => 0,
                'error' => [
                    'message' => $e->getMessageBag()->first()
                ]
            ]);
        }
    }

    /**
     * @param CreateTaskRequest $request
     * @param $uuid
     * @param $id
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function showImage(CreateTaskRequest $request, $uuid, $id)
    {
        return response(Storage::get($uuid . '/' . $id));
    }
}
