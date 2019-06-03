<?php

namespace Modules\Module\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Exceptions\AuthenticationException;
use Modules\Core\Traits\Authorize;

/**
 * Class GetAllModuleRequest
 *
 * @author  luffy007  <285276792@qq.com>
 */
class GetAllModuleRequest extends FormRequest
{
    use Authorize;

    public function authorize()
    {
        return $this->checkPermission('list_modules');
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
