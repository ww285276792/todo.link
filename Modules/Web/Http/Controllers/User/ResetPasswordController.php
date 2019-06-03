<?php

namespace Modules\Web\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\User\Repositories\Eloquent\UserRepositoryEloquent;
use Modules\User\Validators\ResetPasswordValidator;
use Modules\Web\Http\Controllers\BaseController;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ResetPasswordController
 *
 * @author  luffy007  <285276792@qq.com>
 */
class ResetPasswordController extends BaseController
{
    /**
     * @var ResetPasswordValidator
     */
    protected $resetPasswordValidator;

    /**
     * @var UserRepositoryEloquent
     */
    protected $userRepositoryEloquent;

    /**
     * ResetPasswordController constructor.
     *
     * @param ResetPasswordValidator $resetPasswordValidator
     * @param UserRepositoryEloquent $userRepositoryEloquent
     */
    public function __construct(
        ResetPasswordValidator $resetPasswordValidator,
        UserRepositoryEloquent $userRepositoryEloquent
    )
    {
        parent::__construct();

        $this->resetPasswordValidator = $resetPasswordValidator;
        $this->userRepositoryEloquent = $userRepositoryEloquent;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm()
    {
        return view('web::user.reset_password');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        try {
            $this->resetPasswordValidator->with($request->all())->passesOrFail();

            if (Hash::check($request->get('old_password'), $request->user('web')->password)) {
                $this->userRepositoryEloquent->update(
                    ['password' => bcrypt($request->get('new_password'))],
                    $request->user('web')->id
                );

                return redirect(route('user_password.reset'))->with('success', trans('common.message.update_success'));
            }

            return redirect()->back()->withInput()->with('error', trans('auth.old_password_failed'));
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }
}
