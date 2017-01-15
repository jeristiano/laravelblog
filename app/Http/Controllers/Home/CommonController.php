<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Navi;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Navs;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    public function __construct()
    {
        $navi =Navi::all(); //分类公共部分
        $new = Article::orderBy('created_at','desc')->take(8)->get();
        //点击量最高的6篇文章
        $hot = Article::orderBy('art_view','desc')->take(5)->get();
        View::share('navi',$navi);  //参数共享到每个页面
        View::share('new',$new);  //参数共享到每个页面
        View::share('hot',$hot);  //参数共享到每个页面
    }
}
