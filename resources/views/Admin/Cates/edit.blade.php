@extends("Admin.Adminpublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>分类修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/admincates/{{$cate->id}}" method="post"> 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">分类名字</label> 
       <div class="mws-form-item"> 
        <input type="text" class="small" name="name" value="{{$cate->name}}" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">父类</label> 
       <div class="mws-form-item"> 
        <select name="pid" class="small">
          <option value="0">--请选择--</option>
          @foreach($cates as $row)
          @if($row->id==$cate->pid)
            <option value="{{$row->id}}" selected>{{$row->name}}</option>
          @else
            <option value="{{$row->id}}" >{{$row->name}}</option>
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
@section("title","分类修改")