<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 //引入第三方验证码类库
use Gregwar\Captcha\CaptchaBuilder;
use Mail;
use Hash;
use App\Models\Users;
class RegisterController extends Controller
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
    // 验证码?
    public function yzm(){
       // 生成校验码代码
       ob_clean();
        //清除操作
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        // dd($phrase);
        //把内容存入session
        session(['vcode'=>$phrase]);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
        die;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {//注册
        //加载模板
        return view("Home.Register.register");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 发送邮箱 激活用户  用户id $email客户邮箱 $token 校验参数
    public function registermail($id,$email,$token){
        // 闭包函数内部直接获取不到外部变量,,用use 把闭包外部变量直接引到闭包函数内部
        //         现实的数据
        Mail::send("Home.Register.jihuo",['id'=>$id,'token'=>$token],function($message)use($email){
            $message->to($email);
            $message->subject('激活用户');
        });
        return true;
    }
    public function store(Request $request)
    {
        if ( 
            empty($request->input('email')) || 
            empty($request->input('pwd')) || 
            empty($request->input('repwd')) || 
            empty($request->input('yzm')) ) {
            return back()->with('warning','信息不可为空');
        }
        //
       // dd($request->all(),session('vcode'));
        // 校验验证码
        $yzm=$request->input('yzm');
        $vcode=session("vcode");
        // if($yzm==$vcode){
            // 校验密码]
            if($request->input('pwd')==$request->input('repwd')){
                // 封装入库
                 $data['name']=str_random(5);
                 $data['email']=$request->input('email');
                 $data['pwd']=Hash::make($request->input('pwd'));
                 $data['email']=$request->input('email');
                 $data['phone']=$request->input('phone');
                 $data['status']=0;//0没激活,2激活,1禁用
                 $data['token']=str_random(20);
                 // dd($data);
                 // 入库
                 $data1=Users::create($data);
                 // 获取该用户的id
                 $id=$data1->id;
                 // 发送激活页面给用户
                 if($id){
                    // 调用方法
                    $res=$this->registermail($id,$data['email'],$data['token']);
                    if ($res) {
                        // return redirect();
                        echo '激活用户已发送,请登录邮箱激活';
                    }else{
                        // return back()->with('error','请重新输入');
                        echo "error";
                    }
                 }
             }else{
                return back()->with('error','密码不一致,请重新输入');
            }
        // }else{
            // echo 'error';
        // }
    }
    ////////
    // 激活用户 statu=>2 //
    ////////
    public function jihuo(Request $request){
        $id=$request->input('id');
        $token=$request->input('token');
        // 获取用户信息
        $user=Users::where('id','=',$id)->first();
        // 校验两次密码是否一致
        if($token==$user->token){
            // 修改status=>2
            $data['status']=2;
            // 重置token
            $data['token']=str_random(20);
            Users::where('id','=',$id)->update($data);
            echo "激活成功";
        }else{
            echo "用户激活失败";
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
    // 手机注册
    public function registerphone(Request $request){
        $data['name']=str_random(5);
        $data['pwd']=Hash::make($request->input('pwd'));
        $data['email']='';
        $data['phone']=$request->input('phone');
        $data['status']=2;
        $data['token']=str_random(20);
        if(Users::create($data)){
            return redirect("/");
        }
    }
    // 检测手机号是否唯一
    public function checkphone(Request $request){
        $ph=$request->input("ph");
        // echo $ph;
        // 用当前 手机号 和 数据库 users 表的 手机号 作 对比
        // 获取 users 表 phone 列 并转为 数组
        $phone=Users::pluck("phone")->toArray();
        // 对比
        if(in_array($ph,$phone)){
            echo 0; //存在
        }else{
            echo 1; //不存在
        }
    }
    // 检测短信验证码是否一致
    public function checkcode(Request $request){
        $code=$request->input('code');
        if(isset($_SESSION['pcode']) && empty($code)){
            // 获取系统的验证码
            $pcode=$request->cookie('pcode');
            // 对比
            if($pcode==$code){
                echo 1; //通过
            }else{
                echo 2; //验证码有误
            }
        }elseif(empty($code)){
            echo 3; //验证码为空
        }else{
            echo 4; //验证码过期
        }
    }

    // 发送短信 验证码
    public function registersendphone(Request $request){
        $ph=$request->input('ph');
        dd($ph);
        // 调用短信接口
        $data=sendsphone($ph);
        echo $data;
    }

}
