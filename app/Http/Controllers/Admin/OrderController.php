<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderInfo;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 获取关键词
        $k=$request->input("keywords");
        $data=Order::where("orderNo","like","%".$k."%")->get();

        // 用户名
        $data1=DB::table("users")->select(["id","name"])->get();
        foreach ($data1 as $k => $v) {
            $name[$v->id]=$v->name;
        }
        // 获取支付方式
        $data2=DB::table("paytype")->select(["id","name"])->get();
        foreach ($data2 as $k => $v) {
            $pay[$v->id]=$v->name;
        }
        // 获取发货方式
        $data3=DB::table("sendgoods")->select(["id","name"])->get();
        foreach ($data3 as $k => $v) {
            $send[$v->id]=$v->name;
        }
        // 收货地址
        
        // dd($data);
        foreach($data as $k=>$v){
            $data4=DB::table("address")->where("id",'=',$v->address_id)->first();
        }
        return view("Admin.Order.index",['data'=>$data,'data1'=>$data1,'data2'=>$data2,'data3'=>$data3,'data4'=>$data4]);
    }
    // 订单详情
    public function orderinfo($id){
        $data=DB::table("order_info")->where('order_id','=',$id)->get();
        return view("Admin.Order.orderinfo",["data"=>$data]);
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
        //
    }
    // 订单    删除
    public function orderdel(){
        $id=$_GET['id'];
        // 删除 子 数据
        if(OrderInfo::where('order_id','=',$id)->delete()){
            // 删除该条数据
            if(Order::where('id','=',$id)->delete()){
                echo 1;//删除成功
            }else{
                echo 2;//删除该条数据失败
            }
        }else{
            echo 3;//删除 子 数据失败
        }
        

    }
    // 订单详情   状态
    public function orderstatus(){
        $sta=$_GET['sta'];
        $id=$_GET['id'];
        // 改变状态
        if(OrderInfo::where('id','=',$id)->update(['status'=>$sta])){
            echo 1;
        }else{
            echo 2;
        }
    }
    // 订单详情  删除
    public function orderindel(){
        $id=$_GET['id'];
        if (OrderInfo::where('id','=',$id)->delete()) {
           echo 1;
        }else{
            echo 2;
        }
    }
}
