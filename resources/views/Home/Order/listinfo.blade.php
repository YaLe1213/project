@extends("Home.Myself.index")
@section("position")
  <div class="positions">
   当前位置：<a href="/">首页</a> &gt; <a href="/myself">会员中心</a>
    &gt; <a href="#" class="posCur">订单详情</a>
  </div><!--positions/-->
@endsection
@section("info1")
   <h2 class="oredrName">
    订单详情
   </h2>
   <table class="orderDeatils">
    <tr>
     <th>订单编号</th>
     <td>{{$data->orderNo}}</td>
    </tr>
    <tr>
     <th>商品名称</th>
     <td>{{$data->name}}</td>
    </tr>
    <tr>
     <th>订单价钱</th>
     <td>￥{{$data->price*$data->num}}</td>
    </tr>
    <tr>
     <th>订单信息</th>
     <td> 
{{$data->aname}}，{{$data->phone}}，， {{$data->info}}</td>
    </tr>
    <tr>
     <th>商家</th>
     <td>{{$data->sname}}</td>
    </tr>
    <tr>
     <th>支付方式</th>
     <td>{{$data->pname}}</td>
    </tr>
    <tr>
     <th>支付状态</th>
     <td>
     	@if($data->status==-3)
          <strong>已拒绝收货</strong>
        @endif
        @if($data->status==-2)
          <strong>未付款</strong>
        @endif
        @if($data->status==0)
          <strong>待发货</strong>
        @endif
        @if($data->status==1)
          <strong>配送中</strong>
        @endif
        @if($data->status==3)
          <strong>已收货</strong>
        @endif
     </td>
    </tr>
   </table> 
@endsection
@section("title","订单详情")