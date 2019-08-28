<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use App\Models\Users;
use Mail;
class HomeLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Home.HomeLogin.login");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 获取账号 和 密码
        $user=$request->input('user');
        $pwd=$request->input('pwd');
        // 获取数据列
        $email=Users::pluck("email")->toArray();
        $phone=Users::pluck("phone")->toArray();
        // 判断用户
        if(in_array($user,$email)){
            $info=Users::where("email","=",$user)->first();
        }else if(in_array($user, $phone)){
            $info=Users::where("phone","=",$user)->first();
        }else{
            return back()->with('error','账号或密码错误');
        }
            if(Hash::check($pwd,$info->pwd)){
                session(["userid"=>$info->id,"username"=>$info->name]);
                return redirect("/");
            }else{
                return back()->with('error','账号或密码错误');
            }
        
    }
    // 用户退出登录
    public function logout(Request $request){
        if($request->session()->pull("userid")){
            return redirect("/homelogin/create");
        }else{
            return back();
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
    //忘记密码
    public function forget(Request $request){
        return view("Home.HomeLogin.forget");
    }

    // 发送邮箱 激活用户  用户id $email客户邮箱 $token 校验参数
    public function loginmail($id,$email,$token){
        // 闭包函数内部直接获取不到外部变量,,用use 把闭包外部变量直接引到闭包函数内部
        //         现实的数据
        Mail::send("Home.HomeLogin.reset",['id'=>$id,'token'=>$token],function($message)use($email){
            $message->to($email);
            $message->subject('重置密码');
        });
        return true;
    }
    // 忘记密码执行
    public function doforget(Request $request){
        // 获取邮箱列
        $email=$request->input('email');
        // 获取邮箱的数据
        $info=Users::where('email','=',$email)->first();
        // 发送邮箱
        if($this->loginmail($info->id,$email,$info->token)){
            echo "发送成功";
        }
    }
    // 重置密码模板
    public function reset(Request $request){
        $id=$request->input('id');
        $token=$request->input('token');
        // 获取数据库的数据
        $info=Users::where("id","=",$id)->first();
        // 校验token\
        if($token==$info->token){
            return view("Home.HomeLogin.reset1",['id'=>$id]);
        }
        
    }
    // 执行重置密码模板
    public function doreset(Request $request){
        // 获取 id 和 密码
        $id=$request->input('id');
        $data['pwd']=Hash::make($request->input('pwd'));
        $data['token']=str_random(20);
        // 执行修改
        if(Users::where("id","=",$id)->update($data)){
            return redirect("/homelogin/create");
        }
    }
}
