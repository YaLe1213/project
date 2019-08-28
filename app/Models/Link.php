<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    // 关联数据表
    protected $table="friendlink";
    // 自动维护时间戳  开启
    public $timestamps=true;
    // 可以被批量赋值
    protected $fillable=['name','url','status',];

    // public function getStatusAttribute($value){
    //     $status=[0=>'未启用',1=>'启用'];
    //     return $status[$value];
    // }


    // 关联数据表 role
    //获取与用户关联的详情信息
	public function info(){
		return $this->hasOne('App\Models\LinkInfo','l_id');
	}
}
