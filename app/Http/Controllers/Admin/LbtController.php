<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 导入ImageManager;
use Intervention\Image\ImageManager;
use Config;
use App\Services\OSS;//导入OSS类
use DB;

class LbtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 接收关键字
        $k=$request->input("keywords");
        //获取全部数据
        $data=DB::table("lbt")->where('name','like',"%".$k."%")->get();
        return view("Admin.Lbt.index",['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("Admin.Lbt.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
       
        // 图片上传到阿里
        // 检测是否有文件上传
        if($request->hasFile("img")){
            // 名字
            $name=date("YmdHis",time());
            // 后缀
            $ext=$request->file("img")->getClientOriginalExtension();
             
        }

        // 上传文件到阿里云存储
         // 上传后的文件名
        $newfile=$name.'.'.$ext;
        // 获取上传文件的临时目录
        $file=$request->file("img");
        $filepath=$file->getRealPath();
        OSS::upload($newfile, $filepath); 

        // 实例化ImageManager
        $manager = new ImageManager();
        // 裁剪图片
        $manager->make(env("ALIURL").$newfile)->resize(200, 150)->save(Config::get("app.app_lbt")."/"."r_".$name.".".$ext);
        
        // 存图片路径   去点
        $data['img']=trim(Config::get("app.app_lbt")."/"."r_".$name.".".$ext,'.');
        $data['name']=$request->input('name');
        if(DB::table('lbt')->insert($data)){
            return redirect("/lbt")->with('success','添加轮播图成功');
        }else{
            return back()->with("error","添加轮播图失败");
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
        // 获取要修改的数据
        $data=DB::table("lbt")->where('id','=',$id)->first();
        return view("Admin.Lbt.edit",['data'=>$data]);
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
        // 图片上传到阿里
        // 检测是否有文件上传
        if($request->hasFile("img")){
            // 名字
            $name=date("YmdHis",time());
            // 后缀
            $ext=$request->file("img")->getClientOriginalExtension();
             // 上传文件到阿里云存储
             // 上传后的文件名
            $newfile=$name.'.'.$ext;
            // 获取上传文件的临时目录
            $file=$request->file("img");
            $filepath=$file->getRealPath();
            OSS::upload($newfile, $filepath); 

            // 实例化ImageManager
            $manager = new ImageManager();
            // 裁剪图片
            $manager->make(env("ALIURL").$newfile)->resize(200, 150)->save(Config::get("app.app_lbt")."/"."r_".$name.".".$ext);
            
            // 存图片路径   去点
            $data['img']=trim(Config::get("app.app_lbt")."/"."r_".$name.".".$ext,'.');
             
        }

       
        $data['name']=$request->input('name');
        if(DB::table('lbt')->where("id",'=',$id)->update($data)){
            return redirect("/lbt")->with('success','修改轮播图成功');
        }else{
            return back()->with("error","修改轮播图失败");
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
    // 轮播图删除
    public function lbtdel(){
        $id=$_GET['id'];
        if(DB::table("lbt")->where('id','=',$id)->delete()){
            echo 1;
        }else{
            echo 2;
        }
    }
    // 轮播图  修改状态
    public function lbtstatus(){
        $id=$_GET['id'];
        $sta=$_GET['sta'];
        if (DB::table('lbt')->where('id','=',$id)->update(["status"=>$sta])) {
            echo 1;
        }else{
            echo 2;
        }
    }
}
