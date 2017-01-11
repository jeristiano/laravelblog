<?php

namespace App\Http\Controllers\Home;

class IndexController extends CommonController
{
    public function index(){
        return view('home.index');
    }
}
