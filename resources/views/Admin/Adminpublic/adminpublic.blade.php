<!DOCTYPE html>

<html lang="en">
 <!--<![endif]-->
 <head> 
  <meta charset="utf-8" /> 
  <!-- Viewport Metatag --> 
  <meta name="viewport" content="width=device-width,initial-scale=1.0" /> 
  <!-- Plugin Stylesheets first to ease overrides --> 
  <link rel="stylesheet" type="text/css" href="/static/Admin/plugins/colorpicker/colorpicker.css" media="screen" /> 
  <link rel="stylesheet" type="text/css" href="/static/Admin/custom-plugins/wizard/wizard.css" media="screen" /> 
  <!-- Required Stylesheets --> 
  <link rel="stylesheet" type="text/css" href="/static/Admin/bootstrap/css/bootstrap.min.css" media="screen" /> 
  <link rel="stylesheet" type="text/css" href="/static/Admin/css/fonts/ptsans/stylesheet.css" media="screen" /> 
  <link rel="stylesheet" type="text/css" href="/static/Admin/css/fonts/icomoon/style.css" media="screen" /> 
  <link rel="stylesheet" type="text/css" href="/static/Admin/css/mws-style.css" media="screen" /> 
  <link rel="stylesheet" type="text/css" href="/static/Admin/css/icons/icol16.css" media="screen" /> 
  <link rel="stylesheet" type="text/css" href="/static/Admin/css/icons/icol32.css" media="screen" /> 
  <!-- Demo Stylesheet --> 
  <link rel="stylesheet" type="text/css" href="/static/Admin/css/demo.css" media="screen" /> 
  <!-- jQuery-UI Stylesheet --> 
  <link rel="stylesheet" type="text/css" href="/static/Admin/jui/css/jquery.ui.all.css" media="screen" /> 
  <link rel="stylesheet" type="text/css" href="/static/Admin/jui/jquery-ui.custom.css" media="screen" /> 
  <!-- Theme Stylesheet --> 
  <link rel="stylesheet" type="text/css" href="/static/Admin/css/mws-theme.css" media="screen" /> 
  <link rel="stylesheet" type="text/css" href="/static/Admin/css/themer.css" media="screen" /> 
  <link rel="stylesheet" type="text/css" href="/static/Admin/css/my.css" media="screen" /> 
  <title>@yield("title")</title> 
 </head> 
 <body> 
  <!-- Header --> 
  <div id="mws-header" class="clearfix"> 
   <!-- Logo Container --> 
   <div id="mws-logo-container"> 
    <!-- Logo Wrapper, images put within this wrapper will always be vertically centered --> 
    <div id="mws-logo-wrap"> 
     <img src="/static/Admin/images/mws-logo.png" alt="mws admin" /> 
    </div> 
   </div> 
   <!-- User Tools (notifications, logout, profile, change password) --> 
   <div id="mws-user-tools" class="clearfix"> 
    <!-- Notifications --> 
    <div id="mws-user-notif" class="mws-dropdown-menu"> 
     <a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><i class="icon-exclamation-sign"></i></a> 
     <!-- Unread notification count --> 
     <span class="mws-dropdown-notif">35</span> 
     <!-- Notifications dropdown --> 
     <div class="mws-dropdown-box"> 
      <div class="mws-dropdown-content"> 
       <ul class="mws-notifications"> 
        <li class="read"> <a href="#"> <span class="message"> Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore </span> <span class="time"> January 21, 2012 </span> </a> </li> 
        <li class="read"> <a href="#"> <span class="message"> Lorem ipsum dolor sit amet </span> <span class="time"> January 21, 2012 </span> </a> </li> 
        <li class="unread"> <a href="#"> <span class="message"> Lorem ipsum dolor sit amet </span> <span class="time"> January 21, 2012 </span> </a> </li> 
        <li class="unread"> <a href="#"> <span class="message"> Lorem ipsum dolor sit amet </span> <span class="time"> January 21, 2012 </span> </a> </li> 
       </ul> 
       <div class="mws-dropdown-viewall"> 
        <a href="#">View All Notifications</a> 
       </div> 
      </div> 
     </div> 
    </div> 
    <!-- Messages --> 
    <div id="mws-user-message" class="mws-dropdown-menu"> 
     <a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><i class="icon-envelope"></i></a> 
     <!-- Unred messages count --> 
     <span class="mws-dropdown-notif">35</span> 
     <!-- Messages dropdown --> 
     <div class="mws-dropdown-box"> 
      <div class="mws-dropdown-content"> 
       <ul class="mws-messages"> 
        <li class="read"> <a href="#"> <span class="sender">John Doe</span> <span class="message"> Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore </span> <span class="time"> January 21, 2012 </span> </a> </li> 
        <li class="read"> <a href="#"> <span class="sender">John Doe</span> <span class="message"> Lorem ipsum dolor sit amet </span> <span class="time"> January 21, 2012 </span> </a> </li> 
        <li class="unread"> <a href="#"> <span class="sender">John Doe</span> <span class="message"> Lorem ipsum dolor sit amet </span> <span class="time"> January 21, 2012 </span> </a> </li> 
        <li class="unread"> <a href="#"> <span class="sender">John Doe</span> <span class="message"> Lorem ipsum dolor sit amet </span> <span class="time"> January 21, 2012 </span> </a> </li> 
       </ul> 
       <div class="mws-dropdown-viewall"> 
        <a href="#">View All Messages</a> 
       </div> 
      </div> 
     </div> 
    </div> 
    <!-- User Information and functions section --> 
    <div id="mws-user-info" class="mws-inset"> 
     <!-- User Photo --> 
     <div id="mws-user-photo"> 
      <img src="/static/Admin/example/profile.jpg" alt="User Photo" /> 
     </div> 
     <!-- Username and Functions --> 
     <div id="mws-user-functions"> 
      <div id="mws-username">
        Hello, {{session('adminname')}} 
      </div> 
      <ul> 
       <li><a href="#">Profile</a></li> 
       <li><a href="/adminuppwd">Change Password</a></li> 
       <li><a href="adminlogin">Logout</a></li> 
      </ul> 
     </div> 
    </div> 
   </div> 
  </div> 
  <!-- Start Main Wrapper --> 
  <div id="mws-wrapper"> 
   <!-- Necessary markup, do not remove --> 
   <div id="mws-sidebar-stitch"></div> 
   <div id="mws-sidebar-bg"></div> 
   <!-- Sidebar Wrapper --> 
   <div id="mws-sidebar"> 
    <!-- Hidden Nav Collapse Button --> 
    <div id="mws-nav-collapse"> 
     <span></span> 
     <span></span> 
     <span></span> 
    </div> 
    <!-- Searchbox --> 
    <div id="mws-searchbox" class="mws-inset"> 
     <form action="typography.html"> 
      <input type="text" class="mws-search-input" placeholder="Search..." /> 
      <button type="submit" class="mws-search-submit"><i class="icon-search"></i></button> 
     </form> 
    </div> 
    <!-- Main Navigation --> 
    <div id="mws-navigation"> 
     <ul> 
      
      <li> <a href="#"><i class="icon-user"></i> 管理员管理</a> 
       <ul class="closed"> 
        <li><a href="/adminusers/create">管理员添加</a></li> 
        <li><a href="/adminusers">管理员列表</a></li> 
        <li><a href="/adminroles/create">角色添加</a></li> 
        <li><a href="/adminroles">角色列表</a></li> 
        <li><a href="/adminauths/create">权限添加</a></li> 
        <li><a href="/adminauths">权限列表</a></li> 
       </ul> </li> 
      <li> <a href="#"><i class="icon-user"></i> 用户管理</a> 
       <ul class="closed"> 
        <li><a href="adminuser/create">用户添加</a></li> 
        <li><a href="adminuser">用户列表</a></li> 
       </ul> </li> 
      <li> <a href="#"><i class="icon-th-list"></i> 分类管理</a> 
       <ul class="closed"> 
        <li><a href="/admincates/create">分类添加</a></li> 
        <li><a href="/admincates">分类列表</a></li> 
       </ul> </li>  
      <li> <a href="#"><i class="icon-file"></i> 商品管理</a> 
       <ul class="closed"> 
        <li><a href="/admingoods/create">商品添加</a></li> 
        <li><a href="/admingoods">商品列表</a></li> 
       </ul> </li> 
       <li> <a href="#"><i class="icon-file"></i> 订单管理</a> 
       <ul class="closed">  
        <li><a href="/adminorderlist">订单列表</a></li> 
       </ul> </li> 
       <li> <a href="#"><i class="icon-file"></i> 门店管理</a> 
       <ul class="closed"> 
        <li><a href="/shops/create">门店添加</a></li> 
        <li><a href="/shops">门店列表</a></li> 
       </ul> </li>
       <li> <a href="#"><i class="icon-file"></i> 快递管理</a> 
       <ul class="closed"> 
        <li><a href="/send/create">快递添加</a></li> 
        <li><a href="/send">快递列表</a></li> 
       </ul> </li>
       <li> <a href="#"><i class="icon-file"></i> 支付方式管理</a> 
       <ul class="closed"> 
        <li><a href="/paytype/create">支付方式添加</a></li> 
        <li><a href="/paytype">支付方式列表</a></li> 
       </ul> </li>
       <li> <a href="#"><i class="icon-file"></i> 轮播图管理</a> 
       <ul class="closed"> 
        <li><a href="/lbt/create">轮播图添加</a></li> 
        <li><a href="/lbt">轮播图列表</a></li> 
       </ul> </li> 
       <li> <a href="#"><i class="icon-file"></i> 评价管理</a> 
       <ul class="closed"> 
        <li><a href="/pj">评价列表</a></li> 
       </ul> </li>  
       <li> <a href="#"><i class="icon-file"></i> 公告管理</a> 
       <ul class="closed"> 
        <li><a href="/adminarticel/create">公告添加</a></li> 
        <li><a href="/adminarticel">公告列表</a></li> 
       </ul> </li>  
       <li> <a href="#"><i class="icon-file"></i> 友情链接</a> 
       <ul class="closed"> 
        <li><a href="/adminlink/create">链接添加</a></li> 
        <li><a href="/adminlink">链接列表</a></li> 
       </ul> </li> 
     </ul> 
    </div> 
   </div> 
   <!-- Main Container Start --> 
   <div id="mws-container" class="clearfix"> 
    <div class="container">
      <!-- 成功失败提示信息开始 -->
      @if(session('success'))
        <div class="mws-form-message success">
         This is a success message
         <ol>
          <li>{{session("success")}}</li>
         </ol>
        </div>
      @endif
      @if(session('warning'))
        <div class="mws-form-message warning">
         This is a warning message
         <ol>
          <li>{{session("warning")}}</li>
         </ol>
        </div>
      @endif
      @if(session('error'))
        <div class="mws-form-message error">
         This is a error message
         <ol>
          <li>{{session("error")}}</li>
         </ol>
        </div>
      @endif
      <!-- 成功失败提示信息结束 -->
      @section("admin")
      @show
    </div>
    
    <!-- footer --> 
    <div id="mws-footer">
      Copyright Your Website 2012. All Rights Reserved. 
    </div> 
   </div> 
   <!-- Main Container End --> 
  </div> 
  <!-- JavaScript Plugins --> 
  <script src="/static/Admin/js/libs/jquery-1.8.3.min.js"></script> 
  <script src="/static/Admin/js/libs/jquery.mousewheel.min.js"></script> 
  <script src="/static/Admin/js/libs/jquery.placeholder.min.js"></script> 
  <script src="/static/Admin/custom-plugins/fileinput.js"></script> 
  <!-- jQuery-UI Dependent Scripts --> 
  <script src="/static/Admin/jui/js/jquery-ui-1.9.2.min.js"></script> 
  <script src="/static/Admin/jui/jquery-ui.custom.min.js"></script> 
  <script src="/static/Admin/jui/js/jquery.ui.touch-punch.js"></script> 
  <!-- Plugin Scripts --> 
  <script src="/static/Admin/plugins/datatables/jquery.dataTables.min.js"></script> 
  <!--[if lt IE 9]>
    <script src="js/libs/excanvas.min.js"></script>
    <![endif]--> 
  <script src="/static/Admin/plugins/flot/jquery.flot.min.js"></script> 
  <script src="/static/Admin/plugins/flot/plugins/jquery.flot.tooltip.min.js"></script> 
  <script src="/static/Admin/plugins/flot/plugins/jquery.flot.pie.min.js"></script> 
  <script src="/static/Admin/plugins/flot/plugins/jquery.flot.stack.min.js"></script> 
  <script src="/static/Admin/plugins/flot/plugins/jquery.flot.resize.min.js"></script> 
  <script src="/static/Admin/plugins/colorpicker/colorpicker-min.js"></script> 
  <script src="/static/Admin/plugins/validate/jquery.validate-min.js"></script> 
  <script src="/static/Admin/custom-plugins/wizard/wizard.min.js"></script> 
  <!-- Core Script --> 
  <script src="/static/Admin/bootstrap/js/bootstrap.min.js"></script> 
  <script src="/static/Admin/js/core/mws.js"></script> 
  <!-- Themer Script (Remove if not needed) --> 
  <script src="/static/Admin/js/core/themer.js"></script> 
  <!-- Demo Scripts (remove if not needed) --> 
  <script src="/static/Admin/js/demo/demo.dashboard.js"></script>  
 </body>
</html>