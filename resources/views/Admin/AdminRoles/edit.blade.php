@extends("Admin.Adminpublic.adminpublic")
@section("admin")
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>分配权限</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/adminroles/{{$id}}" method="post"> 
     <div class="mws-panel-body no-padding">
        <table class="mws-table">
            <thead>
                <tr>
                  <th class="checkbox-column">
                        <input type="checkbox">
                    </th>
                    <th>分类权限</th>
                </tr>
            </thead>
            <tbody>
              @foreach($node as $row)
                <tr>
                  <td class="checkbox-column">
                    @if(in_array($row->id,$nodes))
                      <input type="checkbox" value="{{$row->id}}" checked name="nid[]">
                    @else
                      <input type="checkbox" value="{{$row->id}}" name="nid[]">
                    @endif
                    </td>
                    <td>{{$row->name}}</td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
     <div class="mws-button-row"> 
      {{csrf_field()}}
      {{method_field('PUT')}}
      <input type="submit" value="Submit" class="btn btn-danger" /> 
      <input type="reset" value="Reset" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section("title","分配权限")