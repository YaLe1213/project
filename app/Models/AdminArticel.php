<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminArticel extends Model
{
    // 关联数据表
    protected $table="articel";
    // 自动维护时间戳  关闭
    public $timestamps=false;
    // 可以被批量赋值
    protected $fillable=['title','desc','editor','thumb'];
    
}
