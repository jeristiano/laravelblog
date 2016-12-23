<?php

Route::get('admin/index','Admin\IndexController@index');

/*
 *后台登录路由
 */

Route::any('admin/login','Admin\LoginController@login');
Route::any('admin/code','Admin\LoginController@code');
Route::any('admin/getCode','Admin\LoginController@getCode');

/*
 * 后台首页index路由
 *
 */
Route::any('admin/info','Admin\IndexController@info');