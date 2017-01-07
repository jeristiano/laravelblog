<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;

class ConfigController extends CommonController
{
    public function index()
    {

        $data = Config::orderBy('conf_order', 'asc')->get();
        foreach($data as $k=>$v){
            switch($v->field_type){
                case 'input':
                    $data[$k]->_html= "<input type='text' class=\"lg\" name='conf_content[]' value=".$v->conf_content.">";
                    break;
                case 'textarea':
                    $data[$k]->_html = '<textarea type="text" class="lg" name="conf_content[]">'.$v->conf_content.'</textarea>';
                    break;
                case 'radio':
                    //1|开启,0|关闭
                    $arr = explode(',',$v->field_value);
                    $str = '';
                    foreach($arr as $m=>$n){
                       $arr = explode('|',$n);
                        $checked=$v->conf_content==$arr[0]? 'checked' :'';
                        $str.='<input type="radio" name="conf_content[]" value="'.$arr[0].'" '.$checked.'>'.$arr[1].'  ';

                    }
                    $data[$k]->_html = $str;
                    break;
            }

        }

        return view('admin.config.index', ['data' => $data]);
    }

    //添加导航
    public function create()
    {
        return view('admin.config.add');
    }

    //导航保存
    public function store(Request $request)
    {
        $input = $request->except('_token');
        $rule = [
            'conf_title' => 'required',
            'conf_name' => 'required',
        ];
        $msg = [
            'conf_title.required' => '配置项标题不能为空',
            'conf_name.required' => '配置项名称不能为空',
        ];
        $validate = \Validator::make($input, $rule, $msg);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        } else {
            if (Config::create($input)) {
                return redirect('admin/config')->with('success', '配置项添加成功');
            } else {
                return redirect('admin/config')->with('error', '配置项添加失败,请重试');
            }
        }
    }

    public function edit($id)
    {
        $info = Config::find($id);
        return view('admin.config.edit', ['info' => $info]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->except('_method', '_token');
        $rule = [
            'conf_title' => 'required',
            'conf_name' => 'required',
        ];
        $msg = [
            'conf_title.required' => '配置项不能为空',
            'conf_name.required' => '配置项名称不能为空',
        ];
        $validate = validator::make($input, $rule, $msg);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        } else {
            if (Config::where(['conf_id' => $id])->update($input)) {
                return redirect('admin/config')->with('success', '配置项修改成功');
            } else {
                return redirect('admin/config')->with('error', '配置项修改失败,请重试');
            }
        }
    }

    public function destroy($id)
    {
        $result = Config::where('conf_id', $id)->delete();
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
        $sort = Config::find($input['conf_id']);
        $sort->conf_order = $input['conf_order'];
        if ($sort->update()) {
            $msg = ['status' => 1, 'msg' => '更新成功'];
        } else {
            $msg = ['status' => 0, 'msg' => '更新失败'];
        }
        return $msg;
    }

}
