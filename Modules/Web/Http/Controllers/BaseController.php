<?php

namespace Modules\Web\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Core\Entities\Permission;
use Modules\Project\Entities\Project;
use Modules\User\Entities\User;

/**
 * Class BaseController
 *
 * @author  luffy007  <285276792@qq.com>
 */
class BaseController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth.web');
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        return Auth::guard('web')->user();
    }

    /**
     * @return mixed
     */
    public function userId()
    {
        return $this->user()->id;
    }
}
