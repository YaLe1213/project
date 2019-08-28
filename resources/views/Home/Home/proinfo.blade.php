@extends("Home.Home.index")
@section("home")
<style>
  .creatediv{
    width: 675px;
    height: 80px;
    border: 1px solid gray;
    position: relative;
    margin-top: 10px;
    padding-left: 75px;
  }
  .createinput{
    width: 80px;
    height: 30px;
    position:absolute;
    right: 5px;
    bottom:5px;
  }
  .createimg{
    width: 50px;
    height: 50px;
    position: absolute;
    top: 15px;
    left: 15px;
  }
  .createdivs{
    width:600px;
    height:50px;
    position: absolute;
    top: 15px;
    left: 85px;
  }
</style>
  <div class="positions">
   当前位置：<a href="/">首页</a> &gt; <a href="#" class="posCur">促销商品</a>
  </div><!--positions/-->
  <div class="cont">
   <div class="contLeft">
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
   </div><!--contLeft/-->
   <div class="contRight" style="border:0;">
   <div class="proBox">
   <div id="tsShopContainer">
    <!-- 大图 和 小图 -->
	<div id="tsImgS"><a href="{{$goods->img}}" title="Images" class="MagicZoom" id="MagicZoom"><img width="300" height="300" src="{{$goods->img}}" /></a></div>
	<div id="tsPicContainer">
		<div id="tsImgSArrL" onclick="tsScrollArrLeft()"></div>
		<div id="tsImgSCon">
			<ul>
				<li onclick="showPic(0)" rel="MagicZoom" class="tsSelectImg"><img height="42" width="42" src="{{$goods->img}}" tsImgS="{{$goods->img}}" /></li>
				<!-- <li onclick="showPic(1)" rel="MagicZoom"><img height="42" width="42" src="/static/Home/images/02.jpg" tsImgS="/static/Home/images/02.jpg" /></li>
				<li onclick="showPic(2)" rel="MagicZoom"><img height="42" width="42" src="/static/Home/images/03.jpg" tsImgS="/static/Home/images/03.jpg" /></li>
				<li onclick="showPic(3)" rel="MagicZoom"><img height="42" width="42" src="/static/Home/images/04.jpg" tsImgS="/static/Home/images/04.jpg" /></li>
				<li onclick="showPic(4)" rel="MagicZoom"><img height="42" width="42" src="/static/Home/images/05.jpg" tsImgS="/static/Home/images/05.jpg" /></li>
				<li onclick="showPic(5)" rel="MagicZoom"><img height="42" width="42" src="/static/Home/images/06.jpg" tsImgS="/static/Home/images/06.jpg" /></li>
				<li onclick="showPic(6)" rel="MagicZoom"><img height="42" width="42" src="/static/Home/images/07.jpg" tsImgS="/static/Home/images/07.jpg" /></li>
				<li onclick="showPic(7)" rel="MagicZoom"><img height="42" width="42" src="/static/Home/images/08.jpg" tsImgS="/static/Home/images/08.jpg" /></li>
				<li onclick="showPic(8)" rel="MagicZoom"><img height="42" width="42" src="/static/Home/images/09.jpg" tsImgS="/static/Home/images/09.jpg" /></li>
				<li onclick="showPic(9)" rel="MagicZoom"><img height="42" width="42" src="/static/Home/images/10.gif" tsImgS="/static/Home/images/10.gif" /></li>
				<li onclick="showPic(10)" rel="MagicZoom"><img height="42" width="42" src="/static/Home/images/11.gif" tsImgS="/static/Home/images/10.gif" /></li> -->
			</ul>
		</div>
		<div id="tsImgSArrR" onclick="tsScrollArrRight()"></div>
	</div>
	<img class="MagicZoomLoading" width="16" height="16" src="/static/Home/iages/loading.gif" alt="Loading..." />
    <script src="/static/Home/js/ShopShow.js"></script>
    </div><!--tsShopContainer/-->

    <form action="/cart" method="post">

      <div class="proBoxRight">
       <h3 class="proTitle">{{$goods->name}}</h3>
       <div>商品编号： {{$goods->Sn}} </div>
       <div>会员价：<strong class="red">¥{{$goods->shopprice}}</strong> </div>
       <div>单位：袋 </div>
       <div>库存：<strong class="red">{{$goods->Stock}}</strong> 从上海发货</div>
       <ul class="rongliang">
        <li>100ml</li>
        <li>200ml</li>
        <li>300ml</li>
        <li>400ml</li>
        <li>500ml</li>
        <div class="clears"></div>
       </ul><!--rongliang/-->
       <div class="shuliang2">
        数量： <input type="text" value="1" name="num" />
       </div><!--shuliang2/-->
       <div class="gc">
        <!-- 立即购买 -->
        <!-- <a type="submit"><img src="/static/Home/images/goumai.png" width="117"  height="36" /></a>&nbsp;&nbsp; -->
        <input type="submit" value="立即购买" />
        <!-- 加入收藏 -->
        <input type="button" value="加入收藏" class="col" />
        <!-- <button>加入收藏</button> -->
       </div><!--gc/-->
       <input type="hidden" name="id" value="{{$goods->id}}" />
       {{csrf_field()}}
      </div><!--proRight/-->
    </form>

    <div class="clears"></div>
    </div><!--proBox/-->
    <ul class="fangyuan">
      <li>商品描述</li>
      <li>商品参数</li>
      <li>商品评论</li>
      <li>商品晒图</li>
      <div class="clears"></div>
    </ul><!--fangyuan/-->
    <div class="fangList">
    <div class="fangPar">
        {!!$goods->desc!!}
    </div><!--fangPar/-->
    <img src="/static/Home/images/ban1.jpg" width="756" height="310" />
    </div><!--fangList/-->
    <div class="fangList">
     商品参数
    </div><!--fangList/-->
    <div class="fangList">
      <!-- 评论 -->
      @foreach($ping as $row)
      <div class="creatediv" name="{{$row->id}}">
        <img class="createimg" src="/static/Home/ping/pic/1.jpg">
        <p class="createdivs">{{$row->con}} </p>
        @if($row->usersid==session("userid"))
        <input class="createinput" type="button" value="删除">
        @endif
      </div>
     @endforeach
<script>
  $(".col").dblclick(function(){
    id=$(this).parents("form").find("input[name='id']").val();
    // alert(id);
    $.get("/addcollect",{id:id},function(data){
      if(data==1){
        alert("收藏成功");
      }else if(data==2){
        alert("天啦噜，失败啦!");
      }else if(data==3){
        alert("您已经收藏啦!");
      }
    });
  });
</script>
    </div><!--fangList/-->
    <div class="fangList">
     <img src="/static/Home/images/rdPro1.jpg" width="132" height="129" /><br /><br />
     <img src="/static/Home/images/rdPro2.jpg" width="132" height="129" /><br /><br />
     <img src="/static/Home/images/rdPro3.jpg" width="132" height="129" /><br /><br />
     <img src="/static/Home/images/rdPro4.jpg" width="132" height="129" /><br /><br />
     <img src="/static/Home/images/rdPro5.jpg" width="132" height="129" /><br /><br />
    </div><!--fangList/-->
   </div><!--contRight/-->
   <div class="clears"></div>
  </div><!--cont/-->
  <script type="text/javascript" src="/static/Home/js/jquery.js"></script>
<script type="text/javascript" src="/static/Home/js/js.js"></script>
<script src="/static/Home/js/wb.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/Home/js/MagicZoom.js" type="text/javascript"></script>
@endsection
@section("title","商品信息")
