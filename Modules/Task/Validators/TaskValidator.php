<?php

namespace Modules\Task\Validators;

use \Prettus\Validator\LaravelValidator;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Http\Request;

/**
 * Class TaskValidator
 *
 * @author  luffy007  <285276792@qq.com>
 */
class TaskValidator extends LaravelValidator
{
    /**
     * TaskValidator constructor.
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
            'title' => 'required',
            'module_id' => 'required',
            'due_date' => 'nullable|date_format:Y-m-d',
        ]);

        self::setMessages([
            'title.required' => trans('task.validator.title_required'),
            'module_id.required' => trans('task.validator.module_id_required'),
            'due_date.due_date' => trans('task.validator.due_date_date_format'),
        ]);
    }
}
