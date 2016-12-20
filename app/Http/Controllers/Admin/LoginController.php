<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    public function login()
    {

        return view('admin.login');
    }

    //验证码
    public function code()
    {
        $code = new \Code;
        return $code->make();
    }

    //获取验证码
    public function getCode()
    {
        $code = new \Code;
        return $code->get();
    }
}
