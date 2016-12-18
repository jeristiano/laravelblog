@extends('common.layouts')
@section('content')
    @include('common.message')
    <div class="row" style="border-bottom-right-radius: 4px;border: 1px solid gainsboro">
    <form class="form-horizontal " role="form" method="post" >
        {{csrf_field()}}
        <lable class='form-group '  ></lable>
        <div class="form-group ">
            <label for="firstname" class="col-sm-3 control-label">姓名</label>
            <div class="col-sm-5">
                <input type="text" class="form-control w300" placeholder="请输入名字" name="Student[name]" value={{ old('Student')['name'] }}>
            </div>
            <p class=" col-sm-4 notice">{{ $errors->first('Student.name') }}</p>
        </div>
        <div class="form-group">
            <label for="lastname" class="col-sm-3 control-label">年龄</label>
            <div class="col-sm-5">
                <input type="text" class="form-control w300" id="lastname" name="Student[age]" placeholder="请输入年龄" value={{ old('Student')['age'] }}>
            </div>
            <p class=" col-sm-4 notice">{{ $errors->first('Student.age') }}</p>
        </div>

        <div class="form-group">
            <label for="lastname" class="col-sm-3 control-label">性别</label>
            <div class="col-sm-5">
                @foreach($student as $k=>$v)
                <label class="checkbox-inline">
                    <input type="radio" id="inlineCheckbox1" name="Student[sex]" @if($k==1)
                    checked @endif value="{{ $k
                    }}">{{$v}}
                </label>
                @endforeach
            </div>

            <p class=" col-sm-4 notice">{{ $errors->first('Student.sex') }}</p>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">登录</button>
            </div>
        </div>
    </form>
    </div>
    <div style="margin-bottom: 90px;"></div>
    @stop
