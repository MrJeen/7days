<?php

namespace App\Http\Middleware;

use Closure;
use Silber\Bouncer\BouncerFacade as Bouncer;

class checkFrontPermission
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        //获取当前路由
        $name = \Route::currentRouteName();
        $ability = Bouncer::ability()->where('name',$name)->first();
        if($ability){
            //判断登录
            \Auth::authenticate();
            //检查权限
            Bouncer::authorize($ability);
        }
        return $next($request);
    }
}
