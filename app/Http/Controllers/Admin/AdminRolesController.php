<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminRole;
use DB;
class AdminRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //角色列表
        //获取关键词
      
            $k=$request->input("k");
        // die;
        //获取角色全部信息
        $adminroles=AdminRole::where('name','like','%'.$k.'%')->paginate(2);
        // return view("Admin.AdminRoles.index",['adminroles'=>$adminroles,'request'=>$request]);
         if($request->ajax()){
            $adminroles=AdminRole::where('name','like','%'.$k.'%')->get();
            // 加载独立的ajax模板
            return view("Admin.AdminRoles.page",['adminroles'=>$adminroles]);
        }else{
            return view("Admin.AdminRoles.index",['adminroles'=>$adminroles,'request'=>$request]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //角色添加
        //获取已有的全部权限
        $role=AdminRole::get();
        // 加载添加模板
        return view("Admin.AdminRoles.add",['role'=>$role]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 判断 name 是否为空
        if(empty($request->input('name'))){
            return back()->with('warning','角色名不能为空!');
        }
        // 判断角色是否已存在
        if(AdminRole::where('name','=',$request->input('name'))->count()>0){
            return back()->with('warning','角色已经存在,请重新添加');
        }
        //执行角色添加
        // 去除 _token
        $data=$request->except('_token');
        // 添加状态
        $data['status']=1;
        // dd($data);
        // 入库
        if(AdminRole::create($data)){
            return redirect('/adminroles')->with('success','添加角色成功');
        }else{
            return back()->with('error','添加角色失败!');
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
        //分配权限
        //获取原有的权限
        $data=DB::table("role_node")->where('rid','=',$id)->get();
        //获取所有权限
        $node=DB::table('node')->get();
        if(count($data)){
            foreach ($data as $key => $value) {
                $nodes[]=$value->nid;
            }

        }else{
            $nodes[]=null;
        }
        // dd($nodes);
        //加载模板
        return view("Admin.AdminRoles.edit",['node'=>$node,'id'=>$id,'nodes'=>$nodes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {// 分配权限执行
        if(empty($request->input('nid'))){
            return back()->with('warning','请选择权限');
        }
        // 去除 _token 和 _method
        $nid=$request->input('nid');
        //干掉之前的权限
        DB::table("role_node")->where('rid','=',$id)->delete();
        // 遍历入库
        foreach ($nid as $k => $v) {
            $data['rid']=$id;
            $data['nid']=$v;
            DB::table("role_node")->insert($data);
            
        }

        return redirect('/adminroles')->with('success','分配权限成功!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //角色删除
        if(AdminRole::where('id','=',$id)->delete()){
            return redirect('/adminroles')->with('success','删除角色成功!');
        }else{
            return back()->with('error','删除角色失败!');
        }
    }
}
