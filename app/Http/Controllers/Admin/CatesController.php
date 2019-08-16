<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class CatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function getCates(){
        $cates=DB::table('cates')->select(DB::raw("*,concat(path,',',id)as paths"))->orderBy('paths')->get();
         foreach ($cates as $key => $value) {
            // 通过获取逗号的个数,来区分分类级别
            // 将 path 转为数组
            $arr=explode(',',$value->path);
            // 获取点的个数
            $len=count($arr)-1;
            // 重复字符串--添加前缀
            $cates[$key]->name=str_repeat('--|',$len).$value->name;
        }
        return $cates;
    }
    public function index(Request $request)
    {

        //列表
        // 获取关键词
        $k=$request->input('keywords');

        //获取总跳数
        $tot=DB::table('cates')->where("name",'like',"%".$k."%")->count();
        // 获取每页显示数据条数
        $rev=5;
        // 获取最大页数
        $maxpage=ceil($tot/$rev);
        // 遍历页数
        for ($i=1; $i <= $maxpage; $i++) { 
            $pp[$i]=$i;
        }
        // 获取当前页数
        $page=$request->input("page");

        // 判断有没有页数
        if(empty($page)){
            $page=1;
        }
        // 获取偏移量
        $offset=($page-1)*$rev;

        // 获取当前页数据
        $cates=DB::table('cates')->select(DB::raw("*,concat(path,',',id)as paths"))->orderBy('paths')->where("name",'like',"%".$k."%")->offset($offset)->limit($rev)->get();
        // dd($data);
        // 遍历
      
        foreach ($cates as $key => $value) {
            // 通过获取逗号的个数,来区分分类级别
            // 将 path 转为数组
            $arr=explode(',',$value->path);
            // dd($arr);
            // 获取点的个数
            $len=count($arr)-1;
            // 重复字符串--添加前缀
            $cates[$key]->name=str_repeat('--|',$len).$value->name;
        }

          // dd($cates);
          // 分页

        // 判断是否是ajax请求 是返回true 否则返回false
        if($request->ajax()){
        // dd($k);

            // 加载独立的ajax模板
            return view("Admin.Cates.page",["cates"=>$cates]);
        }else{
             return view('Admin.Cates.index',["pp"=>$pp,"cates"=>$cates]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 获取全部分类
        $cates=self::getCates();
        //分类修改
        return view("Admin.Cates.add",['cates'=>$cates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(empty($request->input('name'))){
            return back()->with('error','分类名不能为空');
        }
        // 去除_token\
        $data=$request->except('_token');
       
        // 获取pid
        $pid=$request->input('pid');
        // 添加path
        if($pid==0){
            // 添加顶级类
            $data['path']=0;
        }else{
            // 添加子类
            // 获取父类信息
            $info=DB::table('cates')->where('id','=',$pid)->first();
            $data['path']=$info->path.','.$info->id;
        }
        // 入库
        if(DB::table('cates')->insert($data)){
            return redirect('/admincates')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
        // dd($data);
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
        //修改
        $cates=self::getCates();
        // dd($cates);
        //获取本条数据
        $cate=DB::table('cates')->where('id','=',$id)->first();
        return view('Admin.cates.edit',['cate'=>$cate,'cates'=>$cates]);
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
        if(empty($request->input('name'))){
            return back()->with('error','分类名不能为空');
        }
        //执行修改
        //去除 _token 和 _method
        $data=$request->except('_token','_method');
        // 获取pid
        $pid=$request->input('pid');
        // 添加path
        if($pid==0){
            // 添加顶级类
            $data['path']=0;
        }else{
            // 添加子类
            // 获取父类信息
            $info=DB::table('cates')->where('id','=',$pid)->first();
            $data['path']=$info->path.','.$info->id;
        }
        // dd($data);
        // 入库
        if(DB::table('cates')->where('id','=',$id)->update($data)){
            return redirect('/admincates')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
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
        // 判断是否有子类
        // 获取 pid 的数量
        $len=DB::table('cates')->where('pid','=',$id)->count();
        if($len>0){
            return back()->with("warning","请先删除子类");
        }
        //删除
        if(DB::table('cates')->where('id','=',$id)->delete()){
            return redirect("/admincates")->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
}
