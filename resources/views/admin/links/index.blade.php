@extends('layouts.admin')
@section('content')
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a>&raquo;友情链接列表
    </div>
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
                <h3 class="bg-info bgtitle">链接列表</h3>
            </div>
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>添加链接</a>
                </div>
            </div>
        </div>
        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">ID</th>
                        <th class="tc">排序</th>
                        <th>链接名称</th>
                        <th>标题</th>
                        <th>链接网址</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>

                        <td class="tc">{{$v->lk_id}}</td>
                        <td class="tc "><input style='width:60px;' class='order' type="text"  data-cid="{{$v->lk_id}}" value="{{$v->lk_order}}"></td>
                        <td>
                            <a href="#">{{$v->lk_name}}</a>
                        </td>
                        <td>{{$v->lk_title}}</td>
                        <td>{{$v->lk_url}}</td>
                        <td>
                            <a href="{{ url('admin/links/'.$v->lk_id.'/edit') }}">修改</a>
                            <a href="javascript:;" class='del_link{{$v->lk_id}}' onclick="del_link({{$v->lk_id}})">删除</a>
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
     $(function(){
         $('.order').change(function(){
             var url="{{ url('admin/changeSort') }}";
             var cid=$(this).attr('data-cid');
             var order=$(this).val();
             var data={'_token':'{{ csrf_token() }}','lk_id':cid,'lk_order':order};
               if(!isNaN(order)){
                   $.post(url,data,function(rs){
                       if(rs.status==1){
                           layer.msg(rs.msg);
                       }else{
                           layer.msg(rs.msg);
                       }
                   })
           }else {
                   layer.msg('必须为数字');
               }


         })
        //添加成功信息
        var session ='{{Session::has('success')}}';
         var msg='{{ Session::get('success') }}'
         if(session){
             layer.msg(msg);
         }

         //添加成功信息
         var session1 ='{{Session::has('error')}}';
         var msg='{{ Session::get('error') }}'
         if(session1){
             layer.msg(msg);
         }

     })
     //删除分类
     var  del_link=  function(id){
         layer.confirm('您确定要删除这个链接吗？', {
             btn: ['确定','取消'] //按钮
         },function(){
             var url ='{{ url('admin/links/')}}/'+id;
             var data={'_method':'delete','_token':"{{ csrf_token() }}"};
             $.post(url,data,function(rs){
                    if(rs.status==1){
                        $('.del_link'+id).parent().parent().remove();
                        layer.msg(rs.msg);
                    }else{
                        layer.msg(rs.msg);
                    }

             })
         })
     }


    </script>
@endsection

