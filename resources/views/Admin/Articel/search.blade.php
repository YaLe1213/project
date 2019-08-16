

     <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
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
         <td class="  sorting_1">{{$row->id}}</td> 
         <td class=" ">{{$row->title}}</td> 
         <td class=" ">{{$row->editor}}</td> 
         <td class=" "><img src="{{$row->thumb}}" alt=""></td> 
         <td class=" ">{!!$row->desc!!}</td> 
         <td class=" "> 
          <span class="btn-group"><a href="javascript:void(0)" class="btn btn-danger" onclick="del({{$row->id}})">　删除　</a>
            <a href="/userinfo/{{$row->id}}" class="btn btn-success">公告详情</a>
          </span> 
         </td> 
        </tr>
        @endforeach
        
       </tbody>
      </table>
      <div class="dataTables_paginate paging_two_button" id="pages">
        @foreach($pp as $p)
        <button class="btn btn-warning" onclick="page({{$p}})">{{$p}}</button>
        @endforeach
      </div>
      </div>
     </div> 
    </div>
   


