@extends("Admin.Adminpublic.adminpublic")
@section("admin")

<html>
 <head></head>
 <script src="/static/jquery-1.8.3.min.js"></script>
 <link rel="stylesheet" href="/static/Admin/bootstrap/css/bootstrap.min.css" />
 <body>
  <div class="mws-panel grid_8 mws-collapsible"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 订单列表</span> 
    <div class="mws-collapse-button mws-inset">
     <span></span>
    </div>
   </div> 
   <div class="mws-panel-inner-wrap">
    <div class="mws-panel-body no-padding"> 
     <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
      <form action="/adminorderlist" method="get">
        <div class="dataTables_filter" id="DataTables_Table_0_filter">
         <label>搜索订单号: <input type="text" aria-controls="DataTables_Table_0" id="input" name="keywords" /><input type="submit" value="搜索" class="btn"></label>
          {{csrf_field()}}
        </div>
      </form>
      <div id="did">
      <table class="mws-table mws-datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"> 
       <thead> 
        <tr role="row">
         <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 155px;">ID</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">订单号</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">用户id</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">收货地址</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">总计</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">支付方式</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">发货方式</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 99px;">操作</th>
        
        </tr> 
       </thead> 
       <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($data as $row)
        <tr class="odd"> 
         <td class="  sorting_1">{{$row->id}}</td> 
         <td class=" ">{{$row->orderNo}}</td> 
         <td class=" ">
          @foreach($data1 as $rr)
            @if($rr->id==$row->user_id)
            {{$rr->name}}
            @endif
          @endforeach
         </td> 
         <td class=" address">
          @if($data4->id==$row->address_id)
          {{$data4->name}},{{$data4->phone}},{{$data4->info}}
          @endif
         </td> 
         <td class=" ">{{$row->tot}}</td> 
         <td class=" ">
          @foreach($data2 as $rr)
            @if($rr->id==$row->pay_id)
            {{$rr->name}}
            @endif
          @endforeach
         </td> 
         <td class=" ">
          @foreach($data3 as $rr)
            @if($rr->id==$row->send_id)
            {{$rr->name}}
            @endif
          @endforeach
         </td> 
         <td class=" "> 
          <span class="btn-group">
          <a class="btn btn-danger del"  name="{{$row->id}}">　删除　</a>
            <a href="/orderinfo/{{$row->id}}" class="btn btn-success">订单详情</a>
          </span> 
         </td> 
        </tr>
        @endforeach
       </tbody>
      </table>
      </div>
      <div class="dataTables_paginate paging_two_button" id="pages">
      
      </div>
     </div> 
    </div>
   </div> 
  </div>
 </body>
</html>


<script>
  $(".del").dblclick(function(){
    id=$(this).attr("name");
    oo=$(this);
    $.get("/orderdel",{id:id},function(data){
      if(data==1){
        oo.parents("tr").remove();
      }
      if(data==2){
        alert("删除失败");
      }
      if(data==3){
        alert("删除子数据失败");
      }
    });
  });
   
  
  
</script>
@endsection
@section("title","订单列表")