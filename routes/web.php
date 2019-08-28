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
	// 修改当前管理员的密码
	Route::any("/adminuppwd","Admin\AdminController@adminuppwd");
	Route::post("/adminpwdsave","Admin\AdminController@adminpwdsave");
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
	//Ajax 删除
	Route::get("/articledel","Admin\ArticelController@del");
	// 用户管理
	Route::resource("/adminuser","Admin\UsersController");
	// 后台友情链接
	Route::group([],function(){
		Route::resource("/adminlink","Admin\AdminLinkController");
		//详情
		Route::get("/linkinfo/{id}","Admin\AdminLinkController@linkinfo");
		// 删除
		Route::get("/linkdel","Admin\AdminLinkController@linkdel");
		//修改状态
		Route::get("/linkstatus","Admin\AdminLinkController@linkstatus");	
	});
	
	// 商品管理
	Route::group([],function(){
		Route::resource("/admingoods","Admin\AdminGoodsController");
		// 商品      详情
		Route::get("/goodsinfo/{id}","Admin\AdminGoodsController@goodsinfo");
		// Ajax      删除
		Route::get("/goodsdel","Admin\AdminGoodsController@dell");
		// Ajax      审核
		Route::get("/goodsexa","Admin\AdminGoodsController@exa");	
		// sale 状态
		Route::get("/goodssalestatus","Admin\AdminGoodsController@salestatus");
		Route::get("/goodsbeststatus","Admin\AdminGoodsController@beststatus");
		Route::get("/goodshottatus","Admin\AdminGoodsController@hotstatus");
		Route::get("/goodsnewstatus","Admin\AdminGoodsController@newstatus");
		Route::get("/goodsrecomstatus","Admin\AdminGoodsController@recomstatus");
		Route::get("/goodsdelstatus","Admin\AdminGoodsController@delstatus");

	});
	
	// 订单管理
	Route::group([],function(){
		Route::resource("/adminorderlist","Admin\OrderController");
		// 订单      删除
		Route::get("/orderdel","Admin\OrderController@orderdel");
		// 订单详情
		Route::get("/orderinfo/{id}","Admin\OrderController@orderinfo");
		// 订单详情  状态
		Route::get("/orderstatus","Admin\OrderController@orderstatus");
		// 订单详情  删除
		Route::get("/orderindel","Admin\OrderController@orderindel");	
	});
	
	// 支付方式管理
	Route::resource("/paytype","Admin\PayTypeController");
	//修改状态
	Route::get("/paytatus","Admin\PayTypeController@paytatus");

	// 门店管理
	Route::resource("/shops","Admin\ShopsController");
	// 门店删除
	Route::get("/shopsdel/{id}","Admin\ShopsController@shopsdel");
	//修改状态
	Route::get("/shopstatus","Admin\ShopsController@shopstatus");



	// 门店名检测
	Route::get("/shopsname","Admin\ShopsController@shopsname");
	// 快递管理
	Route::resource("/send","Admin\SendController");
	//修改状态
	Route::get("/sendstatus","Admin\SendController@sendstatus");
	// 轮播图管理
	Route::group([],function(){
		Route::resource("/lbt","Admin\LbtController");
		// 轮播图    删除
		Route::get("/lbtdel","Admin\LbtController@lbtdel");
		// 轮播图    修改状态
		Route::get("/lbtstatus","Admin\LbtController@lbtstatus");
	});
	
	// 评价管理
	Route::resource("/pj","Admin\PJController");
	// 广告管理
	Route::resource("/gg","Admin\GgController");
});
// 用户注册
Route::group([],function(){
	// 邮箱
	Route::resource("/register","Home\RegisterController");
	// 验证码
	Route::get("/yzm","Home\RegisterController@yzm");
	// 用户激活
	route::get('/jihuo','Home\RegisterController@jihuo');

	// 手机
	Route::post("/registerphone","Home\RegisterController@registerphone");
	// 检测手机号是否唯一
	Route::get("/checkphone","Home\RegisterController@checkphone");
	// 发送验证码
	Route::get("/registersendphone","Home\RegisterController@registersendphone");
	// 检测验证码
	Route::get("/checkcode","Home\RegisterController@checkcode");	
});


