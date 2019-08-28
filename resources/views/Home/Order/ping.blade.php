@extends("Home.Myself.index")
@section("position")
  <div class="positions">
   当前位置：<a href="/">首页</a> &gt; <a href="/myself">会员中心</a>
    &gt; <a href="#" class="posCur">评价</a>
  </div><!--positions/-->
@endsection
@section("info1")
<link href="/static/Home/ping/css/reset.css" rel="stylesheet">
<script src="/static/Home/ping/js/xml.js"></script>
<style>
	.main{
		width: 800px;
		margin:20px auto;
	}
	span{
		display: inline-block;
		width: 200px;
		height: 25px;
		line-height: 25px;
		vertical-align: center;
		text-align: left;
		margin-bottom: 10px;
	}
	.tag{
		font-size: 13px;
		margin-left: 370px;
		vertical-align: bottom;
		text-align: center;
		margin-bottom: 0;
	}
	.text{
		width: 750px;
		height: 180px;
		margin:0 auto;

		resize:none;
	}
	
	input{
		display: inline-block;
		width: 80px;
		height: 50px;
		background: #E2526F;
		border: 0;
		margin-left: 670px;
		margin-top: 10px;
	}
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
<div class="main">
	<form action="/subping" method="post">
    	<span>请进行你的装逼</span>
    	<span class="tag">你最多可以输入30个字符</span>
    	<textarea id="text" cols="30" name="con" rows="10" maxlength="30" class="text"></textarea><br>
    	{{csrf_field()}}
    	<input type="submit" value="发 表" id="ipt">

    	<input type="hidden" name="pid" value="{{$id}}">
    </form>
</div>
<div style="text-align:center;"></div>

@endsection
@section("title","商品评价")