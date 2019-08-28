@extends("Home.Home.index")
@section("home")
<style>
	.top_{
		width:880px;
		height:150px;
		border:1px solid #e6e6e6;
		padding-left:100px;
	}
	.ggtitle{
		font-size: 3em;
		margin:40px 100px;
	}
	.conttt{
		width:880px;
		height:auto;
		border:1px solid #e6e6e6;
		padding-left:100px;
	}
</style>
<div class="top_">
	<h1 class="ggtitle">标题：{{$data->title}}</h1>
	<span>作者：{{$data->editor}}</span>
</div>
<div class="conttt">
	<img src="{{$data->thumb}}" alt="" class="ggimg">
	<div>{!!$data->desc!!}</div>
</div>
@endsection
@section("title","公告详情")