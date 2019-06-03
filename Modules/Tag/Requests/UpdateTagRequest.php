<?php

namespace Modules\Tag\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Exceptions\AuthenticationException;
use Modules\Core\Traits\Authorize;

/**
 * Class UpdateTagRequest
 *
 * @author  luffy007  <285276792@qq.com>
 */
class UpdateTagRequest extends FormRequest
{
    use Authorize;

    public function authorize()
    {
        return $this->checkPermission('update_tags');
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
