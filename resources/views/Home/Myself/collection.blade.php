
@extends("Home.Myself.index")
@section("position")
  <div class="positions">
   当前位置：<a href="/">首页</a> &gt; <a href="/myself">会员中心</a>
    &gt; <a href="#" class="posCur">我的收藏</a>
  </div><!--positions/-->
@endsection
@section("info1")
    <h1 class="vipName"><span>用户名：</span>{{session('username')}}</h1>
    <h2 class="oredrName">
    我的收藏 <!-- <span style="margin-left:40px;">待发货 <span class="red">10</span> </span>
    <span>待收货 <span class="red">15</span></span>
    <span>待付款 <span class="red">15</span></span> -->
    </h2>
    <table class="vipOrder">
    @foreach($data as $row)
     <tr>
      <td><a href="/proinfo/{{$row->gid}}"><img src="{{$row->img}}" width="60" height="55"></a></td>
      <td>{{$row->name}}</td>
      <td>￥{{$row->shopprice}}<br /></td> 
      <td>

        @if($row->Stock>0)
          <strong>有货</strong>
        @else
          <strong>没货了</strong>
        @endif

      </td>
      <td><a href="/myself/{{$row->cid}}" name="{{$row->cid}}">删除</a></td>
     </tr>
    @endforeach
    </table><!--vipOrder/-->
    <br />
    <div class="scott">
      <!-- 分页 -->
    </div>
    <br />

@endsection
@section("title","我的收藏")

