<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Navi;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;

class NaviController extends CommonController
{
    public function index()
    {

        $data = Navi::orderBy('nv_order', 'asc')->paginate(6);
        return view('admin.navi.index', ['data' => $data]);
    }

    //添加导航
    public function create()
    {
        return view('admin.navi.add');
    }

    //导航保存
    public function store(Request $request)
    {
        $input = $request->except('_token');
        $rule = [
            'nv_name' => 'required',
            'nv_order' => 'required|integer',
        ];
        $msg = [
            'nv_name.required' => '导航名称不能为空',
            'nv_order.required' => '排序不能为空',
            'nv_order.integer' => '必须为整型',
        ];
        $validate = \Validator::make($input, $rule, $msg);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        } else {
            if (Navi::create($input)) {
                return redirect('admin/navi')->with('success', '导航添加成功');
            } else {
                return redirect('admin/navi')->with('error', '导航添加失败,请重试');
            }
        }
    }

    public function edit($id)
    {
        $info = Navi::find($id);
        return view('admin.navi.edit', ['info' => $info]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->except('_method', '_token');
        $rule = [
            'nv_name' => 'required',
            'nv_order' => 'required|integer'
        ];
        $msg = [
            'nv_name.required' => '导航名称不能为空',
            'nv_order.required' => '排序不能为空',
            'nv_order.integer' => '排序必须为整型',
        ];

        $validate = validator::make($input, $rule, $msg);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        } else {
            if (Navi::where(['nv_id' => $id])->update($input)) {
                return redirect('admin/navi')->with('success', '导航修改成功');
            } else {
                return redirect('admin/navi')->with('error', '导航修改失败,请重试');
            }
        }
    }

    public function destroy($id)
    {
        $result = Navi::where('nv_id', $id)->delete();
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
        $sort = Navi::find($input['nv_id']);
        $sort->nv_order = $input['nv_order'];
        if ($sort->update()) {
            $msg = ['status' => 1, 'msg' => '更新成功'];
        } else {
            $msg = ['status' => 0, 'msg' => '更新失败'];
        }
        return $msg;
    }

}
