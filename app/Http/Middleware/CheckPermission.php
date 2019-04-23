<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Silber\Bouncer\BouncerFacade as Bouncer;

class CheckPermission
{

    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     * @throws AuthorizationException
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        //判断登录
        \Auth::authenticate();

        //获取当前路由
        $name = \Route::currentRouteName();
        //判断权限
        $bool = Bouncer::can($name);
        $method = \Request::method();

        if(!$bool && $method == 'GET'){
            $ability = Bouncer::ability()->where('name',$name)->first();
            if($ability['parentId']){
                $abilities = Bouncer::ability()->where('parentId',$ability['parentId'])->pluck('name')->toArray();
                $user = \Auth::user();
                $userAbilityNames = $user->getAbilities()->pluck('name')->toArray();
                $same = array_intersect($abilities,$userAbilityNames);
                if($same){
                    $route = reset($same);
                    if(\Route::has($route)){
                        return redirect(route($route));
                    }else{
                        $redirect = $this->goRedirect($user,$route);
                        if($redirect){
                            return redirect(route($redirect));
                        }
                    }
                }
            }
            throw new AuthorizationException();
        }

        return $next($request);
    }

    protected function goRedirect($user,$route){
        $manageAbility = $user->getAbilities()->where('name',$route)->first();
        $subAbilities = $user->getAbilities()->where('parentId',$manageAbility['id'])->all();
        foreach($subAbilities as $subAbility){
            if(\Route::has($subAbility['name'])){
                return $subAbility['name'];
            }else{
                return $this->goRedirect($user,$subAbility['name']);
            }
        }
        return false;
    }
}
