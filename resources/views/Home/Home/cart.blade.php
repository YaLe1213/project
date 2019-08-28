@extends("Home.Home.index")
@section("home")
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">

</head>
<body>
  <div class="positions">
   当前位置：<a href="/">首页</a> &gt; <a href="#" class="posCur">购物车</a>
  </div><!--positions/-->
  <div class="cont">
   <div class="carImg"><img src="/static/Home/images/car1.jpg" width="951" height="27" /></div>
   <table class="orderList">
    <tr>
     <th width="20"></th>
     <th width="430">商品</th>
     <th width="135">单价</th>
     <th width="135">数量</th>
     <th width="135">总金额</th>
     <th>操作</th>
    </tr>
    <!-- 商品开始 -->
    @foreach($data as $row)
    <tr>
     <td><input type="checkbox" value="{{$row['id']}}" /></td>
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
      <img src="/static/Home/images/jian.jpg" width="21" height="25" class="jian" />
      <input type="text" class="shuliang" name="{{$row['id']}}" value="{{$row['num']}}" />
      <img src="/static/Home/images/jia.jpg" width="21" height="25" class="jia" />
     </div>
     </td>
     <td style="color:red;">￥<strong class="red tot">{{$row['tot']}}</strong></td>
     <td>
      <a href="#" class="green">收藏</a><br />
      <a href="javascript:void(0)" class="green del" name="{{$row['id']}}">删除</a>
     </td>
    </tr>
    @endforeach
    <tr>
     <td colspan="6"><a href="/alldel" class="shanchu"><img src="/static/Home/images/lajio.jpg" /> 全部删除</a></td>
    </tr>
   </table><!--orderList/-->
   <div class="zongji">
    总计(不含运费)：<strong class="red sum" >￥0</strong>
   </div><!--zongji/-->
   <div class="jiesuan">
    <!-- 结算 -->
    <a href="/" class="jie_1">继续购物&gt;&gt;</a>
    <a href="javascript:void(0)" class="jie_2">立即结算&gt;&gt;</a>
    <div class="clears"></div>
   </div><!--jiesuan/-->
   <div class="clears"></div>
  </div><!--cont/-->
</body>
<script>
  $(".jian").click(function(){

    num =$(this).next('input').val();
    id=$(this).next('input').attr("name");
    o=$(this);
    if(num){
      $.get("cartjian",{num:num,id:id},function(data){
        o.next('input').val(data.num);
        o.parents('tr').find('.tot').html(data.tot);
        // alert(data);
      },'json');
    }
  });
  $(".jia").click(function(){
    num =$(this).prev('input').val();
    id=$(this).prev('input').attr("name");
    oo=$(this);
    if(num){
      $.get("cartjia",{num:num,id:id},function(data){
        oo.prev('input').val(data.num);
        oo.parents('tr').find('.tot').html(data.tot);
        // alert(data);
      },'json');
    }
  });
  // 选择商品
  arr=[];
  $(":checkbox").change(function(){
    id=$(this).val();
    if($(this).attr("checked")){
      arr.push(id);
    }else{
      // 去除没选中的id
      // $id1=$(this).val();
      // 找元素索引
      Array.prototype.indexOf = function(val) {
        for (var i = 0; i < this.length; i++) {
          if (this[i] == val) return i;
        }
        return -1;
      };
      // 通过元素索引 利用js固有的函数删除元素
      Array.prototype.remove = function(val) {
        var index = this.indexOf(val);
        if (index > -1) {
          this.splice(index, 1);
        }
      };
      // 删除
      arr.remove(id);
    }

    // ajax 总计
    $.get("/carttot",{arr:arr},function(data){
      $(".sum").html("￥"+data.sum);
    },'json');
  });
  // 结算
  $(".jie_2").click(function(){
    if($(":checkbox").is(":checked")){
      $.get("/jiesuan",{arr:arr},function(data){
        if(data){
          window.location="/order/insert";
        }
      });
    }else{
      alert("没有选择商品, 请选择商品!");
    }
  });
  // 商品删除
  $(".del").click(function(){
    id=$(this).attr("name");
    o=$(this);
    $.get("/cartdel",{id:id},function(data){
      if(data==1){
        o.parents("tr").remove();
      }
    });
  });
</script>
</html>

@endsection
@section("title","我的购物车")
