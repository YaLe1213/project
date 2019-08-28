
@extends("Home.Myself.index")
@section("position")
  <div class="positions">
   当前位置：<a href="/">首页</a> &gt; <a href="vip.html">会员中心</a>
    &gt; <a href="#" class="posCur">我的订单</a>
  </div><!--positions/-->
@endsection
@section("info1")
    <h1 class="vipName"><span>用户名：</span>{{session('username')}}</h1>
    <h2 class="oredrName">
    我的订单 <!-- <span style="margin-left:40px;">待发货 <span class="red">10</span> </span>
    <span>待收货 <span class="red">15</span></span>
    <span>待付款 <span class="red">15</span></span> -->
    </h2>
    <table class="vipOrder">
    @foreach($data as $row)
     <tr>
      <td><a href="/proinfo/{{$row->id}}"><img src="{{$row->img}}" width="60" height="55"></a></td>
      <td>{{$row->aname}}</td>
      <td>￥{{$row->price}}<br />{{$row->pname}}</td>
      <td>{{$row->updated_at}}</td>
      
      <td>
        <!-- -3'用户拒收,'-2'未付款,'-1'用户取消,'0'代发货,'1'配送中,'2'用户确认收货 -->
        @if($row->status==-3)
          <strong>已拒绝收货</strong>
        @endif
        @if($row->status==-2)
          <strong>未付款</strong>
        @endif
        @if($row->status==0)
          <strong>待发货</strong>
        @endif
        @if($row->status==1)
          <strong>配送中</strong>
        @endif
        @if($row->status==3)
          <strong>已收货</strong>
        @endif
        @if($row->status==2)
          <a href="javascript:void(0)"><strong class="yes" name="{{$row->id}}">确认收货</strong></a>
          <a href="javascript:void(0)"><strong class="no" name="{{$row->id}}">拒绝收货</strong></a>
        @endif
       
      </td>
      <td><a href="/listinfo/{{$row->id}}" name="{{$row->id}}">查看</a></td>
     </tr>
    @endforeach
    </table><!--vipOrder/-->
    <br />
    <div class="scott">
      <!-- 分页 -->
    </div>
    <br />
<script>
  // 确认收货
  $(".yes").click(function(){
    id=$(this).attr("name");
    oo=$(this);
    $.get("/orderyes",{id:id},function(data){
      if(data==1){
        oo.parents("td").html("<strong>已收货</strong>");
        window.location="/ping/"+id;
      }else{
        alert("确认收货失败!");
      }
    });
  });
  // 拒绝收货
  $(".no").click(function(){
    id=$(this).attr("name");
    oo=$(this);
    $.get("/orderno",{id:id},function(data){
      if(data==1){
        oo.parents("td").html("<strong>已拒绝收货</strong>");
      }else{
        alert("拒绝收货失败!");
      }
    });
  });
</script>
@endsection
@section("title","订单列表")

