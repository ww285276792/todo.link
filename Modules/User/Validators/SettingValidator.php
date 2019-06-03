<?php

namespace Modules\User\Validators;

use \Prettus\Validator\LaravelValidator;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Http\Request;

/**
 * Class SettingValidator
 *
 * @author  luffy007  <285276792@qq.com>
 */
class SettingValidator extends LaravelValidator
{
    /**
     * SettingValidator constructor.
     *
     * @param Factory $validator
     * @param Request $request
     */
    public function __construct(Factory $validator, Request $request)
    {
        parent::__construct($validator);

        /**
         * @var array
         */
        self::setRules([
            'name' => 'required',
            'avatar' => 'nullable|mimes:jpeg,png,jpg|max:1024',
        ]);

        self::setMessages([
            'name.required' => trans('user.validator.name_required'),
            'avatar.mimes' => trans('user.validator.avatar_mimes'),
            'avatar.max' => trans('user.validator.avatar_max'),
        ]);
    }
}
