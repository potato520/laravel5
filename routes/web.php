<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', 'Backend\MemberController@login'); # 登录

Route::group(['prefix' => 'Backend'], function (){
    Route::post('toLogin', 'Backend\MemberController@toLogin'); # 登录处理

    Route::any('Home', 'Backend\HomeController@index'); # 后台首页

    Route::any('Member', 'Backend\MemberController@lists'); # 用户列表
    Route::any('Member/addUser', 'Backend\MemberController@addUser'); # 添加用户
    Route::any('Member/modUser/{id}', 'Backend\MemberController@modUser'); # 编辑用户 视图
    Route::any('Member/modUserServer', 'Backend\MemberController@modUserServer'); # 编辑用户 提交
    Route::get('Member/delUser/{id}', 'Backend\MemberController@delUser'); # 删除用户

    Route::any('Video', 'Backend\VideoController@lists'); # 视频列表
    Route::any('Video/addVideo', 'Backend\VideoController@addVideo'); # 添加信息
    Route::any('Video/upload', 'Backend\VideoController@upload'); # 上传图片


});

