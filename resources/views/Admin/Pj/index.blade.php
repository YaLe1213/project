@extends("Admin.Adminpublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <script src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8 mws-collapsible"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 评论列表</span> 
    <div class="mws-collapse-button mws-inset">
     <span></span>
    </div>
   </div> 
   <div class="mws-panel-inner-wrap">
    <div class="mws-panel-body no-padding"> 
     <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
    
      <table class="mws-table mws-datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"> 
       <thead> 
        <tr role="row">
         <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 155px;">ID</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">订单号</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 133px;">评论人</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 133px;">评论内容</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 133px;">评论时间</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 99px;">操作</th>
        
        </tr> 
       </thead> 
       <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($data as $row)
        <tr class="odd"> 
         <td class="  sorting_1">{{$row->id}}</td> 
         <td class="  sorting_1">{{$row->orderNo}}</td> 
         <td class="  sorting_1">{{$row->uname}}</td> 
         <td class=" ">{{$row->con}}</td> 
         <td class=" ">{{date("Y-m-d H:i:s",$row->created_at)}}</td> 
         <td class=" "> 
          <span class="btn-group">  
            
            <!-- <a href="/paytype/{{$row->id}}/edit" class="btn btn-success">评论修改</a> -->
            <a href="/pj/{{$row->id}}" class="btn btn-success del" name="{{$row->id}}">删除</a>
           
          </span> 
         </td> 
        </tr>
        @endforeach
        
       </tbody>
      </table>
     <div class="dataTables_paginate paging_two_button" id="pages">
       
      </div>
     </div> 
    </div>
   </div> 
  </div>
 </body>
</html>
<!-- <script>
   // 修改状态
  $(".del").dblclick(function(){
    id=$(this).attr('name');
    
    alert(id);
    // ajax
    $.get("/adminpingdel",{id:id},function(data){
      if (data==1) {
        alert("修改成功");
      }else if(data==2){
        alert("修改失败");
      }
    });
  }); 
</script> -->
</html>
@endsection
@section("title","评论列表")