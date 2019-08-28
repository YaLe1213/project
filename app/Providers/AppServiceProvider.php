<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
        // 无限分类递归
    public function getCatesPid($pid){
        // 获取顶级分类数据
        $cate=DB::table('cates')->where('pid','=',$pid)->get();
        // 把顶级分类的子类放到 suv 里
        $data=[];
        // 遍历
        foreach($cate as $key => $value){
            $value->suv=self::getCatesPid($value->id);
            $data[]=$value;

        }
        return $data;
    }
    public function boot()
    {
        // 首页分类  和 商品
        //获取顶级分类和子类
        $cates=self::getCatesPid(0);
        // 遍历把顶级分类的商品放到数组里
        foreach ($cates as $k => $v) {
            $v->goods=DB::table("goods")->where('cate_id','=',$v->id)->where("status","=",2)->get();
        }
        view()->share('cates',$cates);
// dd($cates);
        // 友情链接
        $friendlink=DB::table("friendlink")->where('status','=','1')->limit(3)->get();
        view()->share('friendlink',$friendlink);
        // 个人信息
        $id=session("userid");
        $info=DB::table("users")->where("id","=",$id)->first();
        view()->share('info',$info);

        // 第三级分类
        $ca=DB::table("cates")->get();
        foreach($ca as $v){
            // $data[]=;
                if(count(explode(',',$v->path,3))>2){
                    // explode(',',$v->path,3)['2'];
                    $data1=DB::table("cates")->where("pid","=",explode(',',$v->path,3)['2'])->get();
                    $data2[explode(',',$v->path,3)['1']][]=$data1;
                }
            // explode(',',$str,0)
        }
        // dd($data2);
        view()->share('three',$data2);
        

    }
}
