
@extends("Home.Myself.index")
@section("position")
  <div class="positions">
   当前位置：<a href="/">首页</a> &gt; <a href="/myself">会员中心</a>
    &gt; <a href="#" class="posCur">修改密码</a>
  </div><!--positions/-->
@endsection
@section("info1")
   <h2 class="oredrName">
    修改密码
    </h2>
    <div class="address" style="display:block">
        <form action="/subpwd" method="post" id="submit">
        <div class="addList">
         <label>原密码:</label>
         <input type="password" class="ypwd" name="ypwd" /><span></span>
        </div><!--addList-->
        <div class="addList">
         <label>新密码:</label>
         <input type="password" class="pwd" name="pwd" /><span></span>
        </div><!--addList-->
        <div class="addList">
         <label>确认密码:</label>
         <input type="password" class="repwd" name="repwd" /><span></span>
        </div><!--addList-->
        <div class="addList2">
            {{csrf_field()}}
         <input type="submit" width="79" height="30" value="保存" />
            
        </div><!--addList2/-->
        </form>
    </div><!--address/-->

@endsection
@section("title","密码修改")