<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
// 导入模型
use App\Models\AdminUsers;
use App\Models\AdminRole;
class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //管理员列表
        // 获取全部管理员
        $k=$request->input("keywords");
        $adminusers=AdminUsers::where('name','like','%'.$k.'%')->paginate(2);
        // dd($adminusers);
        return view("Admin.AdminUsers.index",['adminusers'=>$adminusers,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //管理员添加
        //加载添加视图
        // 获取管理员的角色
        $role=AdminRole::where("id",'>','1')->get();
        // dd($role);
        return view("Admin.AdminUsers.add",['role'=>$role]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(empty($request->input('name')) || empty($request->input("pwd"))){
            return back()->with('error','用户名或密码为空');
        }
        if(AdminUsers::where('name','=',$request->input('name'))->count()>0){
            return back()->with('warning','该用户已存在,请重新填写!');
        }
        //执行添加
        // 去除 _token
        $data=$request->except('_token');
        // 密码加密
        $data['pwd']=Hash::make($data['pwd']);
        $data['status']=1;
        // dd($data);
        // 入库
        if(AdminUsers::create($data)){
            return redirect("/adminusers")->with('success','添加管理员成功');
        }else{
            return back()->with('error','添加管理员失败,');
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
        //管理员角色修改
        // 获取全部角色
        $role=AdminRole::where('id','>','1')->get();
        // dd($role);
        // 获取该管理员的信息
        $adminuser=AdminUsers::where('id','=',$id)->first();
        // dd($AdminUsers);
        // 加载角色模板
        return view("Admin.AdminUsers.edit",['role'=>$role,'adminuser'=>$adminuser]);
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
        // 执行修改角色
        // 去除 _token 和 _method
        $data=$request->except('_token','_method');
        // dd($data);
        // 入库
        if(AdminUsers::where('id','=',$id)->update($data)){
            return redirect('/adminusers')->with('success','修改角色成功');
        }else{
            return back()->with('error','修改角色失败');
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
        //管理员删除
        if(AdminUsers::where('id','=',$id)->delete()){
            return redirect('/adminusers')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
}
