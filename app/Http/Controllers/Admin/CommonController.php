<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

/*
 *  公共控制器后台均继承此方法
 *
 * */
class CommonController extends Controller
{
    /*
     * 图片上传公共方法
     */
    public function upload(){
        $file = Input::file('Filedata');
        if($file -> isValid()){
            $entension = $file -> getClientOriginalExtension(); //上传文件的后缀.
            $newName = date('YmdHis').mt_rand(100,999).'.'.$entension;
            $file -> move(base_path().'/storage/app/public/uploads',$newName);
            $filepath = $newName;
            return $filepath;
        }
    }
}
