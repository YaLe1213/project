
@extends("Home.Myself.index")
@section("position")
  <div class="positions">
   当前位置：<a href="/">首页</a> &gt; <a href="/myself">会员中心</a>
    &gt; <a href="#" class="posCur">个人信息</a>
  </div><!--positions/-->
@endsection
@section("info1")
				<h1 class="vipName"><span>用户名：</span>{{$info->name}}  <strong class="vipUp">[点击修改/补充个人信息]</strong></h1>
                <table class="vipMy">
                  <tr>
                    <th>用户名</th>
                    <th>邮箱</th>
                    <th>手机号</th>
                  </tr>
                  <tr>
                    <td>{{$info->name}}</td>
                    <td>@if($info->email=='') 您还没有填写邮箱 @else {{$info->email}} @endif</td>
                    <td>@if($info->phone=='') 您还没有填写手机号 @else {{$info->phone}} @endif</td>
                  </tr>
                </table><!--vipMy/-->
                <div class="address">
                  <form action="/myupdate" method="post">
                    <input type="hidden" value="{{$info->id}}" name="id">
                    <div class="addList">
                       <label><span class="red">* </span>用户名:</label>
                       <input type="text" name="name" value="{{$info->name}}" /><span></span>
                    </div><!--addList-->
                    <div class="addList">
                      <label><span class="red">* </span>邮箱</label>
                      <input type="text" name="email" value="{{$info->email}}" /><span></span>
                    </div><!--addList-->
                    <div class="addList">
                      <label><span class="red">* </span>手机号</label>
                      <input type="text" name="phone" value="{{$info->phone}}" /><span></span>
                    </div><!--addList-->
                    <div class="addList2">
                      {{csrf_field()}}
                    <input type="image" src="/static/Home/images/baocun.png" width="79" height="30" />
                    </div><!--addList2/-->
                  </form>
                </div><!--address/-->
@endsection
@section("title","个人信息")