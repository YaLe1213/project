<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 导入ImageManager;
use Intervention\Image\ImageManager;
use Config;
use App\Services\OSS;//导入OSS类
// 导入商品模型
use App\Models\Goods;
// 导入 DB 模型
use DB;
// 导入门店模型
use App\Models\Shops;
use Markdown;//导入Markdown

class AdminGoodsController extends Controller
{
    // 获取分类
    public function getCates(){
        $cates=DB::table('cates')->select(DB::raw("*,concat(path,',',id)as paths"))->orderBy('paths')->get();
         foreach ($cates as $key => $value) {
            // 通过获取逗号的个数,来区分分类级别
            // 将 path 转为数组
            $arr=explode(',',$value->path);
            // 获取点的个数
            $len=count($arr)-1;
            // 重复字符串--添加前缀
            $cates[$key]->name=str_repeat('--|',$len).$value->name;
        }
        return $cates;
    }
    // 获取门店名称
    public function getShops(){
        $shops=DB::table('shops')->select(["id","name"])->get();
        return $shops;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 调用获取分类名
        $cates=self::getCates();
        // 调用获取门店名
        $shops=self::getShops();
        // 获取未审核的商品
        $data1=Goods::where('status','=','1')->get();
        // 获取已审核的商品
        $data2=Goods::where('status','=','2')->get();
        // 获取违规的商品
        $data3=Goods::where('status','=','0')->get();
        // dd($cates);
        return view("Admin.Goods.index",['data1'=>$data1,'data2'=>$data2,'data3'=>$data3,'cates'=>$cates,'shops'=>$shops]);
    }
    // 商品详情
    public function goodsinfo($id){
        $data1=Goods::where('id','=',$id)->first();
        return view("Admin.Goods.info",['data1'=>$data1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 调用获取分类
        $cates=self::getCates();
        // 调用门店信息
        $shops=self::getShops();
        // dd($shops);
        return view("Admin.Goods.add",['cates'=>$cates,'shops'=>$shops]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 判断 分类 和 店名
        if($request->input('cate_id')==0){
            return back()->with('warning','请选择分类');
        }
        if($request->input('shopid')==0){
            return back()->with('warning','请选择门店');
        }
        $data=$request->except(["_token","img"]);
        // 检测商品图片
        if($request->hasFile("img")){
            // 名字
            $name=date("YmdHis",time());
            // 后缀
            $ext=$request->file("img")->getClientOriginalExtension();
        }else{
            return back()->with('warning','请选择显示图片!');
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
        $manager->make(env("ALIURL").$newfile)->resize(150, 150)->save(Config::get("app.app_shops")."/"."r_".$name.".".$ext);
        $data['img']=trim(Config::get("app.app_shops")."/"."r_".$name.".".$ext,'.');



        // 处理数据
        
        // 商品编码
        $data['Sn']=rand(100000000,999999999);
        $data['isSale']=0;
        $data['isBest']=0;
        $data['isHot']=0;
        $data['isNew']=0;
        // $data['Stock']=$request->input('Stock');
        $data['isRecom']=0;
        $data['status']=1;
        $data['saleNum']=0;
        $data['isdel']=0;
        $data['desc']=Markdown::convertToHtml($request->input('desc'));

        if(Goods::create($data)){
            return redirect("/admingoods")->with('success','添加商品成功');
        }else{
            return back()->with('error','添加商品失败');
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
        // echo 1;
    }
    public function dell(Request $request){
        $id=$request->input('id');
        if(Goods::where('id','=',$id)->delete()){
            echo 1;
        }else{
            echo 2;
        }
    }
    // 审核
    public function exa(Request $request){
        $id=$request->input('id');
        $bool=$request->input("bool");
        if ($bool=='true') {
            $data['status']=2;
        }else{
            $data['status']=0;
        }
           
        if(Goods::where('id','=',$id)->update($data)){
            echo 1;
        }else{
            echo 2;
        }
    }
    // sale 状态
    public function salestatus(){
        $id=$_GET['id'];
        $sta=$_GET['sta'];
        echo $id;
        if (Goods::where('id','=',$id)->update(["isSale"=>$sta])) {
            echo 1;
        }else{
            echo 2;
        }
    }
    // best 状态
    public function beststatus(){
        $id=$_GET['id'];
        $sta=$_GET['sta'];
        if (Goods::where('id','=',$id)->update(["isBest"=>$sta])) {
            echo 1;
        }else{
            echo 2;
        }
    }
    // hot 状态
    public function hotstatus(){
        $id=$_GET['id'];
        $sta=$_GET['sta'];
        if (Goods::where('id','=',$id)->update(["isHot"=>$sta])) {
            echo 1;
        }else{
            echo 2;
        }
    }
    // new 状态
    public function newstatus(){
        $id=$_GET['id'];
        $sta=$_GET['sta'];
        if (Goods::where('id','=',$id)->update(["isNew"=>$sta])) {
            echo 1;
        }else{
            echo 2;
        }
    }
    // recom 状态
    public function recomstatus(){
        $id=$_GET['id'];
        $sta=$_GET['sta'];
        if (Goods::where('id','=',$id)->update(["isRecom"=>$sta])) {
            echo 1;
        }else{
            echo 2;
        }
    }
    // del 状态
    public function delstatus(){
        $id=$_GET['id'];
        $sta=$_GET['sta'];
        if (Goods::where('id','=',$id)->update(["isdel"=>$sta])) {
            echo 1;
        }else{
            echo 2;
        }
    }
}
