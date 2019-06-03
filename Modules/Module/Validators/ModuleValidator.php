<?php

namespace Modules\Module\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Http\Request;

/**
 * Class ModuleValidator
 *
 * @author  luffy007  <285276792@qq.com>
 */
class ModuleValidator extends LaravelValidator
{
    /**
     * ModuleValidator constructor.
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
            ValidatorInterface::RULE_CREATE => [
                'name' => 'required',
                'sort' => 'required|integer',
            ],
            ValidatorInterface::RULE_UPDATE => [
                'name' => 'required',
                'sort' => 'required|integer',
            ],
        ]);

        self::setMessages([
            'name.required' => trans('module.validator.name_required'),
            'sort.required' => trans('module.validator.sort_required'),
            'sort.integer' => trans('module.validator.sort_integer'),
        ]);
    }
}
