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
// 后台登录
Route::resource("adminlogin","Admin\AdminLoginController");
// 路由组结合中间件检测后台登录
Route::group(['middleware'=>'adminlogin'],function(){
	// 后台首页
	Route::resource("/admin","Admin\AdminController");
	// 分类管理
	Route::resource("/admincates","Admin\CatesController");
	// 管理员管理
	Route::resource("/adminusers","Admin\AdminUsersController");
	//角色管理
	Route::resource('/adminroles','Admin\AdminRolesController');
	// 权限管理
	Route::resource("/adminauths","Admin\AdminAuthsController");
	// 公告管理
	Route::resource("/adminarticel","Admin\ArticelController");
	// 公告删除
	Route::get("/articeldel","Admin\ArticelController@del");
	// 用户管理
	Route::resource("adminuser","Admin\UsersController");
});

// 用户注册 邮箱
Route::resource("/register","Home\RegisterController");
// 验证码
Route::get("/yzm","Home\RegisterController@yzm");
// 用户激活
route::get('/jihuo','Home\RegisterController@jihuo');

//用户注册 手机
Route::post("/registerphone","Home\RegisterController@registerphone");
// 检测手机号是否唯一
Route::get("/checkphone","Home\RegisterController@checkphone");
// 发送验证码
Route::get("/registersendphone","Home\RegisterController@registersendphone");
// 检测验证码
Route::get("/checkcode","Home\RegisterController@checkcode");


// 前台首页路由
Route::resource("/","Home\HomeController");
// 前台登录
Route::resource("/homelogin","Home\HomeLoginController");
// 检测用户
// Route::get("/checkloginuser","Home\HomeLoginController@checkuser");
// // 检测密码
// Route::get("/checkloginpwd","Home\HomeLoginController@checkpwd");
// 忘记密码
Route::get("/forget","Home\HomeLoginController@forget");
Route::post("/doforget","Home\HomeLoginController@doforget");
// 加载重置密码模板
Route::get("/reset","Home\HomeLoginController@reset");
// 执行重置密码
Route::post("/doreset","Home\HomeLoginController@doreset");