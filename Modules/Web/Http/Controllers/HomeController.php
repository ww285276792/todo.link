<?php

namespace Modules\Web\Http\Controllers;

use App\Http\Controllers\Controller;

/**
 * Class HomeController
 *
 * @author  luffy007  <285276792@qq.com>
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('web::home.index');
    }
}
