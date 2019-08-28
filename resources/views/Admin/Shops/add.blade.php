@extends("Admin.Adminpublic.adminpublic")
@section("admin")
<html>
 <head></head>
  <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>门店添加</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/shops" method="post" enctype="multipart/form-data" > 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">门店名</label> 
       <div class="mws-form-item"> 
        <input type="text" class="small" name="name" />
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">店长</label> 
       <div class="mws-form-item"> 
        <select name="userid" id="" class="small">
          <option value="">--请选择店主--</option>
          @foreach($users as $row)
          <option value="{{$row->id}}">{{$row->name}}</option>
          @endforeach
        </select>
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">店长邮箱</label> 
       <div class="mws-form-item"> 
        <input type="text" class="small"  name="email" />
       </div> 
      </div> 
      
     </div> 
     <div class="mws-button-row"> 
      {{csrf_field()}}
      <input type="submit" value="Submit" class="btn btn-danger" /> 
      <input type="reset" value="Reset" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section("title","门店添加")