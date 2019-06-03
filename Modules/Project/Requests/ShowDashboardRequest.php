<?php

namespace Modules\Project\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Exceptions\AuthenticationException;
use Modules\Core\Traits\Authorize;

/**
 * Class ShowDashboardRequest
 *
 * @author  luffy007  <285276792@qq.com>
 */
class ShowDashboardRequest extends FormRequest
{
    use Authorize;

    public function authorize()
    {
        return $this->checkPermission('show_dashboard');
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
