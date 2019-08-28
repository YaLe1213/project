<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
     // 关联数据表
    protected $table="order_info";
    // 自动维护时间戳  开启
    public $timestamps=false;
    // 可以被批量赋值
    protected $fillable=['order_id','goods_id','name','name','img','price','num','status'];
    // 修改器 自动获取并转换 
    // -3'用户拒收,'-2'未付款,'-1'用户取消,'0'代发货,'1'配送中,'2'用户确认收货
    public function getStatusAttribute($value){
        $status=[-3=>'用户拒收',-2=>'未付款',-1=>'用户取消',0=>'待发货',1=>'配送中',2=>'已收货'];
        return $status[$value];
    }
}
