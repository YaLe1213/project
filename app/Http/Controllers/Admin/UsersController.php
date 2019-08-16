<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //加载用户列表
        // 获取全部用户信息
        $data=Users::get();
        return view("Admin.Users.index",['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载用户添加
        return view("Admin.Users.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取全部数据
        $data=$request->except("_token","repwd");
        // 判断密码和确认密码是否相等
        if($request->input('pwd')==$request->input('repwd')){
            $data['pwd']=Hash::make($request->input('pwd'));
        }else{
            return back()->with("error","密码不一致,请重新输入");
        }
        // 加入状态和token
        $data['status']=0;
        $data['token']=str_random(50);
        // dd($data);
        // 入库
        if(Users::create($data)){
            return redirect('/adminuser')->with('success','添加用户成功');
        }else{
            return back()->with('error','添加用户失败');
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
        //用户修改状态
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
        //用户删除
    }
}
