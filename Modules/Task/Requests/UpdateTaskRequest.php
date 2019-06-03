<?php

namespace Modules\Task\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Exceptions\AuthenticationException;
use Modules\Core\Traits\Authorize;

/**
 * Class UpdateTaskRequest
 *
 * @author  luffy007  <285276792@qq.com>
 */
class UpdateTaskRequest extends FormRequest
{
    use Authorize;

    public function authorize()
    {
        return $this->checkPermission('update_tasks');
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
