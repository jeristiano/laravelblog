<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @yield('info')
    <link href="{{asset('resources/static/css/home/base.css')}}" rel="stylesheet">
    <link href="{{asset('resources/static/css/home/index.css')}}" rel="stylesheet">
    <link href="{{asset('resources/static/css/home/style.css')}}" rel="stylesheet">
    <link href="{{asset('resources/static/css/home/new.css')}}" rel="stylesheet">
    <script src="{{asset('resources/static/js/modernizr.js')}}"></script>

</head>
<body>
<header>
    <div id="logo"><a href="{{url('/')}}"></a></div>
    <nav class="topnav" id="topnav">
        @foreach($navi as $k=>$v)<a href="{{$v->nv_url}}"><span>{{$v->nv_name}}</span><span class="en">{{$v->nv_alias}}</span></a>@endforeach
    </nav>
</header>

@section('content')
    <h3>
        <p>最新<span>文章</span></p>
    </h3>
    <ul class="rank">
        @foreach($new as $n)
            <li><a href="{{url('article/'.$n->art_id)}}" title="{{$n->art_title}}" target="_blank">{{$n->art_title}}</a></li>
        @endforeach
    </ul>
    <h3 class="ph">
        <p>点击<span>排行</span></p>
    </h3>
    <ul class="paih">
        @foreach($hot as $h)
            <li><a href="{{url('article/'.$h->art_id)}}" title="{{$h->art_title}}" target="_blank">{{$h->art_title}}</a></li>
        @endforeach
    </ul>
@show

<footer>
    <p>{!! Config::get('web.copyright') !!} {!! Config::get('web.web_count') !!}</p>
</footer>
</body>
</html>
