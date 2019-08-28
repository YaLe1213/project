@extends("Admin.Adminpublic.adminpublic")
@section("admin")
<html>
 <head></head>
  <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>商品添加</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/admingoods" method="post" enctype="multipart/form-data" > 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">商品名称</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="name" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">分类</label> 
       <div class="mws-form-item"> 
        <select name="cate_id" class="small">
          <option value="0">--请选择--</option>
          @foreach($cates as $row)
            <option value="{{$row->id}}">{{$row->name}}</option>
          @endforeach
        </select>
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">图片</label> 
       <div class="mws-form-item"> 
        <input type="file" class="large"  name="img" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">店名</label> 
       <div class="mws-form-item"> 
        <select name="shopid" class="small">
          <option value="0">--请选择--</option>
          @foreach($shops as $row)
            <option value="{{$row->id}}">{{$row->name}}</option>
          @endforeach
        </select>
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">市场价</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large"  name="shopprice" /><span></span>
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">门店价</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large"  name="marketprice" /><span></span>
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">库存</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large"  name="Stock" /><span></span>
       </div> 
      </div>
      <div class="mws-form-row"> 
       <label class="mws-form-label">商品描述</label> 
       <div class="mws-form-item"> 
        <textarea name="desc" cols="80" rows="10"></textarea><span></span>
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
@section("title","商品添加")