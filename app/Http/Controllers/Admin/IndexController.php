<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\controller;

class IndexController extends CommonController
{
    public function index()
    {
        return view('admin.index');
    }
    //信息页面
    public function info()
    {
        return view('admin.info');
    }

}
