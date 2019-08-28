@extends("Home.Home.index")
@section("home")
  <div class="positions">
   当前位置：<a href="/">首页</a> &gt; <a href="#" class="posCur">购物车</a>
  </div><!--positions/-->
  <div class="cont">
   <div class="chenggong">
    <h3>下单成功</h3>
    <div class="zhifu">
     您选择的支付方式是 <strong class="red">{{$type}}</strong><br />
     <a href="/pays/{{$id}}" target="_blank"><img src="/static/Home/images/zhifu.png" width="133" height="41" /></a>
    </div><!--zhifu/-->
   </div><!--chenggong/-->
  </div><!--cont/-->
@endsection
@section("title","下单成功")