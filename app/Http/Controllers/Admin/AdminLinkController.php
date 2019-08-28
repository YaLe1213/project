<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 导入Link 和 LinkInfo 模型类
use App\Models\Link;
use App\Models\LinkInfo;
// 导入ImageManager;
use Intervention\Image\ImageManager;
use Config;
use App\Services\OSS;//导入OSS类

class AdminLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取友情链接所有数据
        $data=Link::get();
        return view("Admin.Link.index",['data'=>$data]);
    }
    // 链接详情
    public function linkinfo($id){
        $data=Link::find($id)->info;
        return view("Admin.Link.info",['data'=>$data]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Admin.Link.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(empty($request->input('name')) || empty($request->input('desc')) || empty($request->input('email')) || empty($request->input('url'))){
            return back()->with("warning","信息不可为空");
        }
        // 检测是否有文件上传
        if($request->hasFile("icon")){
            // 名字
            $name="icon-".date("YmdHis",time());
            // 后缀
            $ext=$request->file("icon")->getClientOriginalExtension();
             
        }else{
            return back()->with("warning","请选择图标!");
        }

        // 上传文件到阿里云存储
         // 上传后的文件名
        $newfile=$name.'.'.$ext;
        // 获取上传文件的临时目录
        $file=$request->file("icon");
        $filepath=$file->getRealPath();
        // 上传文件到阿里云存储
        OSS::upload($newfile, $filepath); 

        // 实例化ImageManager
        $manager = new ImageManager();
        // 裁剪图片
        $manager->make(env("ALIURL").$newfile)->resize(50, 50)->save(Config::get("app.app_icon")."/".$name.".".$ext);
        // 获取数据  表1
        $data1=$request->except(["_token","email","icon","desc"]);
        $data1['status']=0;//0未上架
      
        $data3=Link::create($data1);
        $id1=$data3->id;
        // 获取数据  表2
        $data2['icon']=trim(Config::get("app.app_icon")."/".$name.".".$ext,'.');
        $data2['desc']=$request->input("desc");
        $data2['email']=$request->input("email");
        $data2['l_id']=$id1;
        $data4=LinkInfo::create($data2);
        $id2=$data4->l_id;
        if($id1 && $id2){

            return redirect("adminlink")->with("success","添加友情链接成功,若要上架请联系客服");
        }else{
            return back()->with('error','添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 获取数据
        $data1=Link::where('id','=',$id)->first();
        $data2=Link::find($id)->info;
        return view("Admin.Link.edit",['data1'=>$data1,'data2'=>$data2]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 判断不为空
        if(empty($request->input('name')) || empty($request->input('desc')) || empty($request->input('email')) || empty($request->input('url'))){
            return back()->with("warning","信息不可为空");
        }
        // 检测是否有文件上传
        if($request->hasFile("icon")){
            // 名字
            $name="icon-".date("YmdHis",time());
            // 后缀
            $ext=$request->file("icon")->getClientOriginalExtension();

            // 上传文件到阿里云存储
             // 上传后的文件名
            $newfile=$name.'.'.$ext;
            // 获取上传文件的临时目录
            $file=$request->file("icon");
            $filepath=$file->getRealPath();
            // 上传文件到阿里云存储
            OSS::upload($newfile, $filepath); 

            // 实例化ImageManager
            $manager = new ImageManager();
            // 裁剪图片
            $manager->make(env("ALIURL").$newfile)->resize(50, 50)->save(Config::get("app.app_icon")."/".$name.".".$ext);
            $data2['icon']=trim(Config::get("app.app_icon")."/".$name.".".$ext,'.');
        }
        // 获取数据  表1
        $data1=$request->except(["_token","email","icon","desc","_method"]);
        $data3=Link::where('id','=',$id)->update($data1);
        // $id1=$data3->id;
        // 获取数据  表2
        
        $data2['desc']=$request->input("desc");
        $data2['email']=$request->input("email");
        
        $data4=LinkInfo::where('l_id','=',$id)->update($data2);
        // $id2=$data4->l_id;
        if($data3 || $data4){

            return redirect("adminlink")->with("success","修改成功");
        }else{
            return back()->with('error','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // 友情链接   删除
    public function linkdel(){
        $id=$_GET['id'];
        if(Link::where('id','=',$id)->delete()){
            echo 1;
        }else{
            echo 2;
        }
    }
    // 修改状态
    public function linkstatus(){
        $id=$_GET['id'];
        $sta=$_GET['sta'];
        if (Link::where('id','=',$id)->update(["status"=>$sta])) {
            echo 1;
        }else{
            echo 2;
        }
    }
}
