<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;


require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    /*
    * 登录方法login
    * @param request
    */
    public function login(Request $request)
    {

        //判断是否为post请求

        if ($request->isMethod('POST')) {
            $validator = \Validator::make($request->input(), [
                'User.name' => 'required|min:2|max:20',
                'User.password' => 'required',
                'User.code' => 'required',

            ], [
                'required' => ':attribute不为空',
                'min:2' => ':attribute最少输入两个字符',
                'max:20' => ':attribute最多为20个字符'

            ], [
                'User.name' => '姓名',
                'User.password' => '密码',
                'User.code' => '验证码',

            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput(); //通过session 抛回上级页面$errors包括原来的数据通过old()
            }

            $input = $request->input('User');
            $_code = $this->_getCode();
            if (strtoupper($input['code']) != $_code) {
                //抛出错误通过session传回原来的页面,并通过old方法取得原来input表框的值
                return redirect()->back()->with('error', '验证码错误')->withInput();
            }
            //实例化模型

            $admin = User::first();
            if ($admin->name != $input['name'] || Crypt::decrypt($admin->password) != $input['password']) {
                return redirect()->back()->with('error', '用户名或密码错误')->withInput();
            } else {
                $request->session()->put(['admin' => $admin]);
                return redirect('admin/index');
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
