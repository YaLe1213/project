<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shops;
use App\Models\Goods;
use DB;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取店长名
        $users=DB::table("users")->select(["id","name"])->get();
        $data=Shops::get();
        return view("Admin.Shops.index",['data'=>$data,'users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 获取用户信息
        $users=DB::table("users")->select(['id','name'])->get();
        // dd($users);
        //门店添加
        return view("Admin.Shops.add",['users'=>$users]);
    }
    // 门店名检测
    public function shopsname(){
        $name=$_GET['name'];
        // 判断名字是否已存在
        if(DB::table("shops")->where("name","=",$name)->first()){
            echo 1;
        }else{
            echo 2;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 检测不为空信息
        if(empty($request->input("name")) || empty($request->input("email")) || empty($request->input("userid"))){
            return back()->with("warning","信息为空 或 没选择店长");
        }else{
            // 检测门店是否已被注册
            if(DB::table("shops")->where('name','=',$request->input("name"))->first()){
                return back()->with("warning","该门店已经被注册!请重新输入");
            }else{
                // 入库
                $data=$request->except("_token");
                $data['status']=0;
                if(Shops::create($data)){
                    return redirect("/shops")->with('success','添加门店成功!');
                }else{
                    return back()->with('error','添加失败,请检查信息');
                }
            }
           
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
        // 获取该门店商品
        $data=Goods::where('shopid','=',$id)->get();
        return view("Admin.Shops.info",['data'=>$data]);
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
    // 门店状态修改
    public function shopstatus(){
        $id=$_GET['id'];
        $sta=$_GET['sta'];
        if (Shops::where('id','=',$id)->update(["status"=>$sta])) {
            echo 1;
        }else{
            echo 2;
        }
    }
    // 门店删除
    public function shopsdel($id)
    {
        if(DB::table("shops")->where("id","=",$id)->delete()){
            return redirect("/shops")->with("success","删除成功");
        }else{
            return back()->with("error","删除失败");
        }
    }
}
