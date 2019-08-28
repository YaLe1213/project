<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class SendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=DB::table("sendgoods")->get();
        return view("Admin.Send.index",['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Admin.Send.add");
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
        if(DB::table("sendgoods")->where("name","=",$request->input("name"))->first()){
            return back()->with("warning","该快递名已存在,请重新填写!");
        }
        $data['name']=$request->input("name");
        $data['img']='';
        $data['Flag']=1;
        if(DB::table("sendgoods")->insert($data)){
            return redirect("/send")->with("success","添加快递方式成功");
        }else{
            return back()->with("error","添加快递方式失败");
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
        if(DB::table("sendgoods")->where("id","=",$id)->delete()){
            return redirect("/send")->with("success","删除成功!");
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
        //获取原来的数据
        $data=DB::table("sendgoods")->where("id","=",$id)->first();
        return view("Admin.Send.edit",['data'=>$data]);
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
        if(DB::table("sendgoods")->where("id","=",$id)->update($data)){
            return redirect("/send")->with("success","修改成功");
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
    // 修改状态
    public function sendstatus(){
        $id=$_GET['id'];
        $sta=$_GET['sta'];
        if (DB::table("sendgoods")->where('id','=',$id)->update(["Flag"=>$sta])) {
            echo 1;
        }else{
            echo 2;
        }
    }
}
