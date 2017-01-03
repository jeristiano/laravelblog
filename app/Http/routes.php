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
    Route::post('changeOrder','CategoryController@changeOrder');
    Route::any('upload','CommonController@upload');

});

/*
 * 文章分类路由
 */
