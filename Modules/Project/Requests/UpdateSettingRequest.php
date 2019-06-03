<?php

namespace Modules\Project\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Exceptions\AuthenticationException;
use Modules\Core\Traits\Authorize;

/**
 * Class UpdateSettingRequest
 *
 * @author  luffy007  <285276792@qq.com>
 */
class UpdateSettingRequest extends FormRequest
{
    use Authorize;

    public function authorize()
    {
        return $this->checkPermission('update_settings');
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
