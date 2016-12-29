<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
    //分类列表页页面
    public function index()
    {
        $cateModel = new Category();
        $cate = $cateModel->getCateTree();
        return view('admin.category.index', ['data' => $cate]);

    }

    //admin.category.store
    public function store(Request $request)
    {
        $input=$request->except(['_token']);
        $rule = [
            'cate_name' => 'required|between:2,8',
            'cate_order' => 'required|integer'
        ];
        $message = [
            'cate_name.required' => '分类名不能为空',
            'cate_name.between' => '分类名长度在2-8个字符以内',
            'cate_order.required' => '排序不能为空',
            'cate_order.integer' => '必须为整数',
        ];
        $validator = Validator::make($input, $rule, $message);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            if(Category::create($input)){
                return redirect('admin/category')->with('success','添加成功');
            }

        }
    }

    //添加文章分类
    public function create()
    {
        $cate = Category::where(['cate_pid' => 0])->get();
        return view('admin.category.add', ['data'=>$cate]);
    }

    //admin.category.show
    public function show()
    {

    }

    //admin.category.destroy
    public function destroy()
    {

    }

    //admin.category.update
    public function update()
    {

    }

    //admin.category.edit
    public function edit()
    {

    }

    //更改排序
    public function changeOrder(Request $request)
    {
        $order = $request->input();
        $cate = Category::find($order['cate_id']);
        $cate->cate_order = $order['cate_order'];
        if ($cate->update()) {
            $msg = ['status' => 1, 'msg' => '更新成功'];
        } else {
            $msg = ['status' => 0, 'msg' => '更新失败'];
        }
        return $msg;
    }
}
