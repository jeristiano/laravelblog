<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册表单@yield('title')</title>
	<meta charset="utf-8">
	<link href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('public/static/css/general.css') }}">
	<script src="{{ asset('public/static/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('public/static/bootstrap/bootstrap.js') }}"></script>
</head>
<body>

<div class="container" >
	<div class="row" style='margin-top:10px;'>
		@include('common.message')
	</div>
	<div class="row " style='margin-top:150px;'>
		<div class=" col-md-4"></div>
		<div class=" col-md-4 frm ">
			<form class="form-horizontal form" method='post' action='' >
				{{ csrf_field() }}
				<h3 class=''>欢迎使用博客管理平台</h3>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon "><span class='glyphicon glyphicon-user'></span></div>
						<input type="text" class="form-control" name="User[name]" value="{{ old('User')['name'] }}"  placeholder="账号">
					</div>
					<div class="input-group">
						<div class="input-group-addon "><span class='glyphicon glyphicon-lock'></span></div>
						<input type="password" class="form-control" name="User[password]" value="{{ old('User')['password'] }}"  placeholder="密码">
					</div>

					<div class="input-group">
						<div class="input-group-addon "><span class='glyphicon glyphicon-check'></span></div>
						<input type="text" class="form-control" style='width:150px;'name="User[code]" value="{{ old('User')['code'] }}"  placeholder="验证码">
						<img style='padding-left:10px;' src="{{url('admin/code')}}" alt="" onclick="this.src='{{url('admin/code')}}?'+Math.random()">
					</div>
				</div>
				<button type="submit" style='height:40px;padding:4px 8px;' name='sub' class="btn btn-info btn-lg btn-block">登录</button>
			</form>
			<hr/>
		</div>
		<div class="col-md-4"></div>
	</div>
</div>
</body>
</html>