@extends('layouts.admin')

@section('content')
<!--面包屑导航 开始-->
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a>
    </div>

<!--结果集标题与导航组件 结束-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>系统基本信息</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>操作系统</label><span>{{PHP_OS}}</span>
                </li>
                <li>
                    <label>运行环境</label><span>{{ $_SERVER['SERVER_SOFTWARE'] }}</span>
                </li>

                <li>
                    <label>上传附件限制</label><span>{{ get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许上传附件" }}</span>
                </li>
                <li>
                    <label>北京时间</label><span>{{ date('Y年m月d日 H时i分s秒',time()) }}</span>
                </li>
                <li>
                    <label>服务器域名/IP</label><span>{{ $_SERVER['SERVER_NAME'] }} | {{ $_SERVER['SERVER_ADDR'] }}</span>
                </li>

            </ul>
        </div>
    </div>
    <div class="result_wrap">
        <div class="result_title">
            <h3>个人信息</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>github：</label><span><a target="_blank" href="https://github.com/jeristiano">https://github.com/jeristiano</a></span>
                </li>

            </ul>
        </div>
    </div>
@endsection
