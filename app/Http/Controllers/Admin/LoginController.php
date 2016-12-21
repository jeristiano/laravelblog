<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Symfony\Component\HttpFoundation\Request;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    /*
    *   登录方法login
    * @param request
    */
    public function login(Request $request)
    {
        //判断是否为post请求
        if ($request->isMethod('POST')) {
            $user = $request->input('User');

            $_code = $this->_getCode();
            if (strtoupper($user['code'] )!= $_code) {
                //抛出错误通过session传回原来的页面,并通过old方法取得原来input表框的值
                return redirect()->back()->with('error', '验证码错误')->withInput();
            }
        }
        return view('admin.login');
    }

    //验证码
    public function code()
    {
        $code = new \Code;
        return $code->make();
    }

    //获取验证码
    private function _getCode()
    {
        $code = new \Code;
        return $code->get();
    }
}
