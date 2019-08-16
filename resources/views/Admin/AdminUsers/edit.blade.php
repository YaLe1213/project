@extends("Admin.Adminpublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>管理员角色修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/adminusers/{{$adminuser->id}}" method="post"> 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">管理员名字</label> 
       <div class="mws-form-item"> 
        <input type="text" value="{{$adminuser->name}}" disabled /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">角色</label> 
       <div class="mws-form-item"> 
        <select name="rid">
          @foreach($role as $row)
          @if($row->id==$adminuser->rid)
            <option value="{{$row->id}}" selected>{{$row->name}}</option>
          @else
            <option value="{{$row->id}}">{{$row->name}}</option>
          @endif
          @endforeach
        </select>
       </div> 
      </div> 
     </div> 
     <div class="mws-button-row"> 
      {{csrf_field()}}
      {{method_field("PUT")}}
      <input type="submit" value="Submit" class="btn btn-danger" /> 
      <input type="reset" value="Reset" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section("title","管理员角色修改")