<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

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
    public function store()
    {

    }

    //admin.category.create
    public function create()
    {

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
            $msg=['status'=>1,'msg'=>'更新成功'];
        } else {
            $msg=['status'=>0,'msg'=>'更新失败'];
        }
        return $msg;
    }
}
