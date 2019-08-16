<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>帝奥商城</title>
<link type="text/css" href="/static/Home/css/css.css" rel="stylesheet" />
<script type="text/javascript" src="/static/Home/js/jquery.js"></script>
<script type="text/javascript" src="/static/Home/js/js.js"></script>
<link rel="stylesheet" href="/static/Admin/bootstrap/css/bootstrap.min.css" />
<script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
</head>

<body style=" background:#FFF;">
 <div class="loginLogo">
  <div class="logoMid">
   <h1 class="logo" style="height:71px;padding-top:10px;"><a href="/"><img src="/static/Home/images/logo.png" width="241" height="71" /></a></h1>
   <div class="loginReg">
    还没有会员账号?&nbsp;<a href="/homelogin/create">登录</a>
   </div><!--loginReg/-->
  </div><!--logoMid/-->
 </div><!--loginLogo/-->
 <div class="loginBox">
  <img src="/static/Home/images/chengnuo.jpg" width="295" height="393" class="chengnuo" />
  <style>
    .nn{width:250px;height:50px;background: #fff;float:left;line-height:50px;text-align: center;font-size: 2em;font-weight: bold;}
    /*.nn:hover{background: #7BC144;}*/
  </style>
  <div style="width:500px;height: 50px;background: #7BC144;margin-left: 12%;margin-bottom: 40px;">
    <div class="nn email2" onclick="over('email')">邮箱注册</div>
    <div class="nn phone2" onclick="over('phone')" style="background-color:#7bc144;">手机注册</div>
  </div>
  <!-- 邮箱注册 -->
  <form action="/register" method="post" class="reg" id="email1" style="display: none;">
   <div class="regList">
    <label><span class="red">*</span> 账户名</label>
    <input type="text" name="email" placeholder="请输入邮箱" /> <span style="color:#999;"></span>
   </div><!--regList/-->
   <div class="regList">
    <label><span class="red">*</span> 请设置密码</label>
    <input type="password" name="pwd"  />
   </div><!--regList/-->
   <div class="regList">
    <label><span class="password">*</span> 请确认密码</label>
    <input type="password" name="repwd" />
   </div><!--regList/-->
   <div class="regList">
    <label><span class="red">*</span> 验证码</label>
    <input type="text" class="yanzheng" name="yzm" /><img src="/yzm"  onclick="this.src=this.src+'?a=1'" />
   </div><!--regList/-->
   <div class="xieyi">
    <input type="checkbox" /> 我已经阅读并同意<a href="#">《帝奥用户注册协议》</a>
   </div><!--xieyi/-->
   <div class="reg">
    {{csrf_field()}}
    <input type="submit" class="btn" />
   </div><!--reg/-->
  </form><!--reg/-->
  <!-- 手机注册 -->
  <form action="/registerphone" method="post" class="reg" id="phone1" style="display: block;">
   <div class="regList">
    <label><span class="red">*</span> 账户名</label>
    <input type="text" name="phone" placeholder="请输入手机号" reminder="请输入正确的手机号" class="ll" /><span style="color:#999;">请输入手机号</span>
   </div><!--regList/-->
   <div class="regList">
    <label><span class="red">*</span> 验证码</label>
    <input type="text" class="yanzheng" name="code" class="ll" reminder="请输入验证码"/><span style="color:#999;">请输入验证码</span><a href="javascript:void(0)" class="btn btn-success" onclick="send()">发送</a>
   </div><!--regList/-->
   <div class="regList">
    <label><span class="red">*</span> 请设置密码</label>
    <input type="password" name="pwd" placeholder="请输入6-18位的数字,字母和下划线" class="ll" reminder="要求包含字母和数字，数字不可连续"/><span style="color:#999;">请输入密码</span>
   </div><!--regList/-->
   
   <div class="xieyi">
    <input type="checkbox" /> 我已经阅读并同意<a href="#">《帝奥用户注册协议》</a>
   </div><!--xieyi/-->
   <div class="reg">
    {{csrf_field()}}
    <input type="submit" class="btn btn-success" />
   </div><!--reg/-->
  </form><!--reg/-->
  <div class="clears"></div>
 </div><!--loginBox/-->
</body>
<script>
  // width:250px;height:50px;background: #7BC144;
  function over(ac){
    $(this).css('backgroundColor','#7BC144');

    if (ac=="email") {
      $("#email1").css('display','block');
      $("#phone1").css('display','none');
      $(".phone2").css('backgroundColor','#fff');
      $(".email2").css('backgroundColor','#7bc144');
    }
    if (ac=="phone") {
      $("#email1").css('display','none');
      $("#phone1").css('display','block');
      $(".email2").css('backgroundColor','#fff');
      $(".phone2").css('backgroundColor','#7bc144');

    }
  }



// 用 手机号 注册

  Phone=false;
  Code=false;

  // 获取焦点提示信息
  $(".ll").focus(function(){
    // 获取reminder属性值，放到后面的的span中
    reminder=$(this).attr("reminder");
    $(this).next("span").css('color','red').html(reminder);
  });

  // 手机号失去焦点事件
  $("input[name='phone']").blur(function(){
    // 获取手机号
    ph=$(this).val();
    // 校验手机号
    if(ph.match(/^1([38][0-9]|4[579]|5[0-3,5-9]|6[6]|7[0135678]|9[89])\d{8}$/)==null){
      // alert("手机号码不合法");
      $(this).next("span").css('color','red').html("手机号码不合法");
      Phone=false;
    }else{
      o=$(this);
      // 校验手机号是否已存在
      $.get("/checkphone",{ph:ph},function(data){
        if(data==0){
          o.next("span").css('color','red').html("该手机号已经注册");
          Phone=false;
        }
        if(data==1){
          o.next("span").css('color','#7bc144').html("手机号可用");
          Phone=true;
        }
      });
    }
    // alert(2);
  });

  // // 发送验证码按钮
  // function send(){
  //   t=$(this);
  //   // 获取手机号
  //   ph=$("input[name='phone'").val();
  //   $.get("/registersendphone",{ph:ph},function(data){
  //     if(data.code==000000){
  //       m=10
  //       // 按钮倒计时
  //       mytime=setInterval(function(){
  //         m--;
  //         t.html(m);
  //         t.attr("disabled",true);
  //         if (m<1) {
  //           // 清除定时器
  //           clearInterval(mytime);
  //           t.html("发送");
  //           t.attr("disabled",false);
  //         }
  //       },1000);
  //     }
  //   },"json");
  // }

  // // 短信验证码失去焦点事件
  // $("input[name='code']").blur(function(){
  //   oo=$(this);
  //   // 获取写入的校验码
  //   code=$(this).val();
  //   $.get("/checkcode",{code:code},function(data){
  //     if(data==1){
  //       // 正确
  //       // oo.next("span").css('color','#7bc144').html();
  //        Code=true;
  //     }else if(data==2){
  //       // 有误
  //       oo.next("span").css('color','red').html("验证码有误");
  //        Code=false;
  //     }else if(data==3){
  //       // 为空
  //       oo.next("span").css('color','red').html("验证码为空");
  //        Code=false;
  //     }else if(data==4){
  //       // 过期
  //       oo.next("span").css('color','red').html("验证码已过期");
  //        Code=false;
  //     }
  //   });
  // });

  // 校验密码是否符合规则
  $("input[name='pwd']").blur(function(){
    // 获取输入的密码
    pwd=$(this).val();
    if(pwd.match(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,16}$/)==null){
      $(this).next("span").css('color','red').css("fontSize","1em").html("密码不符合规则");
      pwd=false;
    }else{
      $(this).next("span").css('color','#7bc144').html("密码符合规则");
      pwd=true;
    }
  });


Code=true;  
// 表单提交
$("#phone1").submit(function(){
  if (Phone && Code && pwd) {
    return true;
  }else{
    return false;
  }
});

</script>
</html>
