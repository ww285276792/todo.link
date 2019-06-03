<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;

/**
 * Class BaseController
 * @package App\Http\Controllers\Admin
 */
class BaseController extends Controller
{
    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth.admin');

        app('config')->set('activitylog.default_auth_driver', 'admin');
    }
}
