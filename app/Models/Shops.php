<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
     // 关联数据表
    protected $table="shops";
    // 自动维护时间戳  开启
    public $timestamps=true;
    // 可以被批量赋值
    // 门店名 店主id 状态
    protected $fillable=['name','userid','status','email'];
    
}
