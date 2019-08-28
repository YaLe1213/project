<?php

namespace App\Http\Controllers\Home;

use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class MyselfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取个人信息
        $id=session("userid");
        $info=DB::table("users")->where("id","=",$id)->first();
        // dd($info);
        //加载个人中心
        return view("Home.Myself.myself",["info"=>$info]);
    }
    // 修改个人信息
    public function myup(Request $request){
        $id=$request->input("id");
        $data['name']=$request->input("name");
        $data['email']=$request->input("email");
        $data['phone']=$request->input("phone");
        if(Users::where("id","=",$id)->update($data)){
            return redirect("/myself");
        }else{
            return back();
        }
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
    // 我的收藏删除
    public function show($id)
    {
        $uid=session("userid");
        if(DB::table("collection")->where("id","=",$id)->delete()){
            return back();
            
        }else{
            return back();
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
    // 修改密码
    public function subpwd(Request $request){
        $ypwd=$request->input("ypwd");
        $pwd=$request->input("pwd");
        $id=session("userid");
        $repwd=$request->input("repwd");
         $info=Users::where("id","=",$id)->first();
        if(Hash::check($ypwd,$info->pwd)){
            if($pwd==$repwd){
                
                $data['pwd']=Hash::make($pwd);
                Users::where("id","=",$id)->update($data);
                $request->session()->pull("userid");
                $request->session()->pull("username");
                return redirect("/");
            }else{
                return back();
            }
        }else{
            return back();
        }
    }
    // 检测原密码
    public function checkypwd(){
        $pwd=$_GET['pwd'];
        $id=session("userid");

        $info=Users::where("id","=",$id)->first();
        if(Hash::check($pwd,$info->pwd)){
            echo 1;
        }else{
            echo 2;
        }
    }
    public function myaddress(){
        // 当前用户的收获地址
        $id=session("userid");
        $myaddress=DB::table("address")->where("userid","=",$id)->get();
        // dd($myaddress);
        return view("Home.Myself.address",["myaddress"=>$myaddress]);
    }
    // 加入收藏
    public function addcollect()
    {
        $id=$_GET['id'];
        // echo $id;
        $data['goods_id']=$id;
        $data['user_id']=session("userid");
        if(DB::table("collection")->where("goods_id","$id")->where("user_id","=",$data['user_id'])->first()){
            echo 3;
        }else{
            if(DB::table("collection")->insert($data)){
                echo 1;
            }else{
                echo 2;
            }
        }
            
    }
    // 我的收藏
    public function mycollection(){
        $id=session('userid');
        // dd($id);
        $data=DB::table("collection")->select(["collection.id as cid","goods.id as gid","goods.name","goods.img","goods.shopprice","goods.Stock"])->join("goods","goods.id","=","collection.goods_id")->where("goods.status","=",2)->where("collection.user_id","=",$id)->get();
        // dd($data);
        return view("Home.Myself.collection",["data"=>$data]);
    }
}
