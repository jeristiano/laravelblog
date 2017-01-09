@extends('layouts.admin')
        @section('content')

    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="{{ url('admin/info') }}">首页</a> &raquo;  文章列表
    </div>

    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
                <h3>文章列表</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{ url('admin/article/create') }}"><i class="fa fa-plus"></i>新增文章</a>
                    <a href="{{ url('admin/category/create') }}"><i class="fa fa-plus"></i>新增文章分类</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">ID</th>
                        <th>标题</th>
                        <th>分类</th>
                        <th>作者 </th>
                        <th>点击</th>
                        <th>发布时间</th>
                        <th>修改时间</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">{{ $v->art_id }}</td>
                        <td>
                            <a href="#">{{ $v->art_title }}</a>
                        </td>
                        <td>{{ $v->cate_name }}</td>
                        <td>{{ $v->art_editor }}</td>
                        <td>{{ $v->art_view }}</td>
                        <td>{{ date('Y-m- H:i:s',$v->created_at )}}</td>
                        <td>{{ date('Y-m- H:i:s',$v->updated_at )}}</td>
                        <td>
                            <a href="{{ url('admin/article/'.$v->art_id.'/edit') }}">修改</a>
                            <a href="javascript:;" class='del_art{{$v->art_id}}' onclick="del_art({{$v->art_id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="pagination">
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </form>
<script>

 function del_art(id){
     layer.confirm('您确定要删除这篇文章吗？', {
         btn: ['确定','取消'] //按钮
     },function(){
         var url ='{{ url('admin/article') }}/'+id;
         var data ={'_method':'delete','_token':'{{ csrf_token()}}'};
         $.post(url,data,function(rs){
             if(rs.status==1){
                $('.del_art'+id).parent().parent().remove();
                 layer.msg(rs.msg);
             }else{
                 layer.msg(rs.msg);
             }
         })
     })

    }


    //添加成功信息
    var session ='{{Session::has('success')}}';
    var msg='{{ Session::get('success') }}'
    if(session){
        layer.msg(msg);
    }

    //添加失败信息
    var session1 ='{{Session::has('error')}}';
    var msg='{{ Session::get('error') }}'
    if(session1){
        layer.msg(msg);
    }

</script>
    <!--搜索结果页面 列表 结束-->
@endsection