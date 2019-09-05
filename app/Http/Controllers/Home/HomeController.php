<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Goods;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
        // 获取推荐商品数据
        $tj=DB::table("goods")->where("isRecom","=",1)->limit(5)->get();
        // 获取促销商品数据
        $cx=DB::table("goods")->where("isHot","=",1)->limit(5)->get();
        // 获取公告数据
        $articel=DB::table('articel')->orderBy('id','desc')->limit(5)->get();
        // 获取lbt
        $lbt=DB::table("lbt")->where("status","=",1)->limit(5)->get();
        // dd($cates);
        //加载首页视图
        return view("Home.Home.home",['articel'=>$articel,'lbt'=>$lbt,'tj'=>$tj,'cx'=>$cx]);
    }
    public function seconds(){
        return view("Home.Home.index");
    }
    // 促销中心
    public function product($id){
       
        // 获取全部商品
        $data=DB::table("goods")->where("cate_id","=",$id)->get();
        return view("Home.Home.product",["data"=>$data]);
    }
        // 促销中心
    public function product1(){
        $data=DB::table("goods")->get();
        return view("Home.Home.product",["data"=>$data]);
    }
    // 首页搜索
    public function homesearch(){

        $k=$_GET['keywords'];
        $a=DB::table("goods_word")->where("word","=",$k)->get();
        // $arr='';
        foreach($a as $k=>$v){
            $arr[$k]=$v->goods_id;
        }
        // dd($a);
        $id=implode(",",$arr);
        $data=DB::table("goods")->where("id","=",$id)->get();

        return view("Home.Home.homesearch",['data'=>$data]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   //商品详情
        $goods=Goods::where('id','=',$id)->first();
            // 获取该商品的评论
        $ping=DB::table("ping")->where("order_infoid","=",$id)->get();
        // dd($ping);
        // dd($goods);
        return view("Home.Home.proinfo",['goods'=>$goods,"ping"=>$ping]);
    }
    public function info($id)
    {
        //商品详情
        $goods=Goods::where('id','=',$id)->first();
            // 获取该商品的评论
        $ping=DB::table("ping")->where("order_infoid","=",$id)->get();
        // dd($ping);
        // dd($goods);
        return view("Home.Home.proinfo",['goods'=>$goods,"ping"=>$ping]);
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
        //
    }
    public function gginfo($id)
    {
        // 获取该公告的详情
        $data=DB::table("articel")->where("id","=",$id)->first();
        return view("Home.Home.gginfo",["data"=>$data]);
    }
    // 更多链接
    public function morelink(){
        $data=DB::table("friendlink")->where("status","=",1)->get();
        return view("Home.Home.morelink",['data'=>$data]);
    }
}
