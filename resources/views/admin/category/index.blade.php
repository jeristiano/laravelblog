@extends('layouts.admin')
@section('content')
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a>&raquo; 分类列表
    </div>
    <!--面包屑导航 结束-->

    {{--<!--结果页快捷搜索框 开始-->
    <div class="search_wrap">
        <form action="" method="post">
            <table class="search_tab">
                <tr>
                    <th width="120">选择分类:</th>
                    <td>
                        <select onchange="javascript:location.href=this.value;">
                            <option value="">全部</option>
                            <option value="http://www.baidu.com">百度</option>
                            <option value="http://www.sina.com">新浪</option>
                        </select>
                    </td>
                    <th width="70">关键字:</th>
                    <td><input type="text" name="keywords" placeholder="关键字"></td>
                    <td><input type="submit" name="sub" value="查询"></td>
                </tr>
            </table>
        </form>
    </div>
    <!--结果页快捷搜索框 结束-->--}}

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
                <h3>分类列表</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                    <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                    <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%"><input type="checkbox" name=""></th>
                        <th class="tc">排序</th>
                        <th class="tc">ID</th>
                        <th>分类名称</th>
                        <th>标题</th>
                        <th>查看次数</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc"><input type="checkbox" name="id[]" value="59"></td>

                        <td class="tc "><input style='width:60px;' class='order' type="text" name=ord[] data-cid="{{$v->cate_id}}" value="{{$v->cate_order}}"></td>
                        <td class="tc">{{$v->cate_id}}</td>
                        <td>
                            <a href="#">{{$v->_cate_name}}</a>
                        </td>
                        <td>{{$v->cate_title}}</td>
                        <td>{{$v->cate_view}}</td>
                        <td>
                            <a href="{{ url('admin/category/'.$v->cate_id.'/edit') }}">修改</a>
                            <a href="javascript:;" class='del_cate{{$v->cate_id}}' onclick="del_cate({{$v->cate_id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    <script>
     $(function(){
         $('.order').change(function(){
             var url="{{ url('admin/changeOrder') }}";
             var cid=$(this).attr('data-cid');
             var order=$(this).val();
             var data={'_token':'{{csrf_token()}}','cate_id':cid,'cate_order':order};
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
     var  del_cate=  function(id){
         layer.confirm('您确定要删除这个分类吗？', {
             btn: ['确定','取消'] //按钮
         },function(){
             var url ='{{ url('admin/category/')}}/'+id;
             var data={'_method':'delete','_token':"{{ csrf_token() }}"};
             $.post(url,data,function(rs){
                    if(rs.status==1){
                        $('.del_cate'+id).parent().parent().remove();
                        layer.msg(rs.msg);
                    }else{
                        layer.msg(rs.msg);
                    }

             })
         })
     }


    </script>
@endsection

