<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

/*======================================
 * 文章的增删改查类
 * 使用resoure资源路由
 *======================================
 */
class ArticleController extends CommonController
{

    //文章展示
    public function index()
    {
        $data = Article::orderBy('art_id', 'desc')->paginate(8);
        foreach ($data as $k => $v) {
            $data[$k]['cate_name'] = Category::getCateName($v->cate_id);
        }
        return view('admin.article.index', ['data' => $data]);
    }

    //添加文章
    public function create()
    {
        $model = new Category;
        $data = $model->getCateTree();
        return view('admin.article.add', ['data' => $data]);
    }

    //文章保存
    public function store(Request $request)
    {
        $input = $request->except('_token');
        $rule = [
            'cate_id' => 'required',
            'art_title' => 'required',
            'art_editor' => 'required',
            'art_content' => 'required'
        ];
        $msg = [
            'cate_id.required' => '请选择文章分类',
            'art_title.required' => '文章标题不能为空',
            'art_editor.required' => '作者不能为空',
            'art_content.required' => '文章内容不能为空',
        ];
        $validate = Validator::make($input, $rule, $msg);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        } else {
            if (Article::create($input)) {
                return redirect('admin/article')->with('success', '文章添加成功');
            } else {
                return redirect('admin/article')->with('error', '文章添加失败,请重试');
            }
        }
    }

    //文章编辑
    public function edit($art_id)
    {
        $model = new Category;
        $data = $model->getCateTree();
        $info = Article::find($art_id);
        return view('admin.article.edit', ['data' => $data, 'info' => $info]);

    }

    //文章分类更新
    public function update(Request $request, $id)
    {

        $input = $request->except('_method', '_token');
        $rule = [
            'cate_id' => 'required',
            'art_title' => 'required',
            'art_editor' => 'required',
            'art_content' => 'required'
        ];
        $msg = [
            'cate_id.required' => '请选择文章分类',
            'art_title.required' => '文章标题不能为空',
            'art_editor.required' => '作者不能为空',
            'art_content.required' => '文章内容不能为空',
        ];
        $validate = validator::make($input, $rule, $msg);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        } else {
           $picLink = Article::where('art_id', $id)->value('art_thumb');//查原图片路径
            $result = Article::where(['art_id' => intval($id)])->update($input);
            if ($result) {
                if ($picLink!=$input['art_thumb']) {
                    Storage::delete(asset('storage/app/public/uploads').'/'.$picLink);//删除原图片地址
                }
                return redirect('admin/article')->with('success', '文章修改成功');
            } else {
                return redirect('admin/article')->with('error', '文章修改失败,请重试');
            }
        }
    }

    //删除文章
    public function destroy($id)
    {

        $result = Article::where('art_id', $id)->delete();
        if ($result) {
            $msg = [
                'status' => 1,
                'msg' => '删除成功'
            ];
            $picLink = Article::where('art_id', $id)->value('art_thumb');
            if ($picLink) {
                Storage::delete(asset('storage/app/public/uploads').'/'.$picLink);//删除原图片地址
            }

        } else {
            $msg = [
                'status' => 0,
                'msg' => '删除失败'
            ];
        }
        return $msg;
    }


}
