<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>迪奥商城</title>
<link type="text/css" href="/static/Home/css/css.css" rel="stylesheet" />
<script type="text/javascript" src="/static/Home/js/jquery.js"></script>
<script type="text/javascript" src="/static/Home/js/js.js"></script>
<script src="/static/Home/js/wb.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
$(function(){
    $("#kinMaxShow").kinMaxShow();
});
</script>
</head>

<body>
 <div class="mianCont">
  <div class="top">
    @if(session('userid'))
      <span>您好！欢迎　{{session('username')}}　来到迪奥商城 &nbsp;<a href="/logout">[退出]</a></span>
    @else
     <span>您好！欢迎来到迪奥商城 请&nbsp;<a href="/homelogin/create">[登录]</a>&nbsp;<a href="/register/create">[注册]</a></span>
    @endif
   
   <span class="topRight">
    <a href="/">我的迪奥</a>&nbsp;| 
    <a href="/orderlist">我的订单</a>&nbsp;| 
    <a href="/myself">会员中心</a>&nbsp;|
    <a href="javascript:void(0)">联系我们</a>
   </span>
  </div><!--top/-->
  <div class="lsg">
   <h1 class="logo"><a href="/"><img src="/static/Home/images/logo.png" width="217" height="90" /></a></h1>
   <form action="/homesearch" method="get" class="subBox">
    <div class="subBoxDiv">
     <input type="text" class="subLeft" name="keywords" />
     <input type="image" src="/static/Home/images/subimg.png" width="63" height="34" class="sub" />
     <div class="hotWord">
      热门搜索：
      <a href="javascript:void(0)">冷饮杯</a>&nbsp;
      <a href="javascript:void(0)">热饮杯</a> &nbsp;
      <a href="javascript:void(0)">纸杯</a>&nbsp;
      <a href="javascript:void(0)">纸巾</a>  &nbsp;
      <a href="javascript:void(0)">纸巾</a> &nbsp;
      <a href="javascript:void(0)">纸杯</a>&nbsp;
     </div><!--hotWord/-->
    </div><!--subBoxDiv/-->
   </form><!--subBox/-->
   <div class="gouwuche">
    <div class="gouCar">
     <img src="/static/Home/images/gouimg.png" width="19" height="20" style="position:relative;top:6px;" />&nbsp;|&nbsp;
     <strong class="red">0</strong>&nbsp;件&nbsp;|
     <strong class="red">￥ 0.00</strong> 
     <a href="cart">去结算</a> <img src="/static/Home/images/youjian.jpg" width="5" height="8" />    
    </div><!--gouCar/-->
    <!-- 个人中心 -->
    <div class="myChunlv">
     <a href="/myself"><img src="/static/Home/images/mychunlv.jpg" width="112" height="34" /></a>
    </div><!--myChunlv/-->
   </div><!--gouwuche/-->
  </div><!--lsg/-->
  <div class="pnt">
   <div class="pntLeft">
    <h2 class="Title">所有商品分类</h2>
    <!-- 无限分类开始 -->
    <ul class="InPorNav">
     @foreach($cates as $row)
     <li><a href="/product/{{$row->id}}">{{$row->name}}</a>
      @if(count($row->suv))
      <div class="chilInPorNav">
      @foreach($row->suv as $rows)
        <ul class="InPorNav">
         <li><a href="/product/{{$rows->id}}">{{$rows->name}}</a>
          @if(count($rows->suv))
          <div class="chilInPorNav">
          @foreach($rows->suv as $rr)
           <a href="#">{{$rr->name}}</a>
          @endforeach
          </div><!--chilLeftNav/-->
          @endif
         </li>
        </ul>
      @endforeach
      </div><!--chilLeftNav/-->
      @endif
     </li>
     @endforeach
    </ul><!--InPorNav/-->
    <!-- 无限分类结束 -->
   </div><!--pntLeft/-->
   <div class="pntRight">
    <ul class="nav">
     <li class="navCur"><a href="">商城首页</a></li>
     <li><a href="/product1">促销中心</a></li>
     <li><a href="login.html">会员中心</a></li>
     <li><a href="help.html">帮助中心</a></li>
     <div class="clears"></div>
     <div class="phone">TEL：021-12345678</div>
    </ul><!--nav/-->
    <div class="banner">
     <div id="kinMaxShow">
      @foreach($lbt as $row)
      <div>
       <a href="#"><img src="{{$row->img}}" height="360"  /></a>
      </div>
      @endforeach   
     </div><!--kinMaxShow/-->
    </div><!--banner/-->
   </div><!--pntRight/-->
   <div class="clears"></div>
  </div><!--pnt/-->
  <div class="rdPro">
   <div class="rdLeft">
    <ul class="rdList">
     <li>推荐产品</li>
     <li>促销产品</li>
     <div class="clears"></div>
    </ul><!--rdList/-->
    <div class="rdProBox">
    @foreach($tj as $row)
     <dl>
      <dt><a href="/proinfo/{{$row->id}}"><img src="{{$row->img}}" width="132" height="129" /></a></dt>
      <dd>{{$row->name}}</dd>
      <dd class="cheng">￥{{$row->shopprice}}</dd>
     </dl>
    @endforeach
     <div class="clears"></div>
    </div><!--rdPro/-->
    <div class="rdProBox">
     @foreach($cx as $row)
     <dl>
      <dt><a href="/proinfo/{{$row->id}}"><img src="{{$row->img}}" width="132" height="129" /></a></dt>
      <dd>{{$row->name}}</dd>
      <dd class="cheng">￥{{$row->shopprice}}</dd>
     </dl>
     @endforeach
     
     <div class="clears"></div>
    </div><!--rdPro/-->
   </div><!--rdLeft/-->
   <style>
     /*公告开始*/
    .rdRight{
      width:221px;
      height:260px;
      background-color:#fff;
      float:right;
      border:1px solid #E6E6E6;
    }
    .rdRight p{
      list-style-type:none;
      padding-left: 20px;
      height:38px;
      width:200px;
      border-bottom:#E6E6E6 1px solid;
      font-size:16px;
      line-height:38px;
      text-align:left;
      font-family:"微软雅黑";
      font-weight:bold;
    }
    .rdRight ul{
      position: relative;
      left:10px;
    }
    .rdRight ul li{
      width:200px;
      height:36px;
      line-height: 36px;
      font-size:14px;
      border-bottom:1px solid #e6e6e6;
      /*多出来的字隐藏加点*/
      overflow: hidden;
      white-space: nowrap;
      text-overflow:ellipsis;
    }
    /*.rdRight li.rdRightStyle{border-top:#7BC144 2px solid;border-bottom:#fff 1px solid;color:#7BC144;}*/
    /*公告结束*/
   </style>
   <div class="rdRight">
    <p>公告</p>
    <ul><!-- 最多显示 5 个公告 -->
      @foreach($articel as $row)
      <li><a href="/gginfo/{{$row->id}}">{{$row->title}}</a></li>
      @endforeach
      <li><a href="">更多公告 >></a></li>
    </ul>

   </div><!--rdRight/-->
   <div class="clears"></div>
  </div><!--rdPro/-->
  @foreach($cates as $row)
  <div class="hengfu">
   <img src="/static/Home/images/hengfu1.jpg" width="979" height="97" />
  </div><!--hengfu/-->
  <div class="floor" id="floor1">
   <h3 class="floorTitle">
   1F&nbsp;&nbsp;&nbsp;&nbsp;{{$row->name}}
   
    <div class="more" style="right: 80px;">
       @foreach($row->suv as $er)
      <a href="javascript:void(0)">{{$er->name}}</a>
      @endforeach
    </div>
     <a href="/product/{{$row->id}}" class="more">更多 &gt;</a>
     </h3>
     <div class="floorBox">
      <div class="floorLeft">
       <ul class="flList">
      @foreach($three as $k=>$v)
        @if($row->id==$k)
          @foreach($v as $kk=>$vs)
            @foreach($vs as $two)
              <li><a href="/product/{{$two->id}}">{{$two->name}}</a></li>
            @endforeach
          @endforeach
        @endif
      @endforeach
        <li><a href="javascript:void(0)">更多&gt;&gt;</a></li>
        <div class="clears"></div>
       </ul><!--flList/-->
       <div class="flImg"><img src="/static/Home/images/flListimg.jpg" width="198" height="290" /></div>
      </div><!--floorLeft/-->
    
      <div class="floorRight">
       <div class="">
        @foreach($row->goods as $gg)
        <dl style="float: left;margin-left: 10px;">
          <dt><a href="/proinfo/{{$gg->id}}"><img src="{{$gg->img}}" width="132" height="129" /></a></dt>
          <dd>{{$gg->name}}</dd>
          <dd class="cheng">￥{{$gg->shopprice}}</dd>
        </dl>
        @endforeach
        <div class="clears"></div>
       </div><!--frProList-->
      </div><!--floorRight/-->
      <div class="clears"></div>
     </div><!--floorBox/-->
  </div><!--floor/-->
  @endforeach

  <div class="inHelp">
   <div class="inHLeft">
    <h4>帮助中心</h4>
    <ul class="inHeList">
     <li><a href="javascript:void(0)">购物指南</a></li>
     <li><a href="javascript:void(0)">支付方式</a></li>
     <li><a href="javascript:void(0)">售后服务</a></li>
     <li><a href="javascript:void(0)">企业简介</a></li>
     <div class="clears"></div>
    </ul><!--inHeList/-->
   </div><!--inHLeft/-->
   <div class="inHLeft">
    <h4>会员服务</h4>
    <ul class="inHeList">
     <li><a href="/register">会员注册</a></li>
     <li><a href="/homelogin/create">会员登录</a></li>
     <li><a href="/cart">购物车</a></li>
     <li><a href="/orderlist">我的订单</a></li>
     <div class="clears"></div>
    </ul><!--inHeList/-->
   </div><!--inHLeft/-->
   <div class="inHRight">
    <h4>友情链接</h4>
    <ul class="inHeList">
      @foreach($friendlink as $row)
        <li><a href="{{$row->url}}">{{$row->name}}</a></li>
      @endforeach
     <li><a href="/morelink">更多链接</a></li>
     <div class="clears"></div>
    </ul><!--inHeList/-->
  </div><!--inHelp/-->
  <div class="footer">
   <p>
   <a href="/">进入迪奥官网</a>&nbsp;|&nbsp;
   <a href="/">商城首页</a>&nbsp;|&nbsp;
   <a href="/product">促销中心</a>&nbsp;|&nbsp;
   <a href="/orderlist">我的订单</a>&nbsp;|&nbsp;
   <a href="">新闻动态</a>&nbsp;|&nbsp;
   <a href="/myself">会员中心</a>&nbsp;|&nbsp;
   <a href="javascript:void(0)">帮助中心</a>
   </p>
   <p>
    版权所有：**** 版权所有  Copyright *****   沪ICP备00000000号  
   </p>
  </div><!--footer/-->
 </div><!--mianCont/-->
 <a href="#" class="backTop">&nbsp;</a>
</body>
</html>
