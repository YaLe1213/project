<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkInfo extends Model
{
    // 关联数据表
    protected $table="linkinfo";
    // 自动维护时间戳  开启
    public $timestamps=false;
    // 可以被批量赋值
    protected $fillable=['l_id','desc','email','icon'];
}
