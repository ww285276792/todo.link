<?php

namespace Modules\Tag\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Exceptions\AuthenticationException;
use Modules\Core\Traits\Authorize;

/**
 * Class DeleteTagRequest
 *
 * @author  luffy007  <285276792@qq.com>
 */
class DeleteTagRequest extends FormRequest
{
    use Authorize;

    public function authorize()
    {
        return $this->checkPermission('delete_tags');
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
