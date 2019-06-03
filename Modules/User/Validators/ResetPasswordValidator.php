<?php

namespace Modules\User\Validators;

use \Prettus\Validator\LaravelValidator;

/**
 * Class ResetPasswordValidator
 *
 * @author  luffy007  <285276792@qq.com>
 */
class ResetPasswordValidator extends LaravelValidator
{
    protected $rules = [
        'old_password' => 'required|string',
        'new_password' => 'required|string|min:6|confirmed',
    ];
}
