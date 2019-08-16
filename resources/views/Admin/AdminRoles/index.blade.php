@extends("Admin.Adminpublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8 mws-collapsible"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 角色列表</span> 
    <div class="mws-collapse-button mws-inset">
     <span></span>
    </div>
   </div> 
   <div class="mws-panel-inner-wrap">
    <div class="mws-panel-body no-padding"> 
     <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
      <!-- <form action="/adminroles" method="get"> -->
        <div class="dataTables_filter" id="DataTables_Table_0_filter">
         <label>搜索名字: <input type="text" aria-controls="DataTables_Table_0" name="keywords" /><input type="submit" value="搜索" class="btn" onclick="search()"></label>
        </div>
      <!-- </form> -->
      <div id="dd">
      <table class="mws-table mws-datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"> 
        
       <thead> 
        <tr role="row">
         <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 155px;">ID</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">Name</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 133px;">Status</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 99px;">Action</th>
        
        </tr> 
       </thead> 
       <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($adminroles as $row)
        <tr class="odd"> 
         <td class="  sorting_1">{{$row->id}}</td> 
         <td class=" ">{{$row->name}}</td> 
         <td class=" ">{{$row->status}}</td> 
         <td class=" "> 
          <span class="btn-group">  
            <form action="/adminroles/{{$row->id}}" method="post">
              {{csrf_field()}}
              {{method_field("DELETE")}}
              <button class="btn btn-warning"><i class="icon-trash">删除角色</i></button>
            </form>
            <a href="/adminroles/{{$row->id}}/edit" class="btn btn-success"><i class="icon-pencil">分配权限</i></a>
            <!-- <a href="/userinfo/{{$row->id}}" class="btn btn-success">角色详情</a> -->
           
          </span> 
         </td> 
        </tr>
        @endforeach
        
       </tbody>
      </table>
      
     <div class="dataTables_paginate paging_two_button" id="pages">
      {{$adminroles->render()}}
     </div>
    </div>
     </div> 
    </div>
   </div> 
  </div>
 </body>
</html>
<script>
  function search(){
    // 获取搜索框里的内容
    k=$("input[name=keywords]").val();
    // alert(k);
    // ajax 请求
    $.get("/adminroles",{k:k},function(data){
      // alert(data);
      $("#dd").html(data);
    });
  }
</script>
</html>
@endsection
@section("title","角色列表")