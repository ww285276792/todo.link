<?php

namespace Modules\Core\Validators;

use \Prettus\Validator\LaravelValidator;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Http\Request;

/**
 * Class SuggestValidator
 *
 * @author  luffy007  <285276792@qq.com>
 */
class SuggestValidator extends LaravelValidator
{
    /**
     * SuggestValidator constructor.
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
            'description' => 'required',
        ]);

        self::setMessages([
            'description.required' => trans('suggest.validator.description_required'),
        ]);
    }
}
