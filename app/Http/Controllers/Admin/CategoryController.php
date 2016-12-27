<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends CommonController
{
    //分类列表页页面
    public function index(){
        $cate = Category::all();
        return view('admin.category.index',['data'=>$cate]);

    }
    //admin.category.store
    public function store(){

    }
    //admin.category.create
    public function create(){

    }
    //admin.category.show
    public function show(){

    }

    //admin.category.destroy
    public function destroy(){

    }
    //admin.category.update
    public function update(){

    }
    //admin.category.edit
    public function edit(){

    }
}
