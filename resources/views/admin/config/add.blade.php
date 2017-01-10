@extends('layouts.admin')
@section('content')
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="{{ url('admin/info') }}">首页</a> &raquo;  添加配置项
</div>

<div class="result_wrap">
    <div class="result_title">
        <h3 class="bg-info bgtitle">添加配置项</h3>
        @if(count($errors)>0)
            <div class="mark" style="margin-left: 150px;width:40%">
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
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{ url('admin/config/create') }}"><i class="fa fa-plus"></i>添加配置项</a>
            <a href="{{ url('admin/config') }}"><i class="fa fa-list"></i>配置项列表</a>
        </div>
    </div>

</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form action="{{url('admin/config')}}" method="post">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th><i class="require">*</i>标题：</th>
                <td>
                    <input type="text" required name="conf_title" value="{{old('conf_title')}}">
                    <span><i class="fa fa-exclamation-circle yellow"></i>配置项标题必须填写</span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>名称：</th>
                <td>
                    <input type="text" required name="conf_name" value="{{old('conf_name')}}">
                    <span><i class="fa fa-exclamation-circle yellow"></i>配置项名称必须填写</span>
                </td>
            </tr>
            <tr>
                <th>类型：</th>
                <td>
                    <input type="radio" name="field_type" value="input" checked >&nbsp;input　
                    <input type="radio" name="field_type" value="textarea" >&nbsp;textarea　
                    <input type="radio" name="field_type" value="radio" >&nbsp;radio
                </td>
            </tr>
            <tr class="field_value" style="display: none">
                <th>类型值：</th>
                <td>
                    <input type="text" class="lg" name="field_value" value="{{old('field_value')}}">
                    <p><i class="fa fa-exclamation-circle yellow"></i>类型值只有在radio的情况下才需要配置，格式: 1|开启,0|关闭</p>
                </td>
            </tr>
            <tr>
                <th>排序：</th>
                <td>
                    <input type="text" class="sm" name="conf_order" value="{{old('conf_order')}}">
                </td>
            </tr>
            <tr>
                <th>说明：</th>
                <td>
                    <textarea id="" cols="30" rows="10" name="conf_tips">value="{{old('conf_tips')}}"</textarea>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="submit" class='btn btn-primary' value="提交">
                    <input type="button" class="back btn" onclick="history.go(-1)" value="返回">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
<script>
    $(function(){

         $('[name=field_type]').click(function(){
             var value =$(this).val();
             if(value=='radio'){
                 $('.field_value').show();
             }else{
                 $('.field_value').hide();
             }

         });



    })
</script>
@endsection

