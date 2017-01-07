@extends('layouts.admin')
@section('content')
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a>&raquo;网站配置
    </div>
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
                <h3 class="bg-info bgtitle">配置项列表</h3>
            </div>
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>添加网站配置</a>
                </div>
            </div>
        </div>
        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">ID</th>
                        <th class="tc">排序</th>
                        <th>标题</th>
                        <th>名称</th>
                        <th>类型</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">{{$v->conf_id}}</td>
                        <td class="tc "><input style='width:60px;' class='order' type="text"  data-cid="{{$v->conf_id}}" value="{{$v->conf_order}}"></td>
                        <td class="tc ">
                            <a href="#">{{$v->conf_title}}</a>
                        </td>
                        <td class="tc ">{{$v->conf_name}}</td>
                        <td class="tc "> {!!$v->_html!!}</td>
                        <td class="tc ">
                            <a href="{{ url('admin/config/'.$v->conf_id.'/edit') }}">修改</a>
                            <a href="javascript:;" class='del_config{{$v->conf_id}}' onclick="del_config({{$v->conf_id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </form>
    <script>
     $(function(){
         $('.order').change(function(){
             var url="{{ url('admin/config/changeSort') }}";
             var cid=$(this).attr('data-cid');
             var order=$(this).val();
             var data={'_token':'{{ csrf_token() }}','conf_id':cid,'conf_order':order};
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
     var  del_config=  function(id){
         layer.confirm('您确定要删除这个配置项吗？', {
             btn: ['确定','取消'] //按钮
         },function(){
             var url ='{{ url('admin/config/')}}/'+id;
             var data={'_method':'delete','_token':"{{ csrf_token() }}"};
             $.post(url,data,function(rs){
                    if(rs.status==1){
                        $('.del_config'+id).parent().parent().remove();
                        layer.msg(rs.msg);
                    }else{
                        layer.msg(rs.msg);
                    }

             })
         })
     }


    </script>
@endsection

