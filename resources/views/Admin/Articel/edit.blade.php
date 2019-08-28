@extends("Admin.Adminpublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <script type="text/javascript" charset="utf-8" src="/static/Admin/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/static/Admin/ueditor/ueditor.all.min.js"></script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加
载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="/static/Admin/ueditor/lang/zh-cn/zh-cn.js">
</script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>公告修改</span> 
   </div> 
   <div class="mws-panel-body no-padding" style="overflow: hidden;"> 
    
    <form class="mws-form" action="/adminarticel" method="post" enctype="multipart/form-data"> 
     <div class="mws-form-inline">
     <div class="mws-form-row"> 
       <label class="mws-form-label">标题</label> 
       <div class="mws-form-item"> 
        <input type="text" class="small" value="{{$data->title}}" name="title" /> 
       </div> 
      </div>  
      <div class="mws-form-row"> 
       <label class="mws-form-label">作者</label> 
       <div class="mws-form-item"> 
        <input type="text" class="small" value="{{$data->editor}}" name="editor" /> 
       </div> 
      </div> 

      <div class="mws-form-row"> 
       <label class="mws-form-label">图片</label> 
       <div class="mws-form-item"> 
        <input type="file" class="large"  name="thumb" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">描述</label> 
       <div class="mws-form-item"> 
        <script id="editor" type="text/plain" name="desc" value="{{$data->desc}}" style="width:900px;height:500px;"></script>
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
<script type="text/javascript">
//实例化编辑器
//建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接
// 调用UE.getEditor('editor')就能拿到相关的实例
var ue = UE.getEditor('editor');
</script>
</html>
@endsection
@section("title","公告修改")