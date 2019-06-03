<?php

namespace Modules\Task\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Exceptions\AuthenticationException;
use Modules\Core\Traits\Authorize;

/**
 * Class SetTaskStatusRequest
 *
 * @author  luffy007  <285276792@qq.com>
 */
class SetTaskStatusRequest extends FormRequest
{
    use Authorize;

    public function authorize()
    {
        return $this->checkPermission('set_status_tasks');
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
