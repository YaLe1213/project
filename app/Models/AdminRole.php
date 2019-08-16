<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    // 关联数据表
    protected $table="role";
    // 自动维护时间戳  关闭
    public $timestamps=false;
    // 可以被批量赋值
    protected $fillable=['name','status'];
    // 修改器 自动获取并转换 数据字段值   自动转换角色状态
    public function getStatusAttribute($value){
    	$status=[1=>'可用',0=>'禁用'];
    	return $status[$value];
    }
}
