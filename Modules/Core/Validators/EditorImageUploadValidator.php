<?php

namespace Modules\Core\Validators;

use \Prettus\Validator\LaravelValidator;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Http\Request;

/**
 * Class EditorImageUploadValidator
 *
 * @author  luffy007  <285276792@qq.com>
 */
class EditorImageUploadValidator extends LaravelValidator
{
    /**
     * EditorImageUploadValidator constructor.
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
            'upload' => 'required|mimes:jpeg,png,jpg|max:1024',
        ]);

        self::setMessages([
            'upload.required' => trans('task.validator.upload_required'),
            'upload.mimes' => trans('task.validator.upload_mimes'),
            'upload.max' => trans('task.validator.upload_max'),
        ]);
    }
}
