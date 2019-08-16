<?php

namespace App\Http\Middleware;

use Closure;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 检测后台用户是否登录
        if($request->session()->has('adminname')){
            // 4.把访问的面孔的控制器和方法获取到, 直接和权限作对比
            // 获取 session 里的权限
            $nodelist=session('nodelist');
            // 获取访问的模块的 控制器 和 方法
            $actions=explode('\\', \Route::current()->getActionName());
            //或$actions=explode('\\', \Route::currentRouteAction());
            $modelName=$actions[count($actions)-2]=='Controllers'?null:$actions[count($actions)-2];
            $func=explode('@', $actions[count($actions)-1]);
            $controllerName=$func[0];
            $actionName=$func[1];
            // 输出当前的控制器和方法名
            // echo $controllerName.":".$actionName;
            // 作对比
            // 访问模块的控制器不存在 或 访问的面孔控制器存在但是方法不存在
            if (empty($nodelist[$controllerName]) || !in_array($actionName,$nodelist[$controllerName])) {
                return redirect('/admin')->with('error',"sorry,您没有访问该模块的权限,请联系超管");
            }
            return $next($request);
        }else{
            return redirect('/adminlogin/create');
        }
        
    }
}
