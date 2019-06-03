<?php

namespace Modules\Module\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Exceptions\AuthenticationException;
use Modules\Core\Traits\Authorize;

/**
 * Class CreateModuleRequest
 *
 * @author  luffy007  <285276792@qq.com>
 */
class CreateModuleRequest extends FormRequest
{
    use Authorize;

    public function authorize()
    {
        return $this->checkPermission('create_modules');
    }

    protected function failedAuthorization()
    {
        throw new AuthenticationException();
    }

    public function rules()
    {
        return [];
    }

    public function messages()
    {
        return [];
    }
}
