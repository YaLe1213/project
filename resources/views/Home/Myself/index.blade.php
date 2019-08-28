@extends("Home.Home.index")
@section("home")
  @section("position")
  <div class="positions">
   当前位置：<a href="/">首页</a> &gt; <a href="/myself">会员中心</a>
    <!-- &gt; <a href="#" class="posCur">我的订单</a> -->
  </div><!--positions/-->
  @show
  <div class="cont">
    <div class="contLeft" id="contLeft">
      <h3 class="leftTitle">会员中心</h3>
      <dl class="helpNav vipNav">
       <dt>我的主页</dt>
        <dd>
         <a href="/myself" class="vipCur">个人中心</a>
         <a href="/orderlist">我的订单</a>
         <a href="/mycollection">我的收藏</a>
        </dd>
       <dt>账户设置</dt>
        <dd>
         <a href="/uppwd">密码修改</a>
         <a href="/myaddress">收货地址</a>
        </dd>
        <dt>客户服务</dt>
         <dd>
          <a href="javscript:void(0)">网站使用条款</a>
          <a href="javscript:void(0)">网站免责声明</a>
          <a href="javscript:void(0)">在线留言</a>
         </dd>
        
        
      </dl><!--helpNav/-->
    </div><!--contLeft/-->
    <div class="contRight">
      @section("info1")
      @show
    </div><!--contRight/-->
  <div class="clears"></div>
  </div><!--cont/-->
<script>
  $("input[name='email']").blur(function(){
    email=$(this).val();
    if(email.match(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/)==null){
      $(this).next("span").css('color','red').html("邮箱不符合规则");
    }else{
      $(this).next("span").css('color','#7bc144').html("邮箱符合规则");
    }
  });
  $("input[name='phone']").blur(function(){
    phone=$(this).val();
    
    if(phone.match(/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/)==null){
      $(this).next("span").css('color','red').html("手机号不符合规则");
      phone=false;
    }else{
      $(this).next("span").css('color','#7bc144').html("手机号符合规则");
      phone=true;
    }
   
  });
</script>
@endsection
@section("title","会员中心")