<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PayController extends Controller
{
    // 调用支付宝支付接口
    public function payss($id){
        // 订单号 描述 金额 描述 

        // 获取该订单数据
        $data=DB::table("order")->where('id','=',$id)->first();
        // 订单号
        $out_trade_no=$data->orderNo;
        $subject="本次购物的订单号";
        // 金额
        // $total_fee=$data->tot;
        $total_fee=0.01;
        // 描述
        $body="本次购物总金额";
        // dd($data);
        pays($out_trade_no,$subject,$total_fee,$body);
    }  
    // 支付成功
    public function paysuccess(Request $request){
        // 修改订单状态
        $order_id=session("order_id");
        $address_id=session("address_id");
        $tot=session("tot");
        $data['status']=0;//代发货
        DB::table("order_info")->where("order_id","=",$order_id)->update($data);
        return redirect("/orderlist");
        // 清除session 购物车 和 结算的数据
        $request->session()->pull("cart");
        $request->session()->pull("goods");
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     
}
