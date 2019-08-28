<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Order;
use App\Models\Address;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 结算
    public function jiesuan(Request $request){
        $arr=$_GET["arr"];
        $data=[];
        foreach ($arr as $k => $v) {
            // 获取购物车的商品
            $cart=session("cart");
            // 遍历
            foreach ($cart as $k1 => $v1) {
                // 判断id
                if($v==$v1['id']){
                    // 把选中的商品的 数量&&id 放到数组里
                    $data[$k1]['num']=$cart[$k1]['num'];
                    $data[$k1]['id']=$v;
                }
            }
        }
        // 把选中的数据放到session 里
        $request->session()->push('goods',$data);
        echo json_encode($data);
    }
    // 获取购买的商品
    public function getgoods(){
         // 获取商品
        $goods=session("goods");
        
        // dd($goods[count($goods)-1]);
        // 遍历
        foreach ($goods[count($goods)-1] as $k => $v) {
            // 获取商品数据
            $info=DB::table('goods')->where("id","=",$v['id'])->first();
            // 处理数据
            $temp['num']=$v['num'];
            $temp['img']=$info->img;
            $temp['id']=$info->id;
            $temp['name']=$info->name;
            $temp['price']=$info->shopprice;
            $temp['tot']=$v['num']*$info->shopprice;
            $data[]=$temp;

        }
        return $data;
    }
    // insert;
    public function insert(){
        // 购买的商品信息
       $data=$this->getgoods();
       $sum=0;
       foreach($data as $k=>$v){
            $sum+=$v['tot'];
       }
       // 获取该用户所有收货地址
        $address=Address::where("userid","=",session("userid"))->get();
        // 获取支付方式
        $pays=DB::table("paytype")->where("enabled","=",1)->get();

        // dd($address);
        return view("Home.Order.index",['data'=>$data,'sum'=>$sum,"address"=>$address,"pays"=>$pays]);
    }
    // 提交订单
    public function suborder(Request $request){
        $address_id=$request->input("address_id");
        $pay_id=$request->input("pay_id");
        // 购买的商品信息
        $data=$this->getgoods();
       $sum=0;
       foreach($data as $k=>$v){
            $sum+=$v['tot'];
       }
        
// 遍历处理数据  order 表里的数据
        $data1['orderNo']=rand(1,1000000000);
        $data1['user_id']=session("userid");
        $data1['address_id']=$address_id;
        $data1['tot']=$sum;
        $data1['pay_id']=$pay_id;
        $data1['send_id']=1;
      
        $datt=Order::create($data1);
        $id=$datt->id;
        
        if ($id) {
            foreach ($data as $k => $v) {
                // 获取商品数据
                
                // 处理数据
                $temp['order_id']=$id;
                $temp['goods_id']=$v['id'];
                $temp['num']=$v['num'];
                $temp['img']=$v['img'];
                $temp['name']=$v['name'];
                $temp['price']=$v['price'];
                $temp['status']=-2;
                $data2[]=$temp;

            }
           
        }
       $ord=DB::table('order')->where('id','=',$id)->first();
       $payinfo=DB::table("paytype")->where('id','=',$ord->pay_id)->first();
       $type=$payinfo->name;
       $request->session()->pull("goods");
        if(DB::table("order_info")->insert($data2)){
            // 下单成功
            // 订单id  付款金额 收货地址id 储存在session

            session(["order_id"=>$id]);
            session(["address_id"=>$data1['address_id']]);
            session(["tot"=>$data1['tot']]);
            session(["orderNo"=>$data1['orderNo']]);
            return view("Home.Order.dan",['type'=>$type,"id"=>$id]);
        }

        
    }
    public function index()
    {
        $d=[];
        // 获取当前用户的所有的订单
        // 当前用户id
        $id=session("userid");
        $data=DB::table("order")->select(["order_info.id","order_info.price","order_info.img","order_info.status","order.updated_at","address.name as aname","paytype.name as pname"])->join("order_info","order.id","=","order_info.order_id")->join("address","order.address_id","=","address.id")->join("paytype","order.pay_id","=","paytype.id")->where("order.user_id","=",$id)->get();

        // dd($data);
        return view("Home.Order.orderlist",["data"=>$data]);
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
        // 获取该条订单数据
        $data=DB::table("order_info")
                ->select(["order.orderNo","order_info.name","order_info.price","order_info.num","address.name as aname","address.phone","address.info","shops.name as sname","paytype.name as pname","order_info.status"])
                ->join("order","order_info.order_id","=","order.id")
                ->join("address","order.address_id","=","address.id")
                ->join("goods","goods.id","=","order_info.goods_id")
                ->join("shops","goods.shopid","=","shops.id")
                ->join("paytype","paytype.id","=","order.pay_id")
                ->where("order_info.id","=",$id)->first();
        // dd($data);
        return view("Home.Order.listinfo",['data'=>$data]);
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
    // 拒绝收货
    public function orderno(Request $request){
        $id=$_GET['id'];
        $data['status']='-3';
        if (DB::table("order_info")->where("id","=",$id)->update($data)) {
            echo 1;
        }else{
            echo 2;
        }
    }

    // 确认收货
    public function orderyes(Request $request){
        $id=$_GET['id'];
        $request->session()->push("subid",$id);
        $data['status']='3';
        if (DB::table("order_info")->where("id","=",$id)->update($data)) {
            echo 1;
        }else{
            echo 2;
        }
    }
    // 评价
    public function ping($id){
        return view("Home.Order.ping",["id"=>$id]);
    }
    // 接收评价数据
    public function subping(Request $request){
        $data['con']=$request->input("con");
        $data['order_infoid']=$request->input("pid");
        $data['created_at']=time();
        $data['usersid']=session("userid");
        if(DB::table("ping")->insert($data)){
            return redirect("/proinfo/{$data['order_infoid']}");
        }else{
            return back();
        }
    }
    public function pingdel(){
        $id=$_GET['id'];
        if(DB::table("ping")->where("id","=",$id)->delete()){
            echo 1;
        }else{
            echo 2;
        }
    }
    // 删除收货地址
    public function addressdel($id)
    {
        if(DB::table("address")->where("id","=",$id)->delete()){
            return back();
        }else{
            return back();
        }
    }
}
