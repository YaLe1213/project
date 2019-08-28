@extends("Admin.Adminpublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>友情链接修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/adminlink/{{$data1->id}}" method="post" enctype="multipart/form-data" > 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">名称</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="name" value="{{$data1->name}}" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">链接地址</label> 
       <div class="mws-form-item"> 
        <input type="text" class="small" name="url" value="{{$data1->url}}" /><span></span> 
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">图标</label> 
       <div class="mws-form-item"> 
        <input type="file" class="large"  name="icon" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">网页描述</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large"  name="desc" value="{{$data2->desc}}" /> 
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">电子邮箱</label> 
       <div class="mws-form-item"> 
        <input type="text" class="small"  name="email" value="{{$data2->email}}" /><span></span>
       </div> 
      </div> 
     </div> 
     <div class="mws-button-row"> 
      {{csrf_field()}}
      {{method_field('PUT')}}
      <input type="submit" value="Submit" class="btn btn-danger" /> 
      <input type="reset" value="Reset" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
 <script>
   $("input[name='url']").blur(function(){
    url=$(this).val();
    if(url.match(/^(?=^.{3,255}$)(http?:\/\/)?(www\.)?[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(\.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+(:\d+)*(\/\w+\.\w+)*$/)==null){
      $(this).next("span").css('color','red').html("链接不符合规则");
    }else{
      $(this).next("span").css("color","#7bc144").html("链接可用");
    }
   });

   $("input[name='email']").blur(function(){
    email=$(this).val();
    // alert(email);
    if(email.match(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/)==null){
      $(this).next("span").css('color','red').css("fontSize","1em").html("邮箱不符合规则");
      email=false;
    }else{
      $(this).next("span").css('color','#7bc144').html("邮箱符合规则");
      email=true;
    }
   });
 </script>
</html>
@endsection
@section("title","友情链接修改")