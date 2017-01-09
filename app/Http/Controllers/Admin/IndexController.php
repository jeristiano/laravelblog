<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


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

    //注销操作
    public function logout()
    {
        session(['admin' => null]);
        return redirect('admin/login');
    }

    //修改密码
    public function passwordMd(Request $request)
    {
        if ($request->isMethod('POST')) {
            $input = $request->input();
            $rule = [
                'newpwd' => 'required|between:6,20|confirmed'
            ];
            $message = [
                'required' => '新密码不能为空',
                'between' => '新密码必须在6-20位之间!',
                'confirmed' => '两次密码不一致'
            ];
            $validator = Validator::make($input, $rule, $message);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $user = User::first();
                $password = Crypt::decrypt($user->password);
                if ($password != $input['oldpwd']) {
                    return redirect()->back()->with('error', '原密码输入错误');
                } else {
                    $user->password = Crypt::encrypt($input['newpwd']);
                    $user->update();
                    return redirect('admin/info')->with('success', '密码修改成功');
                }
            }
        }
        return view('admin.passwordMd');
    }


}
