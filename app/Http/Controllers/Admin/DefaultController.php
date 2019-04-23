<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class DefaultController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.default');
    }
}
