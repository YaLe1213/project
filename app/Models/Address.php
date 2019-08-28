<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    // 关联数据表
    protected $table="Address";
    // 自动维护时间戳  关闭
    public $timestamps=true;
    // 可以被批量赋值
    protected $fillable=['userid','name','phone','info','isDefault'];
    // 修改器 自动获取并转换 数据字段值   自动转换角色状态
    public function getIsDefaultAttribute($value){
    	$status=[1=>'默认',0=>'普通'];
    	return $status[$value];
    }
}
