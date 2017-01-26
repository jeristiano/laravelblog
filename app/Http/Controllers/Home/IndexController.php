<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;

class IndexController extends CommonController
{
    public function index()
    {
        //点击量最高的6篇文章
        $pic = Article::orderBy('art_view', 'desc')->take(6)->get();
        //图文列表5篇
        $data = Article::orderBy('created_at', 'desc')->paginate(6);
        //友情链接
        $links = Links::orderBy('lk_order', 'asc')->get();
        return view('home.index', compact('pic', 'data', 'links'));
    }

    public function cate($cate_id)
    {
        $field = Category::find($cate_id);
        Category::where('cate_id', $cate_id)->increment('cate_view'); //查看次数自增
        $data = Article::where('cate_id', $cate_id)->orderBy('created_at', 'desc')->paginate(4);//分类下文章
        //当前分类的子分类
        $submenu = Category::where('cate_pid', $cate_id)->get();
        return view('home.list', compact('field', 'data', 'submenu'));
    }

    public function article($art_id)
    {
        $field = Article::Join('category', 'article.cate_id', '=', 'category.cate_id')->where(['art_id' => $art_id])->get()->first(); //注意 first()
        Article::where(['art_id'=>$art_id])->increment('art_view') ; //查看次数自增
        $data = Article::where('cate_id', $field->cate_id)->orderBy('art_id', 'desc')->take(2)->get(); //同类下文章
        $article['pre'] = Article::where('art_id', '<', $art_id)->orderBy('art_id', 'desc')->first(); //上一篇
        $article['next'] = Article::where('art_id', '>', $art_id)->orderBy('art_id', 'asc')->first();//下一篇
        return view('home.new', compact('field', 'article', 'data'));
    }
}
