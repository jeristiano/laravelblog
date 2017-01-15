@extends('layouts.home')
@section('info')
    <title>{{Config::get('web.web_title')}} - {{Config::get('web.seo_title')}}</title>
    <meta name="keywords" content="{{Config::get('web.keywords')}}" />
    <meta name="description" content="{{Config::get('web.description')}}" />
    @endsection
@section('content')
    <div class="banner">
        <section class="box">
            <ul class="texts">
                <p>未来是害怕的根源</p>
                <p>谁不顾未来,谁就天不怕地不怕</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;米兰·昆德拉 《慢》</p>
            </ul>
            <div class="avatar"><a href="#"><span>卡夫卡</span></a> </div>
        </section>
    </div>
    <div class="template">
        <div class="box">
            <h3>
                <p><span>博主</span>推荐 Recommend</p>
            </h3>
            <ul>
                @foreach($pic as $v)
                    <li><a href="{{url('article/'.$v->art_id)}}"  target="_blank"><img src="{{asset('storage/uploads').'/'.$v->art_thumb}}"></a><span>{{$v->art_title}}</span></li>
                    @endforeach
            </ul>
        </div>
    </div>
    <article class="blogs">
        <h2 class="title_tj">
            <p>文章<span>列表</span></p>
        </h2>
        <div class="bloglist left">
            @foreach($data as $d)
            <div class="page">
                <h3 style="text-align: left">{{$d->art_title}}</h3>
                <figure><img src="{{asset('storage/uploads').'/'.$d->art_thumb}}"></figure>
                <ul>
                    <p>{{$d->art_description}}</p>
                    <a title="{{$d->art_title}}" href="{{url('article/'.$d->art_id)}}" target="_blank" class="readmore">阅读全文>></a>
                </ul>
                <p class="dateview"><span>{{date('Y-m-d',$d->created_at)}}</span><span>作者：{{$d->art_editor}}</span></p>
            </div>
                @endforeach
                <div class="page">
                    {{$data->links()}}
                </div>
        </div>
        <aside class="right">
            <!-- Baidu Button BEGIN -->
           {{-- <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>--}}
            <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
            <script type="text/javascript" id="bdshell_js"></script>
            <script type="text/javascript">
                document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
            </script>
            <!-- Baidu Button END -->
            <div class="news" style="float:left;">
                @parent
                <h3 class="links">
                    <p>友情<span>链接</span></p>
                </h3>
                <ul class="website">
                    @foreach($links as $l)
                        <li><a href="{{$l->lk_url}}" target="_blank">{{$l->lk_name}}</a></li>
                    @endforeach
                </ul>
            </div>

        </aside>
    </article>

@endsection

