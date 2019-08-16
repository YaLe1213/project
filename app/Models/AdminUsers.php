<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class AdminUsers extends Model
{
	// 关联数据表
    protected $table="admin_users";
    // 自动维护时间戳  开启
    public $timestamps=true;
    // 可以被批量赋值
    protected $fillable=['name','pwd','status','rid'];
    // 查询全部的管理员的角色

    // 关联数据表 role
    //获取与用户关联的详情信息
	public function info(){
		return $this->hasOne('App\Models\AdminRole','rid');
	}
    // 修改器 自动获取并转换 数据字段值    自动转换管理员角色
    public function getRidAttribute($value){
    	// $data=AdminRole::get();
        $status=[]; 
        $data=DB::select("select id,name from role");

        foreach ($data as $k => $v) {
            $status[$v->id]=$v->name;
        }
    	return $status[$value];
    }
    // 修改器 自动获取并转换 数据字段值   自动转换管理员状态
    public function getStatusAttribute($value){
        $status=[1=>'可用',0=>'禁用'];
        return $status[$value];
    }
}
