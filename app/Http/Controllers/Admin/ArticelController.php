<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminArticel;
// 导入ImageManager;
use Intervention\Image\ImageManager;
use Config;
use App\Services\OSS;//导入OSS类
//导入三方类 Redis
use Illuminate\Support\Facades\Redis;

class ArticelController extends Controller
{
    /**
     *
     *-------------公告-------------
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $arts=[];
        $hashkey="Hash:articel";//存储数据的哈希表名
        $listkey="List:articellist";//存储数据id
        // 判断redis里有没有缓存数据
        if(Redis::exists($listkey)){
            //获取所有缓存服务器下的公告id
            $lists=Redis::lrange($listkey,0,-1);// listkey 0 -1
            foreach ($lists as $k => $v) {
                $arts[]=Redis::hgetall($hashkey.$v);
            }
        }else{
            // 获取数据库的数据 给redis 一份
            $arts=AdminArticel::get()->toArray();
        
            // 给redis一份
            foreach ($arts as $k => $v) {
                // 将公告的id 存储在$listkey 链表里
                Redis::lpush($listkey,$v['id']);
                // 将其他的字段的数据插入到哈希表里
                Redius::hmset($hashkey.$v['id'],$v);// articel:id 键1 值1 键2 值2
            }
        }
          // dd($arts);

     
        return view("Admin.Articel.index",["data"=>$arts]);
         
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加公告
        return view("Admin.Articel.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 判断不为空
        // if (empty($request->input('title')) || empty($request->input('desc'))) {
        //    return back()->with("warning","请填写信息");
        // }
        // dd($request->all());
       

        // 普通上传
        // 检测是否有文件上传
        // if($request->hasFile("thumb")){
        //     // 名字
        //     $name=time();
        //     // 后缀
        //     $ext=$request->file("thumb")->getClientOriginalExtension();
        //     // 移动文件
        //     $request->file("thumb")->move(Config::get("app.app_upload"),$name.".".$ext);
        // }
        // // 实例化ImageManager
        // $manager = new ImageManager();
        // // 裁剪图片
        // $manager->make(Config::get("app.app_upload")."/".$name.".".$ext)->resize(100, 100)->save(Config::get("app.app_upload")."/"."r_".$name.".".$ext);
        // $data['title']=$request->input('title');
        // $data['editor']=$request->input("editor");
        // $data['desc']=$request->input("desc");
        // // 存数据   去点
        // $data['thumb']=trim(Config::get("app.app_upload")."/".$name.".".$ext.'.');
        // // dd($data);
        // // 入库
        // if(AdminArticel::create($data)){
        //     return redirect('/adminarticel')->with('success','添加公告成功');
        // }else{
        //     return back()->with('error',"添加公告失败");
        // }

// 图片上传到阿里
        // 检测是否有文件上传
        if($request->hasFile("thumb")){
            // 名字
            $name=date("YmdHis",time());
            // 后缀
            $ext=$request->file("thumb")->getClientOriginalExtension();
             
        }

        // 上传文件到阿里云存储
         // 上传后的文件名
        $newfile=$name.'.'.$ext;
        // 获取上传文件的临时目录
        $file=$request->file("thumb");
        $filepath=$file->getRealPath();
        OSS::upload($newfile, $filepath); 

        // 实例化ImageManager
        $manager = new ImageManager();
        // 裁剪图片
        $manager->make(env("ALIURL").$newfile)->resize(150, 150)->save(Config::get("app.app_upload")."/"."r_".$name.".".$ext);
        $data['title']=$request->input('title');
        $data['editor']=$request->input("editor");
        $data['desc']=$request->input("desc");
        // 存数据   去点
        $data['thumb']=trim(Config::get("app.app_upload")."/"."r_".$name.".".$ext,'.');
        $data1=AdminArticel::create($data);
        $id=$data1->id;


        // dd($data);
        // 入库
        if($id){
             $data['id']=$id;
             //把需要添加的数据插入到redis缓存服务器里
            $hashkey="Hash:articel";//存储数据的哈希表名
            $listkey="List:articellist";//存储数据id
            //id 存储 =》链表
            Redis::rpush($listkey,$id);
           
            Redis::hmset($hashkey.$id,$data);
            return redirect('/adminarticel')->with('success','添加公告成功');
        }else{
            return back()->with('error',"添加公告失败");
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
      $data=AdminArticel::where('id','=',$id)->first();
        return view("Admin.Articel.edit",['data'=>$data]);
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
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
    // 多个删除
    public function del(Request $reqeust){
        // echo "111";
        $arr=$reqeust->input("arr");
        // 遍历
        foreach ($arr as $k => $v) {
          AdminArticel::where('id','=',$v)->delete();
          $hashkey="Hash:articel";//存储数据的哈希表名
          $listkey="List:articellist";//存储数据id
            //删除缓存服务器里的数据
            //删除list 里的id
            Redis::lrem($listkey,1,$v);
            //删除hash数据
            Redis::del($hashkey.$v);
        }
        echo 1;
    }

}

