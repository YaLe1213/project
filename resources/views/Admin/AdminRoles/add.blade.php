@extends("Admin.Adminpublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>角色添加</span> 
   </div> 
   <div class="mws-panel-body no-padding" style="overflow: hidden;"> 
    <table border="1px" align="center" width="1000"  style="margin-top:50px;">
      <caption><h4>已经有的角色</h4></caption>
      <tr>
        <th>角色名</th>
        <td colspan="3" style="color:red;">　***请按以下规格添加管理员</td>
      </tr>
      <tr>
        @foreach($role as $row)
        <td>{{$row->name}}</td>
        @endforeach
      </tr>
    </table>
    <form class="mws-form" action="/adminroles" method="post"> 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">角色名字</label> 
       <div class="mws-form-item"> 
        <input type="text" class="small" name="name" /> 
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
@section("title","角色添加")