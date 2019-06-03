<?php

namespace Modules\Project\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Exceptions\AuthenticationException;
use Modules\Core\Traits\Authorize;

/**
 * Class DeleteMemberRequest
 *
 * @author  luffy007  <285276792@qq.com>
 */
class DeleteMemberRequest extends FormRequest
{
    use Authorize;

    public function authorize()
    {
        return $this->checkPermission('delete_members');
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
