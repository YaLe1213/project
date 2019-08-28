<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PayTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=DB::table("paytype")->get();
        return view("Admin.PayType.index",["data"=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Admin.PayType.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 检测不为空
        if(empty($request->input("name"))){
            return back()->with("warning","信息不可以为空");
        }
        // 检测是否已存在
        if(DB::table("paytype")->where("name","=",$request->input("name"))->first()){
            return back()->with("warning","该支付名已存在,请重新填写!");
        }
        $data['name']=$request->input("name");
        $data['img']='';
        $data['desc']='';
        $data['paycode']='';
        $data['config']='';
        $data['enabled']=0;
        if(DB::table("paytype")->insert($data)){
            return redirect("/paytype")->with("success","添加支付方式成功");
        }else{
            return back()->with("error","添加支付方式失败");
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
         //删除
        if(DB::table("paytype")->where("id","=",$id)->delete()){
            return redirect("/paytype")->with("success","删除成功!");
        }else{
            return back()->with("error","删除失败!");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=DB::table("paytype")->where("id","=",$id)->first();
        return view("Admin.PayType.edit",['data'=>$data]);
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
        if(empty($request->input("name"))){
            return back()->with("warning","信息不可以为空");
        }

        $data['name']=$request->input("name");
        if(DB::table("paytype")->where("id","=",$id)->update($data)){
            return redirect("/paytype")->with("success","修改成功");
        }else{
            return back()->with("error","修改失败");
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
    public function paytatus(){
        $id=$_GET['id'];
        $sta=$_GET['sta'];
        if (DB::table("paytype")->where('id','=',$id)->update(["enabled"=>$sta])) {
            echo 1;
        }else{
            echo 2;
        }
    }
}
