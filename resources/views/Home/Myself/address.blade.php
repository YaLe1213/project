
@extends("Home.Myself.index")
@section("position")
<script src="/static/jquery-1.8.3.min.js"></script>
  <div class="positions">
   当前位置：<a href="/">首页</a> &gt; <a href="/myself">会员中心</a>
    &gt; <a href="#" class="posCur">收货地址</a>
  </div><!--positions/-->
@endsection
@section("info1")
   <h2 class="oredrName">
    收货地址 　　　<span class="green add">[添加]</span> 
   </h2>
   <div class="address">
    <form action="/addressinsert" method="post">
      <div class="addList">
       <label><span class="red">* </span>选择地区:</label>
       <select id="cid" name="address">
        <option class="ss">--请选择--</option>
       </select>
      </div><!--addList-->
      <div class="addList">
       <label><span class="red">* </span>详细地址:</label>
       <input type="text" name="info" />
      </div><!--addList-->
      <div class="addList">
       <label><span class="red">* </span>收件人:</label>
       <input type="text" name="name" />
      </div><!--addList-->
      <div class="addList">
       <label><span class="red">* </span>手机号码:</label>
       <input type="text" name="phone" />
      </div><!--addList--> 
      <div class="addList2">
       <input type="image" src="/static/Home/images/queren.jpg" width="100" height="32" />
       {{csrf_field()}}
      </div><!--addList2/-->
    </form>
    
   
   </div><!--address/-->
   <table class="vipAdress">
    <tr>
     <th>收货人</th>
     <th>手机号</th>
     <th>收货地址</th>
     <th>是否默认</th>
     <th>操作</th>
    </tr>
    @foreach($myaddress as $row)
    <tr>
     <td>{{$row->name}}</td>
     <td>{{$row->phone}}</td>
     <td>{{$row->info}}</td>
     <td>@if($row->isDefault==0) 否@else 是@endif</td>
     <td><span><a href="/homeaddressdel/{{$row->id}}">[删除]</a></span> | <span class="green add">[添加]</span> </td>
    </tr>
    @endforeach
   </table><!--vipAdress/-->
<script type="text/javascript">
  //第一级数据
    $.ajax({
      url:'/address',//url地址
      type:'get',//请求方式
      data:{upid:0},
      async:true,//异步处理
      dataType:'json',//返回响应数据类型
      //Ajax 响应成功匿名函数
      success:
      function(data){
        // alert(data);
        //遍历
        for(var i=0;i<data.length;i++){
          $(".ss").attr("disabled",true);
          // alert(data[i].name);
          //存储在option
          option='<option value="'+data[i].id+'">'+data[i].name+'</option>';
          // alert(option);
          //把带有数据的option内部插入到第一个select
          $("#cid").append(option);
        }
      },
      //Ajax 响应失败的匿名函数
      error:
      function(){
        alert("Ajax响应失败");
      }
    });

    //获取其他几级数据 
    //事件委派 live(事件,事件处理器函数)
    // .on(eventType, selector, function)
    $("select").on("change",function(){
      //移除元素
      $(this).nextAll("select").remove();
      // alert($(this).val());
      o=$(this);
      //获取子级的upid
      upid=$(this).val();
      // alert(upid);
      $.ajax({
      url:'/address',//url地址
      type:'get',//请求方式
      data:{upid:upid},
      async:true,//异步处理
      dataType:'json',//返回响应数据类型
      //Ajax 响应成功匿名函数
      success:
      function(data){
        //创建select
        select=$("<select></select>");
        //内部插入option
        select.append('<option value="" class="mm">--请选择--</option>');
        // alert(data);
        //判断
        if(data.length>0){
          //遍历
          for(var i=0;i<data.length;i++){
            // alert(data[i].name);
            //存储在option
            option='<option value="'+data[i].id+'">'+data[i].name+'</option>';
            // alert(option);
            // 把带有数据的option内部插入到创建好的select
            select.append(option);
          }
          //把创建好的select 追加到前一个select后
          o.after(select);
          //禁用其他级别 请选择
          $(".mm").attr("disabled",true);
        }

      },
      //Ajax 响应失败的匿名函数
      error:
      function(){
        alert("Ajax响应失败");
      }
    });
    });

</script>
@endsection
@section("title","我的收货地址")