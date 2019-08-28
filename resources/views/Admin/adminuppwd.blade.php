@extends("Admin.Adminpublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>修改密码</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/adminpwdsave" method="post"> 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">原密码</label> 
       <div class="mws-form-item"> 
        <input type="password" class="small" name="ypwd" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">新密码</label> 
       <div class="mws-form-item"> 
        <input type="password" class="small" name="pwd" /> 
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">确认新密码</label> 
       <div class="mws-form-item"> 
        <input type="password" class="small" name="repwd" /> 
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
@section("title","修改密码")