<?php

namespace Modules\Tag\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Exceptions\AuthenticationException;
use Modules\Core\Traits\Authorize;

/**
 * Class CreateTagRequest
 *
 * @author  luffy007  <285276792@qq.com>
 */
class CreateTagRequest extends FormRequest
{
    use Authorize;

    public function authorize()
    {
        return $this->checkPermission('create_tags');
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
