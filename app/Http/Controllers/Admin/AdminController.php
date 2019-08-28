<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //加载视图
        return view("/admin.admin");
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
    // 修改密码
    public function adminuppwd(){
        return view("Admin.adminuppwd");
    }
    public function adminpwdsave(Request $request)
    {
        $ypwd=$request->input("ypwd");        
        $pwd=$request->input("pwd");        
        $repwd=$request->input("repwd"); 
        $adminname=session("adminname");
        $info=DB::table("admin_users")->where("name","=",$adminname)->first();
        $id=$info->id;
        // dd($id);
        if(Hash::check($ypwd,$info->pwd)){
            if($pwd==$repwd){
                $data['pwd']=Hash::make($repwd);
                if(DB::table("admin_users")->where("id","=",$id)->update($data)){
                    $request->session()->pull('adminname');
                    $request->session()->pull('nodelist');
                    return redirect('/adminlogin/create');
                }
            }else{
                return back()->with("warning","两次密码不一致");
            }
        }else{
            return back()->with("warning","原密码不正确");
        }    
    }
}
