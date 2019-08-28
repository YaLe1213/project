<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 获取购物车数据
        
        $cart=session('cart');
        // dd($cart);
        $data1=[];
        $tot=0;
        if(count($cart)){
            // 遍历获取商品数据
            foreach ($cart as $key => $value) {
                $info=DB::table("goods")->where('id','=',$value['id'])->first();
                // 处理数据
                $data['num']=$value['num'];
                $data['id']=$value['id'];
                $data['name']=$info->name;
                $data['price']=$info->shopprice;
                $data['img']=$info->img;
                // 总金额
                $tot=$data['num']*$data['price'];
                $data['tot']=$tot;
                $data1[]=$data;
            }
        }
            // dd($data1);
        return view("Home.Home.cart",['data'=>$data1]);
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
    // 购物车去除重复
    public function checkExists($id){
        // 获取购物车数据
        $goods=session('cart');
        // 判断
        if(empty($goods)) return false;

        foreach($goods as $v){
            if($v['id']==$id){
                return true;
            }
        }
    }
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $data=$request->except(["_token"]);
        if(!$this->checkExists($data['id'])){
            $request->session()->push("cart",$data);  
        }
        return redirect("/cart");
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

    }
    // 购物车 减
    public function jian(Request $request){
        // 获取数量 和 id
        $num = $request->input('num');
        $id = $request->input('id');
        $info=DB::table('goods')->where('id','=',$id)->first();
        // 获取购物车数据
        $cart=session('cart');
        // bianli
        foreach ($cart as $k => $v) {
            if($v['id']==$id){
                $cart[$k]['num']-=1;
                if ($cart[$k]['num']<1) {
                   $cart[$k]['num']=1;
                }
            }
            session(['cart'=>$cart]);
            // 总金额\
            $data['num']=$cart[$k]['num'];
            $data['tot']=$cart[$k]['num']*$info->shopprice;
            // echo $data['tot'];
            echo json_encode($data);
        }
    }
    // 购物车  加
    public function jia(Request $request){
        $num = $request->input('num');
        $id = $request->input('id');

        $info=DB::table('goods')->where('id','=',$id)->first();
        // 获取购物车数据
        $cart=session('cart');
        // bianli
        foreach ($cart as $k => $v) {
            if($v['id']==$id){
                $cart[$k]['num']+=1;
            }
            session(['cart'=>$cart]);
            // 总金额\
            $data['num']=$cart[$k]['num'];
            $data['tot']=$cart[$k]['num']*$info->shopprice;
            // echo $data['tot'];
            echo json_encode($data);
        }
    }
    public function tot(Request $request){
        
        if(isset($_GET['arr'])){
            // 总价格
            $sum=0;
            // 总件数

            foreach ($_GET['arr'] as $key => $value) {
                // $value 是商品id
                
                // 获取购物车数据
                $cart=session('cart');
                foreach ($cart as $k => $v) {
                    // 判断商品id等于购物车id
                    if($value==$v['id']){
                        // 获取 单价 和 数量
                        $num = $cart[$k]['num'];
                        $info = DB::table("goods")->where("id","=",$value)->first();
                        $price=$info->shopprice;
                        // 单个商品的总价
                        $tot=$num*$price;
                        $sum+=$tot;
                    }
                }
            }
            $data['sum']=$sum;
            echo json_encode($data);
        }else{
            // 总计为0
            $data['sum']=0;
            echo json_encode($data);
        }
    }
    // 删除
    public function del(){
        $id=$_GET['id'];
        $cart=session("cart");
        foreach($cart as $k=>$v){
            if ($v['id']==$id) {
                // 删除商品
                unset($cart[$k]);
            }
        }
        session(['cart'=>$cart]);
        echo 1;
    }
    // 全部删除
    public function alldel(Request $request){
        $request->session()->pull("cart");
        return redirect("/cart");
    }   
}
