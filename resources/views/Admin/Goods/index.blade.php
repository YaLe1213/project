@extends("Admin.Adminpublic.adminpublic")
@section("admin")
@if(count($data1)>0)
<html>
 <head></head>
 <script src="/static/jquery-1.8.3.min.js"></script>
 <link rel="stylesheet" href="/static/Admin/bootstrap/css/bootstrap.min.css" />
 <body>
  <div class="mws-panel grid_8 mws-collapsible"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 未审核商品列表</span> 
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
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">商品名称</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">商品分类</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">图片</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">店名</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">描述</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">状态</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 99px;">操作</th>
        
        </tr> 
       </thead> 
       <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($data1 as $row)
        <tr class="odd"> 
         <td class="  sorting_1">{{$row['id']}}</td> 
         <td class=" ">{{$row['name']}}</td> 
         <td class=" ">
          @foreach($cates as $ro)
          @if($ro->id==$row['cate_id'])
            {{$ro->name}}
          @endif
          @endforeach
         </td> 
         <td class=" "><img src="{{$row->img}}" alt=""></td> 
         <td class=" ">
          @foreach($shops as $ro)
          @if($ro->id==$row['shopid'])
            {{$ro->name}}
          @endif
          @endforeach
         </td> 
         <td class=" ">{!!$row->desc!!}</td> 
         <td class=" ">{{$row->status}}</td> 
         <td class=" "> 
          <span class="btn-group">
          <a class="btn btn-danger del" name="{{$row['id']}}">　删除　</a>  
            <a href="/goodsinfo/{{$row['id']}}" class="btn btn-success">商品详情</a>
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
@endif
@if(count($data2)>0)
<html>
 <head></head>
 <script src="/static/jquery-1.8.3.min.js"></script>
 <link rel="stylesheet" href="/static/Admin/bootstrap/css/bootstrap.min.css" />
 <body>
  <div class="mws-panel grid_8 mws-collapsible"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 已审核商品列表</span> 
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
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">商品名称</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">商品分类</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">图片</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">是否上架</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">是否精品</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">是否热销产品</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">是否新品</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">是否推荐</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">是否删除</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">状态</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 99px;">操作</th>
        
        </tr> 
       </thead> 
       <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($data2 as $row)
        <tr class="odd"> 
         <td class="  sorting_1">{{$row['id']}}</td> 
         <td class=" ">{{$row['name']}}</td> 
         <td class=" ">
          @foreach($cates as $ro)
          @if($ro->id==$row['cate_id'])
            {{$ro->name}}
          @endif
          @endforeach
         </td> 
         <td class=" "><img src="{{$row->img}}" alt=""></td> 
         <td class=" ">
          <select class="saleselect" name="{{$row->id}}">
             <option value="0" @if($row->isSale==0) selected @endif >否</option>
             <option value="1" @if($row->isSale==1) selected @endif>是</option>
           </select>
         </td> 

<!-- <script>
    // 修改状态
  $(".saleselect").change(function(){
    id=$(this).attr('name');
    sta=$(this).val();
    alert(sta);
    // ajax
    $.get("/goodssalestatus",{id:id,sta:sta},function(data){
      
    });
  });
</script> -->
         <td class=" ">
          <select class="select" name="{{$row->id}}">
             <option value="0" @if($row->isBest==0) selected @endif >否</option>
             <option value="1" @if($row->isBest==1) selected @endif>是</option>
           </select>
         </td> 
         <td class=" ">
          <select class="select" name="{{$row->id}}">
             <option value="0" @if($row->isHot==0) selected @endif >否</option>
             <option value="1" @if($row->isHot==1) selected @endif>是</option>
           </select>
         </td> 
         <td class=" ">
          <select class="select" name="{{$row->id}}">
             <option value="0" @if($row->isNew==0) selected @endif >否</option>
             <option value="1" @if($row->isNew==1) selected @endif>是</option>
           </select>
         </td> 
         <td class=" ">
          <select class="select" name="{{$row->id}}">
             <option value="0" @if($row->isRecom==0) selected @endif >否</option>
             <option value="1" @if($row->isRecom==1) selected @endif>是</option>
           </select>
         </td> 
         <td class=" ">
          <select class="select" name="{{$row->id}}">
             <option value="0" @if($row->isdel==0) selected @endif >否</option>
             <option value="1" @if($row->isdel==1) selected @endif>是</option>
           </select>
         </td> 
         <td class=" ">{{$row->status}}</td> 
         <td class=" "> 
          <span class="btn-group">
          <a class="btn btn-danger del" name="{{$row['id']}}">　删除　</a>  
            <a href="/goodsinfo/{{$row['id']}}" class="btn btn-success">详情</a>
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
@endif
@if(count($data3)>0)
<html>
 <head></head>
 <script src="/static/jquery-1.8.3.min.js"></script>
 <link rel="stylesheet" href="/static/Admin/bootstrap/css/bootstrap.min.css" />
 <body>
  <div class="mws-panel grid_8 mws-collapsible"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 违规商品列表</span> 
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
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">商品名称</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">商品分类</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">图片</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">店名</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">描述</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">状态</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 99px;">操作</th>
        
        </tr> 
       </thead> 
       <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($data3 as $row)
        <tr class="odd"> 
         <td class="  sorting_1">{{$row['id']}}</td> 
         <td class=" ">{{$row['name']}}</td> 
         <td class=" ">
          @foreach($cates as $ro)
          @if($ro->id==$row['cate_id'])
            {{$ro->name}}
          @endif
          @endforeach
         </td> 
         <td class=" "><img src="{{$row->img}}" alt=""></td> 
         <td class=" ">
          @foreach($shops as $ro)
          @if($ro->id==$row['shopid'])
            {{$ro->name}}
          @endif
          @endforeach
         </td> 
         <td class=" ">{{$row->desc}}</td> 
         <td class=" ">{{$row->status}}</td> 
         <td class=" "> 
          <span class="btn-group">
            <a class="btn btn-danger del" name="{{$row['id']}}">　删除　</a>
            <a href="/goodsinfo/{{$row['id']}}" class="btn btn-success">商品详情</a>
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
@endif
<script>
  $(".del").click(function(){
    oo=$(this);
    id=oo.attr('name');
    $.get("/goodsdel",{id:id},function(data){
      if(data==1){
        oo.parents("tr").remove();
      }
      if(data==2){
        alert("删除失败");
      }
    });
  });

</script>
@endsection
@section("title","商品列表")