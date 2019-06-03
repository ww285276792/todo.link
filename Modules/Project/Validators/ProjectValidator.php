<?php

namespace Modules\Project\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Http\Request;

/**
 * Class ProjectValidator
 *
 * @author  luffy007  <285276792@qq.com>
 */
class ProjectValidator extends LaravelValidator
{
    /**
     * ProjectValidator constructor.
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
                'name' => 'required|unique:projects,name',
                'image' => 'mimes:jpeg,png,jpg|max:1024',
            ],
            ValidatorInterface::RULE_UPDATE => [
                'name' => 'required|unique:projects,name,' . $request->route('project'),
                'image' => 'nullable|mimes:jpeg,png,jpg|max:1024',
            ],
        ]);

        self::setMessages([
            'name.required' => trans('project.validator.name_required'),
            'name.unique' => trans('project.validator.name_unique'),
            'image.mimes' => trans('project.validator.image_mimes'),
            'image.max' => trans('project.validator.image_max'),
        ]);
    }
}
