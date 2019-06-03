<?php

namespace Modules\Web\Http\Controllers\User;

use Illuminate\Http\Request;
use Modules\Core\Repositories\Eloquent\SuggestRepositoryEloquent;
use Modules\Core\Validators\SuggestValidator;
use Modules\User\Validators\ResetPasswordValidator;
use Modules\Web\Http\Controllers\BaseController;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class SuggestController
 *
 * @author  luffy007  <285276792@qq.com>
 */
class SuggestController extends BaseController
{
    /**
     * @var ResetPasswordValidator
     */
    protected $suggestRepositoryEloquent;

    /**
     * @var SuggestValidator
     */
    protected $suggestValidator;

    /**
     * SuggestController constructor.
     *
     * @param SuggestRepositoryEloquent $suggestRepositoryEloquent
     * @param SuggestValidator $suggestValidator
     */
    public function __construct(
        SuggestRepositoryEloquent $suggestRepositoryEloquent,
        SuggestValidator $suggestValidator
    )
    {
        parent::__construct();

        $this->suggestRepositoryEloquent = $suggestRepositoryEloquent;
        $this->suggestValidator = $suggestValidator;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->suggestValidator->with($request->all())->passesOrFail();
            $request->offsetSet('user_id', $this->user()->id);
            $this->suggestRepositoryEloquent->create($request->only(['user_id', 'description']));

            return response()->json([
                'code' => 1,
                'message' => trans('common.message.create_success'),
            ]);
        } catch (ValidatorException $e) {
            return response()->json([
                'code' => 0,
                'message' => $e->getMessageBag()
            ]);
        }
    }
}
