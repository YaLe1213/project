@extends("Admin.Adminpublic.adminpublic")
@section("admin")
<html>
 <head></head>
  <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>门店修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/send/{{$data->id}}" method="post" enctype="multipart/form-data" > 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">快递名</label> 
       <div class="mws-form-item"> 
        <input type="text" class="small" name="name" value="{{$data->name}}" />
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
@section("title","快递方式修改")