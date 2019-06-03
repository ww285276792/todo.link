<?php

namespace Modules\Admin\Http\Controllers\Auth;

use App\Http\Controllers\Admin\BaseController;
use App\Repositories\Eloquent\AdminUserRepositoryEloquent;
use App\Validators\AdminResetPasswordValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ResetPasswordController
 * @package Modules\Admin\Http\Controllers\Auth
 */
class ResetPasswordController extends BaseController
{
    /**
     * @var AdminResetPasswordValidator
     */
    protected $adminResetPasswordValidator;

    /**
     * @var AdminUserRepositoryEloquent
     */
    protected $adminUserRepositoryEloquent;

    /**
     * ResetPasswordController constructor.
     * @param AdminResetPasswordValidator $adminResetPasswordValidator
     * @param AdminUserRepositoryEloquent $adminUserRepositoryEloquent
     */
    public function __construct(
        AdminResetPasswordValidator $adminResetPasswordValidator,
        AdminUserRepositoryEloquent $adminUserRepositoryEloquent
    )
    {
        parent::__construct();

        $this->adminResetPasswordValidator = $adminResetPasswordValidator;
        $this->adminUserRepositoryEloquent = $adminUserRepositoryEloquent;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm()
    {
        return view('admin::auth.reset_password');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        try {
            $this->adminResetPasswordValidator->with($request->all())->passesOrFail();

            if (Hash::check($request->get('old_password'), $request->user('admin')->password)) {
                $this->adminUserRepositoryEloquent->update(
                    ['password' => bcrypt($request->get('new_password'))],
                    $request->user('admin')->id
                );

                return redirect(route('admin_password.reset'))->with('success', trans('common.update_success'));
            }

            return redirect()->back()->withInput()->with('error', trans('auth.old_password_failed'));
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }
}
