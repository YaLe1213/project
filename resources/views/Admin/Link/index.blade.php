@extends("Admin.Adminpublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <script src="/static/jquery-1.8.3.min.js"></script>
 <link rel="stylesheet" href="/static/Admin/bootstrap/css/bootstrap.min.css" />
 <body>
  <div class="mws-panel grid_8 mws-collapsible"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 友情链接列表</span> 
    <div class="mws-collapse-button mws-inset">
     <span></span>
    </div>
   </div> 
   <div class="mws-panel-inner-wrap">
    <div class="mws-panel-body no-padding"> 
     <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
      <form action="/adminarticel" method="get">
        <div class="dataTables_filter" id="DataTables_Table_0_filter">
         <label>搜索名字: <input type="text" aria-controls="DataTables_Table_0" id="input" name="keywords" /><input type="submit" value="搜索" class="btn"></label>
          {{csrf_field()}}
        </div>
      </form>
      <div id="did">
      <table class="mws-table mws-datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"> 
       <thead> 
        <tr role="row">
         <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 155px;">ID</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">名称</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">链接地址</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">状态</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 99px;">操作</th>
        
        </tr> 
       </thead> 
       <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($data as $row)
        <tr class="odd"> 
         <td class="  sorting_1">
          <input type="checkbox" class="check" value="{{$row->id}}"> {{$row->id}}</td> 
         <td class=" ">{{$row->name}}</td> 
         <td class=" ">{{$row->url}}</td> 
         <td class=" ">
           <select class="select" name="{{$row->id}}">
             <option value="0" @if($row->status==0) selected @endif>未启用</option>
             <option value="1" @if($row->status==1) selected @endif>启用</option>
           </select>
         </td> 
         <td class=" "> 
          <span class="btn-group">
          <a class="btn btn-danger del"  name="{{$row->id}}">　删除　</a>
            <a href="/linkinfo/{{$row->id}}" class="btn btn-success">链接详情</a>
            <a href="/adminlink/{{$row->id}}/edit" class="btn btn-success">链接修改</a>
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
<script>
  $(".del").dblclick(function(){
    id=$(this).attr('name');
    o=$(this);
    $.get("/linkdel",{id:id},function(data){
      if (data==1) {
        o.parents('.odd').remove();
      }else if(data==2){
        alert("删除友情链接失败");
      }
    });
  });
  // 修改状态
  $(".select").change(function(){
    id=$(this).attr('name');
    sta=$(this).val();
    // ajax
    $.get("/linkstatus",{id:id,sta:sta},function(data){
      if (data==1) {
        alert("修改成功");
      }else{
        alert("修改失败");
      }
    });
  });
</script>
</html>

@endsection
@section("title","友情链接列表")