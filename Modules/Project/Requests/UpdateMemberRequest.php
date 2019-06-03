<?php

namespace Modules\Project\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Exceptions\AuthenticationException;
use Modules\Core\Traits\Authorize;

/**
 * Class UpdateMemberRequest
 *
 * @author  luffy007  <285276792@qq.com>
 */
class UpdateMemberRequest extends FormRequest
{
    use Authorize;

    public function authorize()
    {
//        if (Auth::guard('web')->user()->id == request('member')) {
//            return false;
//        }

        return $this->checkPermission('update_members');
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
