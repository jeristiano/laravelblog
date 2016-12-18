<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>轻松学会-@yield('title')</title>
    <link href="{{asset('static/bootstrap/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('static/common/common.css')}}" rel="stylesheet">
    <script src="{{asset('static/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('static/bootstrap/bootstrap.js')}}"></script>
    @section('style')

    @show

</head>

<body>
@section('header')
    <div class="container-fluid">
        <div class="row title">
            <div class='col-md-1 '></div>
            <div class="col-md-11">
                <h3>优雅的PHP框架</h3>
                <h4>A Web Framework for PHP Artisan</h4>
            </div>
        </div>
    </div>
    @show
<div class="container">
    <div class="row">
        <!--   左侧边栏 -->
        <div class="col-md-3 left-side">
            @section('leftsidebar')
                <div class="panel panel-primary" >
                    <div class="panel-heading" >
                        <h3 class="panel-title">
                            学生管理
                        </h3>
                    </div>

                    <ul class="list-group">
                        <a class="list-group-item {{ Request::getPathInfo()=='/student/index' ? 'active' : '' }}" href="{{ url('student/index') }}">学生列表</a>
                        <a class="list-group-item  {{ Request::getPathInfo()=='/student/create' ? 'active' : '' }}" href="{{ url('student/create')
                        }}">学生添加</a>
                    </ul>
                </div>
            @show
        </div>
        <!--自定义内容区域-->
        <div class="col-md-9 right-side">
            @yield('content')

        </div>
    </div>
</div>
    @section('javascript')
    @section('footer')
        <div class="container-fluid">
            <div class="row title">
                <div class='col-md-1 '></div>
                <div class="col-md-11" >
                  <span style="line-height:150px;"><i class="btn btn-primary">about me</i></span>
                </div>
            </div>
        </div>
        @show

</body>
</html>