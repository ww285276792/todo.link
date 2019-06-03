<?php

namespace Modules\Module\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Exceptions\AuthenticationException;
use Modules\Core\Traits\Authorize;

/**
 * Class UpdateModuleRequest
 *
 * @author  luffy007  <285276792@qq.com>
 */
class UpdateModuleRequest extends FormRequest
{
    use Authorize;

    public function authorize()
    {
        return $this->checkPermission('update_modules');
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
