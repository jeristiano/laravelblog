<?php



/*
 *后台登录路由
 */

Route::any('admin/login','Admin\LoginController@login');
Route::any('admin/code','Admin\LoginController@code');
Route::any('admin/getCode','Admin\LoginController@getCode');
Route::any('admin/session','Admin\IndexController@session');


/*
 * 后台登录中间件
 */
Route::group(['middleware'=>['web','admin.login'],'prefix'=>'admin','namespace'=>'Admin'],function () {
    Route::get('index','IndexController@index');
    Route::get('info','IndexController@info');
    Route::get('logout','IndexController@logout');
    Route::any('passwordMd','IndexController@passwordMd');
});
//
//Route::get('admin/index','Admin\IndexController@index');
//Route::get('admin/info','Admin\IndexController@info');
//Route::get('admin/logout','Admin\IndexController@logout');
//Route::any('admin/passwordMd','Admin\IndexController@passwordMd');