// 前台登录
Route::resource("/homelogin","Home\HomeLoginController");
// 前台退出
Route::get("/logout","Home\HomeLoginController@logout");

// 忘记密码
Route::group([],function(){
	Route::get("/forget","Home\HomeLoginController@forget");
	Route::post("/doforget","Home\HomeLoginController@doforget");
	// 加载重置密码模板
	Route::get("/reset","Home\HomeLoginController@reset");
	// 执行重置密码
	Route::post("/doreset","Home\HomeLoginController@doreset");	
});

// 前台首页路由
Route::resource("/","Home\HomeController");
// 前台二级首页
Route::get("/index","Home\HomeController@seconds");

// 促销中心
Route::get("/product1","Home\HomeController@product1");
Route::get("/product/{id}","Home\HomeController@product");
// 前台首页搜索页
Route::get("/homesearch","Home\HomeController@homesearch");

// 商品详情
Route::resource("/proinfo","Home\HomeController");
// 公告详情
Route::get("/gginfo/{id}","Home\HomeController@gginfo");
// 跟多链接
Route::get("/morelink","Home\HomeController@morelink");
Route::group(["middleware"=>"homelogin"],function(){
	// 购物车
	Route::group([],function(){
		Route::resource("/cart","Home\CartController");
		Route::get("/cartjian","Home\CartController@jian");
		Route::get("/cartjia","Home\CartController@jia");
		Route::get("/carttot","Home\CartController@tot");
		Route::get("/cartdel","Home\CartController@del");
		Route::get("/alldel","Home\CartController@alldel");
	});

	// 结算
	Route::any("/jiesuan","Home\OrderController@jiesuan");
	Route::any("/order/insert","Home\OrderController@insert");

	// 获取城市级联数据
	Route::get("/address","Home\AddressController@address");
	// 添加收获地址
	Route::post("/addressinsert","Home\AddressController@insert");
	Route::get("/addressdel","Home\AddressController@del");

	// 提交订单
	Route::post("/suborder","Home\OrderController@suborder");
	// 支付  付款
	Route::get("/pays/{id}","Home\PayController@payss");
	// 付款成功  跳转
	Route::get("/paysuccess","Home\PayController@paysuccess");

	// 订单列表
	Route::resource("/orderlist","Home\OrderController");
	// 订单详情
	Route::resource("/listinfo","Home\OrderController");


	// 拒绝收获
	Route::get("/orderno","Home\OrderController@orderno");
	// 确认收货
	Route::get("/orderyes","Home\OrderController@orderyes");
	// 删除收货地址
	Route::get("/homeaddressdel/{id}","Home\OrderController@addressdel");
	// 评论
	Route::get("/ping/{id}","Home\OrderController@ping");
	// 接收评论
	Route::post("/subping","Home\OrderController@subping");
	// 删除评论
	Route::get("/pingdel","Home\OrderController@pingdel");
	// 个人中心
	Route::resource("/myself","Home\MyselfController");
	// 修改个人信息
	Route::post("myupdate","Home\MyselfController@myup");

	// 密码修改
	Route::group([],function(){
		Route::get("/uppwd",function(){
			return view("Home.Myself.uppwd");
		});
		// 检测原密码
		Route::get("/checkypwd","Home\MyselfController@checkypwd");
		Route::post("/subpwd","Home\MyselfController@subpwd");
	});

	// 我的收货地址
	Route::get("/myaddress","Home\MyselfController@myaddress");

	// 我的收藏
	Route::get("/addcollect","Home\MyselfController@addcollect");
	Route::get("/mycollection","Home\MyselfController@mycollection");
});






