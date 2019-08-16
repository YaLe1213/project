<!DOCTYPE html>
<html>
 <head> 
  <meta charset="UTF-8" /> 
  <title>账户中心</title> 
  <link rel="stylesheet" href="/static/Home/password/mima/Css/ucenter.css" /> 
  <link href="/static/Home/password/xiangmu/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css" /> 
  <link href="/static/Home/password/xiangmu/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" /> 
  <link href="/static/Home/password/xiangmu/css/personal.css" rel="stylesheet" type="text/css" /> 
  <link href="/static/Home/password/xiangmu/css/stepstyle.css" rel="stylesheet" type="text/css" /> 
  <link rel="stylesheet" href="/static/Admin/bootstrap/css/bootstrap.min.css" />
  <script src="/static/Home/password/xiangmu/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script> 
  <script src="/static/Home/password/xiangmu/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script> 
 </head> 
 <body> 
  <div id="header"> 
   <div class="header-layout"> 
    <div style="float:left;margin-top:-15px;"> 
     <img src="/static/Home/images/logo.png" alt="" style="height:70px" /> 
    </div> 
    <h2 class="logo-title"> 找回密码 </h2> 
    <ul class="header-nav" "="> 
     <li class="nav-first"><a href="" target="_blank"> 注册 </a></li> 
     <li><a href="" target="_blank"> 登录 </a></li> 
     <li><a href="http://service.taobao.com/support/main/service_center.htm" target="_blank"> </a></li> 
    </ul> 
   </div> 
  </div> 
  <div class="center"> 
   <div class="center"> 
    <div class="center"> 
     <div class="am-cf am-padding"> 
      <div class="am-fl am-cf">
       <strong class="am-text-danger am-text-lg">邮箱验证</strong>
      </div> 
     </div> 
     <hr /> 
     <!--进度条--> 
     <div class="m-progress"> 
      <div class="m-progress-list"> 
       <span class="step-1 step" id="span1"> <em class="u-progress-stage-bg"></em> <i class="u-stage-icon-inner">1<em class="bg"></em></i> <p class="stage-name">邮箱验证</p> </span> 
       <span class="step-1 step" id="span2"> <em class="u-progress-stage-bg"></em> <i class="u-stage-icon-inner">2<em class="bg"></em></i> <p class="stage-name">重置密码</p> </span> 
       <span class="step-3 step" id="span3"> <em class="u-progress-stage-bg"></em> <i class="u-stage-icon-inner">3<em class="bg"></em></i> <p class="stage-name">完成</p> </span> 
       <span class="u-progress-placeholder"></span> 
      </div> 
      <div class="u-progress-bar total-steps-2"> 
       <div class="u-progress-bar-inner"></div> 
      </div> 
     </div> 
     <form class="am-form am-form-horizontal" action="/doreset" method="post"> 
      <div class="center div1" style="display:none;"> 
       <input type="text" id="code" style="display:block;float:left;width:200px;margin:0px 20px 30px 100px" placeholder="请输入验证码" /> 
       <div class="am-btn am-btn-success" id="huoqu" style="display:block;float:left;width:150px">
        点击获取
       </div> 
      </div> 
      <div class="center" style="margin:0px 0px 0px 120px"> 
       <span id="su"></span>
      </div> 
      <div class="center div2" style="display:block;"> 
       <div class="am-form-group"> 
        <label for="user-new-password" class="am-form-label">新密码</label> 
        <div class="am-form-content"> 
         <input type="password" name="pwd" id="user-new-password" placeholder="由数字、字母、下划线组合的6-18位密码" /> 
         <span></span> 
        </div> 
       </div> 
       <label for="user-new-password" class="am-form-label">确认密码</label> 
       <div class="am-form-content"> 
        <input type="password" name="repwd" id="user-new-password" placeholder="两次密码一致" /> 
        <span></span> 
       </div> 
      </div> 
      </div> 
      <div class="info-btn"> 
       <div class="" id="">
        <input type="hidden" name="id" value="{{$id}}">
       {{csrf_field()}}
        <input type="submit" value="提交" class="btn btn-success" onclick="sub()">
       </div> 
      </div> 
     </form>

   </div> 
   <!--底部--> 
  </div>   
 </body>
 <script>
  pwd=false;
  repwd=false;

   // 校验密码是否符合规则
  $("input[name='pwd']").blur(function(){
    // 获取输入的密码
    pwd=$(this).val();
    if(pwd.match(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,18}$/)==null){
      $(this).next("span").css('color','red').css("fontSize","1em").html("密码不符合规则");
      pwd=false;
    }else{
      $(this).next("span").css('color','#7bc144').html("密码符合规则");
      pwd=true;
    }
  });
   // 校验重置密码是否符合规则 
  $("input[name='repwd']").blur(function(){
    // 获取输入的密码
    pwd=$(this).val();
    if(pwd.match(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,18}$/)==null){
      $(this).next("span").css('color','red').css("fontSize","1em").html("密码不符合规则");
      repwd=false;
    }else{
      $(this).next("span").css('color','#7bc144').html("密码符合规则");
      repwd=true;
    }
  });
$(":submit").click(function(){
  $("input").trigger("blur"); //匹配input 触发blur事件
  if(pwd && repwd){
    return true;
  }else{
    return false;
  }
});
  
 </script>
</html>