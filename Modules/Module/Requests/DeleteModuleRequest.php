<?php

namespace Modules\Module\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Exceptions\AuthenticationException;
use Modules\Core\Traits\Authorize;

/**
 * Class DeleteModuleRequest
 *
 * @author  luffy007  <285276792@qq.com>
 */
class DeleteModuleRequest extends FormRequest
{
    use Authorize;

    public function authorize()
    {
        return $this->checkPermission('delete_modules');
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
