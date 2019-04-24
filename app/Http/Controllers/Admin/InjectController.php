<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class InjectController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function navigation()
    {
        //从abilities表中查询顶部导航
        return view('admin.layouts.navigation');
    }

    /**
     * @param $parentId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sidebar($parentId){
        return view('admin.layouts.sidebar');
    }
}
