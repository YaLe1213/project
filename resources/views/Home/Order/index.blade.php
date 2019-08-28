@extends("Home.Home.index")
@section("home")
<script type="text/javascript" src="/static/Home/js/js.js"></script>
<script src="/static/jquery-1.8.3.min.js"></script>
  <div class="positions">
   当前位置：<a href="index.html">首页</a> &gt; <a href="#" class="posCur">填写核对订单</a>
  </div><!--positions/-->
  <div class="cont">
   <div class="carImg"><img src="/static/Home/images/car2.jpg" width="961" height="27" /></div>
   <!-- 收货地址 -->
   <h4 class="orderTitle">收货地址　　　<span class="green add">[添加]</span> </h4>
   <table class="ord">
    @foreach($address as $row)
    <tr>
     <td width="30%">
      <input type="checkbox" class="check" name="{{$row->id}}" /> {{$row->name}}
     </td>
     <td>{{$row->phone}}</td>
     <td width="50%">
      {{$row->info}}
     </td>
  
     <td>
      <span class="green del" name="{{$row->id}}">[删除]</span> | <span class="green add">[添加]</span> 
     </td>
    </tr>
    @endforeach
   </table><!--ord/-->
 
   <!-- 添加收获地址 -->
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

   <!-- 支付方式 -->
   <h4 class="orderTitle">支付方式</h4>
   <ul class="zhiList">
   
   <div class="clears"></div>
  </ul><!--zhiList/-->
  <div class="zhifufangshi">
   <ul class="zhifubao">
    @foreach($pays as $row)
    <input type="radio" name="{{$row->id}}" />{{$row->name}}
    @endforeach
    <div class="clear"></div>
   </ul>
  </div><!--zhzhifufangshii/-->
  <h4 class="orderTitle">购物清单</h4>
  <table class="orderList">
    <tr>
     <th width="20"></th>
     <th width="430">商品</th>
     <th width="135">单价</th>
     <th width="135">数量</th>
     <th width="135">总金额</th>
     <th>运费</th>
    </tr>
    @foreach($data as $row)
    <tr>
     <td></td>
     <td>
      <dl>
       <dt><a href="proinfo.html"><img src="{{$row['img']}}" width="85" height="85" /></a></dt>
       <dd>{{$row['name']}}<br /><span class="red">有货：</span>从上海出发</dd>
       <div class="clears"></div>
      </dl>
     </td>
     <td><strong class="red">￥{{$row['price']}}</strong></td>
     <td>
     <div class="jia_jian">
      <!-- <img src="/static/Home/images/jian.jpg" width="21" height="25" class="jian" /> -->
      <input type="text" class="shuliang" value="{{$row['num']}}" disabled/>
      <!-- <img src="/static/Home/images/jia.jpg" width="21" height="25" class="jia" /> -->
     </div>
     </td>
     <td><strong class="red">￥{{$row['tot']}}</strong></td>
     <td><strong class="red">￥10</strong></td>
    </tr>
    @endforeach
    <tr>
     
    </tr>
   </table><!--orderList/-->
   <form action="/suborder" method="post">
   <table class="zongjia" align="right">
    <tr>
     <td width="120" align="left">商品总价：</td>
     <td width="60"><strong class="red">+{{$sum}}</strong></td>
    </tr>
    <tr>
     <td width="120" align="left">运费总额：</td>
     <td><strong class="red">+121.88</strong></td>
    </tr>
    <tr>
     <td width="120" align="left">促销优惠：</td>
     <td><strong class="red">+341.88</strong></td>
    </tr>
    <tr>
     <td width="120" align="left">合计：</td>
     <td><strong class="red">+2271.88</strong></td>
    </tr>
    <input type="hidden" name="address_id" value="" />
    <input type="hidden" name="pay_id" value="" />
    <tr>
      <!-- 提交订单 -->
     <td colspan="2" style="height:50px;">
      {{csrf_field()}}
      <button  type="submit"><img src="/static/Home/images/tijao.png" width="142" height="32" /></button>

     </td>
    </tr>
   </table><!--zongjia/-->
   </form>
   <div class="clears"></div>
  </div><!--cont/-->
<script>
  // 选择收货地址
  $(".check").change(function(){
      if($(this).attr('checked')){
        $("input[name='address_id']").val($(this).attr("name"));
      }else{
        $("input[name='address_id']").val(" ");
      }
  });
  // 选择支付方式
  $("input[type='radio']").change(function(){
    if($(this).attr('checked')){
      id=$(this).attr('name');
      $("input[name='pay_id']").val(id);
    }
  });
  
</script>
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
<script>
  $(".del").click(function(){
    id=$(this).attr("name");
     o=$(this);
    $.get("/addressdel",{id:id},function(data){
      if(data==1){
        o.parents("tr").remove();
      }else if(data==2){
        alert("删除失败!");
      }
    });
  });
</script>
@endsection
@section("title","下单")