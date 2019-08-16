@extends("Admin.Adminpublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <script src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8 mws-collapsible"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 分类列表</span> 
    <div class="mws-collapse-button mws-inset">
     <span></span>
    </div>
   </div> 
   <div class="mws-panel-inner-wrap">
    <div class="mws-panel-body no-padding"> 
     <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
      <form action="/admincates" method="get">
        <div class="dataTables_filter" id="DataTables_Table_0_filter">
         <label>搜索名字: <input type="text" aria-controls="DataTables_Table_0" name="keywords" /><input type="submit" value="搜索" class="btn"></label>
        
        </div>
      </form>
      <div id="dd">
      <table class="mws-table mws-datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"> 
       <thead> 
        <tr role="row">
         <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 155px;">ID</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">Name</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 189px;">Pid</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 133px;">Path</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 99px;">Action</th>
        
        </tr> 
       </thead> 
       <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($cates as $row)
        <tr class="odd"> 
         <td class="  sorting_1">{{$row->id}}</td> 
         <td class=" ">{{$row->name}}</td> 
         <td class=" ">{{$row->pid}}</td> 
         <td class=" ">{{$row->path}}</td> 
         <td class=" "> 
          <span class="btn-group">  
            <form action="/admincates/{{$row->id}}" method="post">
              {{csrf_field()}}
              {{method_field("DELETE")}}
              <button class="btn btn-warning"><i class="icon-trash">分类删除</i></button>
            </form>
            <a href="/admincates/{{$row->id}}/edit" class="btn btn-success"><i class="icon-pencil">分类修改</i></a>
          </span> 
         </td> 
        </tr>
        @endforeach
        
       </tbody>
      </table>
      </div>
      <div class="dataTables_paginate paging_two_button" id="pages">
        @foreach($pp as $p)
        <button class="btn btn-warning" onclick="page({{$p}})">{{$p}}</button>
        @endforeach
      </div>
     </div> 
    </div>
   </div> 
  </div>
 </body>
</html>
<script>
    // 分页
    function page(page){
      // alert(page);
      // ajax请求
      $.get("/admincates",{page:page},function(data){
        $("#dd").html(data);
        // alert(data);
      });
    }

    // 删除
    // $("#del").click(function(){
    //   id=$(this).val();
    //   $.get("/articeldel",{id:id},function(data){
    //     alert(data);
    //   });
    // });
    

 </script>
</html>
@endsection
@section("title","分类列表")