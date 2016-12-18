@extends('common.layouts')
@section('content')
    @include('common.message')
<table class="table table-hover table-striped  table-bordered ">
    <th colspan='5' >学生列表</th>
    <tr>
        <th>ID</th>
        <th>姓名</th>
        <th>性别</th>
        <th>年龄</th>
        <th>创建时间</th>
        <th>操作</th>
    </tr>
    @foreach($student as $v)
    <tr>
        <td>{{$v->id}}</td>
        <td>{{$v->name}}</td>
        <td>{{$v->sex($v->sex)}}</td>
        <td>{{$v->age}}</td>
        <td>{{ date('Y-m-d H:i:s', $v->created_at) }}</td>
        <td>
            <a href="">详情</a>
            <a href="{{ url('student/update',['id'=>$v->id]) }}">修改</a>
            <a onclick="if(confirm('确认删除吗?')==false) return false" href="{{ url('student/delete',
            ['id'=>$v->id])
            }}">删除</a>
        </td>
        @endforeach
    </tr>
</table>
    <div>
        <div class="pull-right">
            {{ $student->render() }}
        </div>
    </div>
@stop