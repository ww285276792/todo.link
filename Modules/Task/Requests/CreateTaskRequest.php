<?php

namespace Modules\Task\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Exceptions\AuthenticationException;
use Modules\Core\Traits\Authorize;

/**
 * Class CreateTaskRequest
 *
 * @author  luffy007  <285276792@qq.com>
 */
class CreateTaskRequest extends FormRequest
{
    use Authorize;

    public function authorize()
    {
        return $this->checkPermission('create_tasks');
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
