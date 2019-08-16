<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>17商城</title>
<link type="text/css" href="/static/Home/css/css.css" rel="stylesheet" />
<script type="text/javascript" src="/static/Home/js/jquery.js"></script>
<!-- <script type="text/javascript" src="/static/Home/js/js.js"></script> -->
<link rel="stylesheet" href="/static/Admin/bootstrap/css/bootstrap.min.css" />
</head>

<body style=" background:#FFF;">
 <div class="loginLogo">
  <div class="logoMid">
   <h1 class="logo" style="height:71px;padding-top:10px;"><a href="/"><img src="/static/Home/images/logo.png" width="241" height="71" /></a></h1>
   <div class="loginReg">
    还没有会员账号?&nbsp;<a href="/register/create">免费注册</a>
   </div><!--loginReg/-->
  </div><!--logoMid/-->
 </div><!--loginLogo/-->
 <div class="loginBox">
  <div class="loginLeft">
   <img src="/static/Home/images/logoinimg.jpg" width="716" height="376" />
  </div><!--loginLeft/-->
  <form action="/homelogin" method="post" class="loginRight">
   <h2>会员登录</h2>
   <h3>用户名</h3>
   <input type="text" class="name ll" name="user" placeholder="请输入邮箱或手机号" reminder="请输入正确的邮箱或手机号" /><span style="float: right;"></span>
   <h3>密码</h3>
   <input type="password" class="pwd ll" name="pwd" placeholder="请输入密码" reminder="请输入密码" /><span style="float: right;"></span>
   <div class="zhuangtai">
    <input type="checkbox" checked="checked" /> 下次自动登录
   </div><!--zhuangtai/--> <span><a href="/forget">忘记密码</a></span>
   {{csrf_field()}}
   <div class="subs">
    <input type="image" src="/static/Home/images/sub.jpg" class="submit" />
   </div>
  </form><!--loginRight/-->
  <div class="clears"></div>
 </div><!--loginBox/-->
</body>
<script>
  // $(".ll").focus(function(){
  //   reminder=$(this).attr("reminder");
  //   $(this).next("span").css("color","red").html(reminder);
  // });
  // // user 失去焦点事件
  // $("input[name='user']").blur(function(){
  //   user=$(this).val();
  //   alert(user);
  //   // o=$(this);
  //   $.get("/checkloginuser",{user:user},function(data){
  //     // alert(data);
  //     if(data==1){
  //       o.next("span").css("color","#7bc144").html("<h3><b>√</b></h3>");
  //     }
  //     if(data==2){
  //       o.next("span").css("color","red").html("<h3><b>×</b></h3>");
  //     }

  //   });
  // });
  // pwd 失去焦点事件
  // $("input[name='pwd']").blur(function(){
  //   alert(1);
  // });
  // $("input[name='pwd']").blur(function(){
  //   pwd=$(this).val();
  //   // user=$("input[name='user']").val();
  //   // alert(user);
  //   oo=$(this);
  //   $.get("/checkloginpwd",{pwd:pwd,user:user},function(data){
  //     // alert(data);
  //     if(data==3){
  //       oo.next("span").css("color","#7bc144").html("<h3><b>√</b></h3>");
  //     }
  //     if(data==4){
  //       oo.next("span").css("color","red").html("<h3><b>×</b></h3>");
  //     }

  //   });
  // });
</script>
</html>
