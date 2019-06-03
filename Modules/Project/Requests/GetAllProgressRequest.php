<?php

namespace Modules\Project\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Exceptions\AuthenticationException;
use Modules\Core\Traits\Authorize;

/**
 * Class GetAllProgressRequest
 *
 * @author  luffy007  <285276792@qq.com>
 */
class GetAllProgressRequest extends FormRequest
{
    use Authorize;

    public function authorize()
    {
        return $this->checkPermission('list_progress');
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
