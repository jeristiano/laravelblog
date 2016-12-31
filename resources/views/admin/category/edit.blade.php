@extends('layouts.admin')
@section('content')
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo;  编辑文章分类
    </div>

    <div class="result_wrap">
        <div class="result_title">
            <h3>编辑文章分类</h3>
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
                <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>

    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/category/'.$info->cate_id)}}"  method="post"  >
            <input type="hidden" name='_method' value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="120"><i class="require">*</i>分类：</th>
                    <td>
                        <select name="cate_pid">
                            <option value="0">==顶级分类==</option>
                            @foreach($data as $v)
                                <option value="{{$v->cate_id}}"
                                @if($info->cate_pid==$v->cate_id) selected @endif >{{$v->cate_name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>分类名称：</th>
                    <td>
                        <input type="text" name="cate_name" value={{ $info->cate_name }}>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>排序：</th>
                    <td>
                        <input type="text" class="sm" name="cate_order" value="{{ $info->cate_order }}">
                    </td>
                </tr>

                <tr>
                    <th>分类标题：</th>
                    <td>
                        <input type='text' name="cate_title" value="{{ $info->cate_title }}">
                    </td>
                </tr>
                <tr>
                    <th>关键词：</th>
                    <td>
                        <input  type="text" name="cate_keywords" value="{{ $info->cate_keywords }}">
                </tr>


                <tr>
                    <th>描述：</th>
                    <td>
                        <textarea class="lg" name="cate_description" >{{ $info->cate_description }}</textarea>
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
@endsection

