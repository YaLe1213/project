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
         //实例化Redis
        // $redis=new Redis();
        //连接redis
        // $redis->connect("localhost",123456);
        // 选择库
        // $redis->select(2);
        // //存储数据
        // $redis->set('name','admin');
        // //获取数据
        // echo $redis->get('name');
        
        $arts=[];
        $hasharticel="hasharticel";//存储数据的哈希表名
        $listkey="listkey";//存储数据id
        // 判断redis里有没有缓存数据
        if(Redis::exists($listkey)){
            //获取所有缓存服务器下的公告id
            $lists=Redis::lrange($listkey,0,-1);// listkey 0 -1
            foreach ($lists as $k => $v) {
                $arts[]=Redis::hgetall($hasharticel.$v);
            }
        }else{
            // 获取数据库的数据 给redis 一份
            $arts=AdminArticel::get()->toArray();
            // 给redis一份
            foreach ($arts as $k => $v) {
                // 将公告的id 存储在$listkey 链表里
                Redis::lpush($listkey,$v['id']);
                // 将其他的字段的数据插入到哈希表里
                Redius::hmset($hasharticel.$v['id'],$v);// articel:id 键1 值1 键2 值2
            }
        }

        //列表
        // 获取关键词
        // $k=$request->input('keywords');

        // 获取当前页数据
        // $data=AdminArticel::where("title",'like',"%".$k."%")->get();
          // dd($data);
          // 分页
     
        return view("Admin.Articel.index",["data"=>$arts]);
         
        
    }
    // 搜索
    public function search(){
        //列表
        // 获取关键词
        $k=$request->input('search');
        //获取总跳数
        $tot=AdminArticel::where("title",'like',"%".$k."%")->count();
        // 获取每页显示数据条数
        $rev=2;
        // 获取最大页数
        $maxpage=ceil($tot/$rev);
        // 遍历页数
        for ($i=1; $i <= $maxpage; $i++) { 
            $pp[$i]=$i;
        }
        // 获取当前页数
        $page=$request->input("page");

        // 判断有没有页数
        if(empty($page)){
            $page=1;
        }
        // 获取偏移量
        $offset=($page-1)*$rev;

        // 获取当前页数据
        $data=AdminArticel::where("title",'like',"%".$k."%")->offset($offset)->limit($rev)->get();
          // dd($data);
        // 判断是否是ajax请求 是返回true 否则返回false
        if($request->ajax()){
            // 加载独立的ajax模板
            return view("Admin.Articel.search",["pp"=>$pp,"data"=>$data]);
        }
        return view("Admin.Articel.index",["pp"=>$pp,"data"=>$data]);
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

   


        // dd($data);
        // 入库
        if(AdminArticel::create($data)){
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        if(AdminArticel::where('id','=',$id)->delete()){
            return back()->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
    // 删除
    public function del(Request $request){
        $arr=$request->input("arr");
        // echo $arr;
        foreach ($arr as $k => $v) {
            echo $v;
            // AdminArticle::where("id","=",$v)->delete();
        }
       
    }
}
