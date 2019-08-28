@extends("Admin.Adminpublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <script src="/static/jquery-1.8.3.min.js"></script>
 <link rel="stylesheet" href="/static/Admin/bootstrap/css/bootstrap.min.css" />
 <body>
  <div class="mws-panel grid_8 mws-collapsible"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> {{$data1->name}}</span> 
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
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">商品名称</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">商品分类</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">图片</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">店名</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">描述</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">状态</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 99px;">审核</th>
        
        </tr> 
       </thead> 
       <tbody role="alert" aria-live="polite" aria-relevant="all">
        
        <tr class="odd"> 
         <td class="  sorting_1">{{$data1['id']}}</td> 
         <td class=" ">{{$data1['name']}}</td> 
         <td class=" ">
       
            {{$data1->cate_id}}
      
         </td> 
         <td class=" "><img src="{{$data1->img}}" alt=""></td> 
         <td class=" ">
         
            {{$data1->shopid}}
      
         </td> 
         <td class=" ">{!!$data1->desc!!}</td> 
         <td class=" ">{{$data1->status}}</td> 
         <td class=" "> 
          <span class="btn-group">
            @if($data1->status=='已审核')
            
            @else if($data1->status=='未审核')
            <a class="btn btn-danger" onclick="exa({{$data1['id']}},false)" >违规</a>
            <a href="javascript:void(0)" class="btn btn-success" onclick="exa({{$data1['id']}},true)">通过</a>
            @endif
          </span> 
         </td> 
        </tr>
      
       </tbody>
      </table>
      </div>
      <div class="dataTables_paginate paging_two_button" id="pages">
      
      </div>j
     </div> 
    </div>
   </div> 
  </div>
 </body>
</html>
<script>
  function exa(id,bool){
    // alert(bool);
    $.get("/goodsexa",{id:id,bool:bool},function(data){
      alert(data);
    });
  };
</script>
@endsection
@section("title","商品列表")