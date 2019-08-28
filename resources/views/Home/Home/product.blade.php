@extends("Home.Home.index")
@section("home")
 <div class="jilu">
    总计 <span>8</span> 个记录
   </div><!--jilu/-->
   <div class="contLeft">
    <ul class="leftPorNav">
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
   <div class="contRight">
    <div class="frProList">
    @foreach($data as $row)
      <dl>
      <dt><a href="/proinfo/{{$row->id}}"><img src="{{$row->img}}" width="132" height="129" /></a></dt>
      <dd>{{$row->name}}</dd>
      <dd class="cheng">￥{{$row->shopprice}} <span>￥{{$row->marketprice}}</span></dd>
     </dl>
    @endforeach
      <div class="clears"></div>
     </div><!--frProList-->
   </div><!--contRight/-->
   <div class="clears"></div>
@endsection
@section("title","促销中心")