@extends("Admin.Adminpublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <script src="/static/jquery-1.8.3.min.js"></script>
 <link rel="stylesheet" href="/static/Admin/bootstrap/css/bootstrap.min.css" />
 <body>
  <div class="mws-panel grid_8 mws-collapsible"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i> 公告列表</span> 
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
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">标题</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">作者</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 207px;">图片</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 133px;">描述</th>
         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 99px;">操作</th>
        
        </tr> 
       </thead> 
       <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($data as $row)
        <tr class="odd"> 
         <td class="  sorting_1">
          <input type="checkbox" class="check" value="{{$row['id']}}"> {{$row['id']}}</td> 
         <td class=" ">{{$row['title']}}</td> 
         <td class=" ">{{$row['editor']}}</td> 
         <td class=" "><img src="{{$row['thumb']}}" alt=""></td> 
         <td class=" ">{!!$row['desc']!!}</td> 
         <td class=" "> 
          <span class="btn-group"><a href="javascript:void(0)" class="btn btn-danger" value="{{$row['id']}}" id="del">　删除　</a>
            <a href="/userinfo/{{$row['id']}}" class="btn btn-success">公告详情</a>
          </span> 
         </td> 
        </tr>
        @endforeach
        <tr>
          <td colspan="6">
             <button class="btn btn-success" onclick="check(true)">全选</button>
             <button class="btn btn-success" onclick="check(false)">全不选</button>
             <button class="btn btn-success" onclick="fancheck()">反选</button>
             <button class="btn btn-danger" onclick="dele()">删除</button>
          </td>
        </tr>
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
  // 获取input
  inputs=$("input[type='checkbox']");
    // 全选 全不选
    function check(bool){
      // alert(bool);
      for(var i=0;i<inputs.length;i++){
        inputs[i].checked=bool;
      }
    }
    // 反选
    function fancheck(){
      for(var i=0;i<inputs.length;i++){
        inputs[i].checked = !inputs[i].checked;
      }
    }
    // 删除
    function dele(){
      // 删除数据库里的数据
        // 获取id
      arr=[];
      $(".odd").each(function(){
        if($(this).find(":checkbox").attr("checked")){
          id=$(this).find(":checkbox").val();
          arr.push(id);
        }
      });
      // alert(arr);
      
      $.get("/articeldel",{arr:arr},function(data){
        alert(data);
      });

      // 删除tr
      for(var i=inputs.length-1;i>=0;i--){
        if(inputs[i].checked){
          var p = inputs[i].parentNode.parentNode;
          p.remove(p);
        }
      }
      
    }
    // 删除
    // $("#del").click(function(){
    //   id=$(this).val();
    //   $.get("/articeldel",{id:id},function(data){
    //     // alert(data);
    //   });
    // });
    

 </script>
</html>

@endsection
@section("title","公告列表")