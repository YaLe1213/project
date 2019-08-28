<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
     // 关联数据表
    protected $table="goods";
    // 自动维护时间戳  开启
    public $timestamps=true;
    // 可以被批量赋值
    // 商品名称、商品编码、分类id、图片、门店id、门店价格、超市价格、库存stock、isSale是否上架、isBest是否加精、isHot是否热销、是否新品、isRecom是否推荐、描述、状态（0违规1未审核2已审核）、总销量 是否删除
    protected $fillable=['name','Sn','cate_id','img','shopid','shopprice','marketprice','Stock','isSale','isBest','isHot','isNew','isRecom','desc','status','saleNum','isdel'];
    // 修改器 自动获取并转换 
    public function getStatusAttribute($value){
        $status=[0=>'违规',1=>'未审核',2=>'已审核'];
        return $status[$value];
    }
    // //isSale是否上架
    // public function getIsSaleAttribute($value){
    //     $status=[0=>'否',1=>'是'];
    //     return $status[$value];
    // }
    // // 是否精品
    // public function getIsBestAttribute($value){
    //     $status=[0=>'否',1=>'是'];
    //     return $status[$value];
    // }
    // // 是否热销
    // public function getIsHotAttribute($value){
    //     $status=[0=>'否',1=>'是'];
    //     return $status[$value];
    // }
    // // 是否新品
    // public function getIsNewAttribute($value){
    //     $status=[0=>'否',1=>'是'];
    //     return $status[$value];
    // }
    // // 是否推荐
    // public function getIsRecomAttribute($value){
    //     $status=[0=>'否',1=>'是'];
    //     return $status[$value];
    // }
    // // 是否删除
    // public function getIsdelAttribute($value){
    //     $status=[0=>'否',1=>'是'];
    //     return $status[$value];
    // }
   
}
