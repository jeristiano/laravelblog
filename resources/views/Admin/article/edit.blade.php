@extends('layouts.admin')
@section('content')
    <style>
        .edui-default{line-height: 28px;}
        div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
        {overflow: hidden; height:20px;}
        div.edui-box{overflow: hidden; height:22px;}
        .uploadify{display:inline-block;}
        .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
        table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
    </style>

    <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.all.min.js')}}"> </script>
    <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
    <script src="{{asset('resources/org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('resources/org/uploadify/uploadify.css')}}">
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="{{ url('admin/info') }}">首页</a> &raquo;  编辑文章
</div>

<div class="result_wrap">
    <div class="result_title" >
        <h3>编辑文章</h3>
        @if(count($errors)>0)
            <div class="mark" style="margin-left: 150px;width:40%;">
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                @else
                    <p>{{$errors}}</p>
                @endif
            </div>
        @endif

    </div>
    <!--快捷导航 开始-->
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
            <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
        </div>
    </div>
    <!--快捷导航 结束-->

</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form action="{{url('admin/article/'.$info->art_id)}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="put">
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>分类：</th>
                <td>
                    <select name="cate_id">
                        <option value="">请选择分类</option>
                        @foreach($data as $v)
                        <option value="{{$v->cate_id}}" @if($info->cate_id==$v->cate_id)
                        selected @endif>{{$v->_cate_name}}</option>
                       @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>文章标题：</th>
                <td>
                    <input type="text"  required name="art_title"  size='80' value="{{$info->art_title}}">
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>作者：</th>
                <td>
                    <input type="text"  required  name="art_editor" value="{{ $info->art_editor }}">
                </td>
            </tr>
            <tr>
                <th>缩略图：</th>
                <td>
                    <input type="text" size="60" name="art_thumb" value="{{ $info->art_thumb }}">
                    <input id="file_upload" name="file_upload" type="file" multiple="true" >
                    <img src="{{ asset('storage/app/public/uploads') }}/{{$info->art_thumb }}" id="art_thumb_img" class='img-thumbnail' style="max-width: 350px; max-height:100px;">
                </td>
            </tr>

            <tr>
                <th>标签：</th>
                <td>
                    <input  type="text" name="art_tag" value="{{$info->art_tag }}">
            </tr>
            <tr>
                <th>描述：</th>
                <td>
                    <input  type="text" size="80" name="art_description" value="{{$info->art_description }}">
                </td>
            </tr>

            <tr>
                <th ></th>
                <td>
                    <script id="editor" name="art_content" type="text/plain" style="width:860px;height:500px;">{!!$info->art_content !!}</script>
                    <script type="text/javascript">
                        var ue = UE.getEditor('editor');
                    </script>

                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="submit" class="btn btn-primary" value="提交">
                    <input type="button" class="back btn" onclick="history.go(-1)"  value="返回">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>

    <script type="text/javascript">
        $(function() {
            var timesamp ='{{ time() }}';
            $('#file_upload').uploadify({
                'buttonText' : '图片上传',
                'formData'     : {
                    'timestamp' : timesamp,
                    '_token'     : "{{ csrf_token()}}"
                },
                'swf'      : "{{asset('resources/org/uploadify/uploadify.swf')}}",
                'uploader' : "{{ url('admin/upload') }}",
                'onUploadSuccess' : function(file, data, response) {
                    $('input[name=art_thumb]').val(data);
                    var url ='{{ asset('storage/uploads') }}';
                    $('#art_thumb_img').attr('src',url+'/'+data);
                                  // alert(data);
                }
            });
        });
    </script>

@endsection

