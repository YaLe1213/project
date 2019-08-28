<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Address;


class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 获取城市级联数据
    public function address(Request $request){
        $upid=$request->input('upid');
        $address=DB::table('district')->where('upid','=',$upid)->get();

        echo json_encode($address);
    }
    // 添加收获地址
    public function insert(Request $request){
        // 接受数据
        // dd($request->all());
        $data['name']=$request->input('name');
        $data['phone']=$request->input('phone');
        $data['info']=$request->input('info');
        $data['userid']=session('userid');
        $data['isDefault']=0;
        if(Address::create($data)){
            return back();
        }else{
            return back();
        }
    }
    // 删除收货地址
    public function del(Request $request){
        $id=$_GET['id'];
        if(Address::where("id","=",$id)->delete()){
            echo 1;
        }else{
            echo 2;
        }
    }
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
}
