@extends("Admin.Adminpublic.adminpublic")
@section("admin")

<html>
 <head></head>
 <script src="/static/jquery-1.8.3.min.js"></script>
 <link rel="stylesheet" href="/static/Admin/bootstrap/css/bootstrap.min.css" />
 <body>
  <div class="mws-panel grid_8 mws-collapsible"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 用户订单详情列表</span> 
    <div class="mws-collapse-button mws-inset">
     <span></span>
    </div>
   </div> 
   <div class="mws-panel-inner-wrap">
    <div class="mws-panel-body no-padding"> 
     <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
     
      <div id="did">
      <table class="mws-table mws-datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"> 
       <thead> 
        <tr role="row">
         <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 155px;">ID</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">订单id</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">商品id</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">商品名</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">商品图片</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">商品价格</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">商品数量</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">状态</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 99px;">操作</th>
        
        </tr> 
       </thead> 
       <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($data as $row)
        <tr class="odd"> 
         <td class="  sorting_1">{{$row->id}}</td> 
         <td class=" ">{{$row->order_id}}</td> 
         <td class=" ">{{$row->goods_id}}</td> 
         <td class=" ">{{$row->name}}</td> 
         <td class=" "><img src="{{$row->img}}" alt=""></td> 
         <td class=" ">{{$row->price}}</td> 
         <td class=" ">{{$row->num}}</td> 
         <td class=" ">
           <select name="" class="status">
            <!-- -3'用户拒收,'-2'未付款,'-1'用户取消,'0'代发货,'1'配送中,'2'用户确认收货 -->
             <option value="-3" @if($row->status==-3) selected style="color:red;"@endif>用户拒收</option>
             <option value="-2" @if($row->status==-2) selected style="color:red;"@endif>未付款</option>
             <option value="-1" @if($row->status==-1) selected style="color:red;"@endif>用户取消</option>
             <option value="0" @if($row->status==0) selected style="color:red;"@endif>待发货</option>
             <option value="1" @if($row->status==1) selected style="color:red;"@endif>配送中</option>
             <option value="2" @if($row->status==2) selected style="color:red;"@endif>未收货</option>
             <option value="3" @if($row->status==3) selected style="color:red;"@endif>已收货</option>
           </select>
         </td> 
         <td class=" "> 
          <span class="btn-group">
          <a class="btn btn-danger del"  name="{{$row->id}}">　删除　</a>
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
  $(".del").click(function(){
    id=$(this).attr('name');
    o=$(this);
    $.get("/orderindel",{id:id},function(data){
      if(data==1){
        o.parents(".odd").remove();
      }
      if(data==2){
        alert("删除失败");
      }
    });
  });
  $(".status").change(function(){
    // 订单id
   id=$(this).parents('.odd').find(".sorting_1").html()
   // alert(id);
    sta=$(this).val();
    $.get("/orderstatus",{sta:sta,id:id},function(data){
      if(data==1){
        alert("修改成功");
      }
      if(data==2){
        alert("修改失败!");
      }
    });
  });
</script>
@endsection
@section("title","用户订单详情列表")