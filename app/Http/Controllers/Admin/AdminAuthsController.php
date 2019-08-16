<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class AdminAuthsController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     *权限列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取关键词
        $k=$request->input('keywords');
        //获取全部权限
        $auths=DB::table("node")->where('name','like','%'.$k.'%')->paginate(8);
        // dd($auths);
        //加载权限列表模板
        return view("Admin.AdminAuths.index",['auths'=>$auths,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     *权限添加
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("Admin.AdminAuths.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //判断不为空
        if(empty($request->input('name')) || empty($request->input('mname')) || empty($request->input('aname'))){
            return back()->with('warning','名字或控制器或方法为空');
        }
        //判断是否已存在
        if(DB::table("node")->where('name','=',$request->input('name'))->first()){
            return back()->with('warning','此权限已经存在请重新填写');
        }
        // 去除 _token
        $data=$request->except('_token');
        // 添加状态
        $data['status']=1;
        // 入库
        if(DB::table('node')->insert($data)){
            return redirect("/adminauths")->with('success','添加权限成功!');
        }else{
            return back()->with('error','添加权限失败!');
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
        //权限修改
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
     *权限删除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(DB::table("node")->where('id','=',$id)->delete()){
            return redirect('/adminauths')->with('success','删除权限成功!');
        }else{
            return back()->with('error',"删除权限失败!");
        }
    }
}
