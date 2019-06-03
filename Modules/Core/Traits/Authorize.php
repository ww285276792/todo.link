<?php

namespace Modules\Core\Traits;

use Illuminate\Support\Facades\Auth;
use Modules\User\Entities\User;

/**
 * Trait Authorize
 *
 * @author  luffy007  <285276792@qq.com>
 */
trait Authorize
{
    /**
     * @param $name
     *
     * @return bool
     */
    public function checkPermission($name)
    {
        /**
         * @var User $user
         */
        $user = Auth::guard('web')->user();
        $project = $user->projects()->where('uuid', \request()->route('uuid'))->first();

        if ($user->can($name . $project->id)) {
            return true;
        }

        return false;
    }
}
