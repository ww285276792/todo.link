<?php

namespace Modules\Task\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Exceptions\AuthenticationException;
use Modules\Core\Traits\Authorize;

/**
 * Class DeleteTaskRequest
 *
 * @author  luffy007  <285276792@qq.com>
 */
class DeleteTaskRequest extends FormRequest
{
    use Authorize;

    public function authorize()
    {
        return $this->checkPermission('delete_tasks');
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
