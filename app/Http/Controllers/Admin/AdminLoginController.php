<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class AdminLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //退出后台
        //销毁session
        $request->session()->pull('adminname');
        $request->session()->pull('nodelist');
        // 跳转到登录界面
        return redirect('/adminlogin/create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载后台登录模板
        return view("Admin.AdminLogin.login");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 步骤:1.获取登录的 管理员名
        // 2.检测管理员名
        // 3.检测密码

        // dd($request->all());
        // 获取登录的用户名 和 密码
        $name=$request->input('name');
        $pwd=$request->input('pwd');
        // 获取管理员信息  检测管理员
        $info=DB::table('admin_users')->where('name','=',$name)->first();
        if($info){
            // 检测密码
            if(Hash::check($pwd,$info->pwd)){
                // 把管理员账户放到 session 里
                session(['adminname'=>$name]);
                session(['adminid'=>$info->id]);
                // 初始化管理员的权限
                // 获取当前管理员的权限信息
                // $list=DB::select("select n.name,n.mname,n.aname from user_role as ur,role_node as rn,node as n where ur.rid=rn.rid and rn.nid=n.id and uid={$info->id}");
                $list=DB::select("select n.name,n.mname,n.aname from role as r,role_node as rn,node as n where r.id={$info->rid} and rn.rid=r.id and rn.nid=n.id");
                
                // 初始化管理员的权限
                $nodelist['AdminController'][]='index';
                $nodelist['AdminController'][]="adminuppwd";
                $nodelist['AdminController'][]="adminpwdsave";
                foreach($list as $key=>$value){
                    $nodelist[$value->mname][]=$value->aname;
                    // 如果有 create 方法 添加store
                    if ($value->aname=='create') {
                        $nodelist[$value->mname][]="store";
                    }
                    // 如果有 edit 方法 添加update
                    if ($value->aname=="edit") {
                        $nodelist[$value->mname][]="update";
                    }
                }

                // dd($nodelist);
                // 把管理员的权限放到 session 里
                session(['nodelist'=>$nodelist]);
                // 返回首页
                return redirect("/admin")->with('success','登录成功');
            }else{
                return back()->with('error','密码有误');
            }
        }else{
            return back()->with('error','管理员有误');
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
