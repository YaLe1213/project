@extends("Admin.Adminpublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <script src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8 mws-collapsible"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 门店列表</span> 
    <div class="mws-collapse-button mws-inset">
     <span></span>
    </div>
   </div> 
   <div class="mws-panel-inner-wrap">
    <div class="mws-panel-body no-padding"> 
     <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
      <form action="/adminusers" method="get">
        <div class="dataTables_filter" id="DataTables_Table_0_filter">
         <label>搜索名字: <input type="text" aria-controls="DataTables_Table_0" name="keywords" /><input type="submit" value="搜索" class="btn"></label>
        
        </div>
      </form>
      <table class="mws-table mws-datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"> 
       <thead> 
        <tr role="row">
         <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 155px;">ID</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">门店名</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">店主</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 133px;">邮箱</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 133px;">状态</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 133px;">添加时间</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 133px;">修改时间</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 99px;">操作</th>
        
        </tr> 
       </thead> 
       <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($data as $row)
        <tr class="odd"> 
         <td class="  sorting_1">{{$row->id}}</td> 
         <td class=" ">{{$row->name}}</td> 
         <td class=" ">
          @foreach($users as $rr)
            @if($row->userid==$rr->id)
              {{$rr->name}}
            @endif
          @endforeach
        </td> 
         <td class=" ">{{$row->email}}</td> 
         <td class=" ">
           <select class="select" name="{{$row->id}}">
             <option value="-1" @if($row->status==-1) selected @endif>关闭门店</option>
             <option value="0" @if($row->status==0) selected @endif>休息中</option>
             <option value="1" @if($row->status==1) selected @endif>营业中</option>
           </select>
         </td> 
         <td class=" ">{{$row->created_at}}</td> 
         <td class=" ">{{$row->updated_at}}</td> 
         <td class=" "> 
          <span class="btn-group">  
            
            <a href="/shopsdel/{{$row->id}}" class="btn btn-success">门店删除</a>
            <a href="/shops/{{$row->id}}" class="btn btn-success">门店详情</a>
           
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
<script>
   // 修改状态
  $(".select").change(function(){
    id=$(this).attr('name');
    sta=$(this).val();
    // alert(id);
    // ajax
    $.get("/shopstatus",{id:id,sta:sta},function(data){
      if (data==1) {
        alert("修改成功");
      }else if(data==2){
        alert("修改失败");
      }
    });
  }); 
</script>
</html>
@endsection
@section("title","门店列表")