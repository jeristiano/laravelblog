<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;

class LinksController extends CommonController
{
    public function index()
    {

        $data = Links::orderBy('lk_order', 'asc')->paginate(6);
        return view('admin.links.index', ['data' => $data]);
    }

    //添加链接
    public function create()
    {
        return view('admin.links.add');
    }

    //链接保存
    public function store(Request $request)
    {
        $input = $request->except('_token');
        $rule = [
            'lk_name' => 'required',
            'lk_order' => 'required|integer',
        ];
        $msg = [
            'lk_name.required' => '链接名称不能为空',
            'lk_order.required' => '排序不能为空',
            'lk_order.integer' => '必须为整型',
        ];
        $validate = \Validator::make($input, $rule, $msg);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        } else {
            if (Links::create($input)) {
                return redirect('admin/links')->with('success', '链接添加成功');
            } else {
                return redirect('admin/links')->with('error', '链接添加成功添加失败,请重试');
            }
        }
    }

    public function edit($id)
    {
        $info = Links::find($id);
        return view('admin.links.edit', ['info' => $info]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->except('_method', '_token');
        $rule = [
            'lk_name' => 'required',
            'lk_order' => 'required|integer',
        ];
        $msg = [
            'lk_name.required' => '链接名称不能为空',
            'lk_order.required' => '排序不能为空',
            'lk_order.integer' => '必须为整型',
        ];

        $validate = validator::make($input, $rule, $msg);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        } else {
            if (Links::where(['lk_id' => $id])->update($input)) {
                return redirect('admin/links')->with('success', '链接修改成功');
            } else {
                return redirect('admin/links')->with('error', '链接修改失败,请重试');
            }
        }
    }

    public function destroy($id)
    {
        $result = Links::where('lk_id', $id)->delete();
        if ($result) {
            $msg = [
                'status' => 1,
                'msg' => '删除成功'
            ];
        } else {
            $msg = [
                'status' => 0,
                'msg' => '删除失败'
            ];
        }
        return $msg;
    }
    //ajax修改排序
    public function changeSort(Request $request){
        $input= $request->input();
        $sort = Links::find($input['lk_id']);
        $sort->lk_order = $input['lk_order'];
        if ($sort->update()) {
            $msg = ['status' => 1, 'msg' => '更新成功'];
        } else {
            $msg = ['status' => 0, 'msg' => '更新失败'];
        }
        return $msg;
    }

}
