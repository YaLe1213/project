<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     // 关联数据表
    protected $table="order";
    // 自动维护时间戳  开启
    public $timestamps=true;
    // 可以被批量赋值
    
    protected $fillable=['orderNo','user_id','pay_id','address_id','tot','send_id'];
    
}
