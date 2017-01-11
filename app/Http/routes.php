<?php



/*
 *后台登录路由
 */

Route::any('admin/login','Admin\LoginController@login');
Route::any('admin/code','Admin\LoginController@code');
Route::any('admin/getCode','Admin\LoginController@getCode');


/*
 * 后台登录中间件
 */
Route::group(['middleware'=>['admin.login'],'prefix'=>'admin','namespace'=>'Admin'],function () {
    Route::get('index','IndexController@index');
    Route::get('info','IndexController@info');
    Route::get('logout','IndexController@logout');
    Route::any('passwordMd','IndexController@passwordMd');
    Route::resource('category', 'CategoryController');
    Route::resource('article', 'ArticleController');
    Route::resource('links', 'LinksController');
    Route::post('changeSort','LinksController@changeSort');
    Route::resource('navi', 'NaviController');
    Route::post('navi/changeSort','NaviController@changeSort');
    Route::post('changeOrder','CategoryController@changeOrder');
    Route::resource('config', 'ConfigController');
    Route::post('config/changeSort','ConfigController@changeSort');
    Route::post('config/changecontent','ConfigController@changecontent');
    Route::any('upload','CommonController@upload');
    Route::get('putFile','ConfigController@putFile');

});
Route::group(['middleware'=>['web']],function(){
    Route::get('/','Home\IndexController@index');
});
