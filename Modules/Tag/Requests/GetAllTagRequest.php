<?php

namespace Modules\Tag\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Exceptions\AuthenticationException;
use Modules\Core\Traits\Authorize;

/**
 * Class GetAllTagRequest
 *
 * @author  luffy007  <285276792@qq.com>
 */
class GetAllTagRequest extends FormRequest
{
    use Authorize;

    public function authorize()
    {
        return $this->checkPermission('list_tags');
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
