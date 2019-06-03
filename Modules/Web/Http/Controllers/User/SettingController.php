<?php

namespace Modules\Web\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Core\Services\ImageService;
use Modules\User\Entities\User;
use Modules\User\Repositories\Eloquent\UserRepositoryEloquent;
use Modules\User\Validators\ResetPasswordValidator;
use Modules\User\Validators\SettingValidator;
use Modules\Web\Http\Controllers\BaseController;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class SettingController
 *
 * @author  luffy007  <285276792@qq.com>
 */
class SettingController extends BaseController
{
    /**
     * @var ResetPasswordValidator
     */
    protected $settingValidator;

    /**
     * @var ImageService
     */
    protected $imageService;

    /**
     * SettingController constructor.
     *
     * @param SettingValidator $settingValidator
     * @param ImageService $imageService
     */
    public function __construct(
        SettingValidator $settingValidator,
        ImageService $imageService
    )
    {
        parent::__construct();

        $this->settingValidator = $settingValidator;
        $this->imageService = $imageService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $data = $this->user();

        return view('web::user.edit', compact('data'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        try {
            $this->settingValidator->with($request->all())->passesOrFail();
            /**
             * @var User $user
             */
            $user = $this->user();

            $path = '';
            if ($request->hasFile('avatar')) {
                $path = $this->imageService->upload('avatar', $request);
            }
            $user->name = $request->input('name');
            if ($path) {
                $user->avatar = '/storage/' . $path;
            }
            $user->save();

            return redirect(route('user_setting.edit'))->with('success', trans('common.message.update_success'));
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }
}
