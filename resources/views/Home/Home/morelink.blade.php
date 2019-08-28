@extends("Home.Home.index")
@section("home")
<center>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
                                                                                   
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>表格</title>
</head>
<body>

 <table width="795" border="1" style=" border-collapse:collapse;font-size:14px;border:#FFF 1px solid;">
  @foreach($data as $row)
  <tr style="height:34px; background:#00FF01;">
   <td width="143"></td>
   <td width="143"></td>
   <td width="143"><a href="{{$row->url}}">{{$row->name}}</a></td>
   <td width="143"></td>
   <td width="143"></td>
  </tr>
  @endforeach
 </table>
</body>
</html>
</center>
@endsection
@section("title","更多友情链接")