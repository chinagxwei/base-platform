<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{

    /**
     * @param $request
     * @param Closure $next
     * @param ...$guards
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {

        if (!$this->auth->guard('api')->check()) {
            return response()->json(['code' => 403, 'message' => '请先登录']);
        }

        $route = Route::current();

        $action = $route->getActionMethod();

        $path = $route->getPrefix() . "/{$action}";
//
//        $name = Route::currentRouteName();
//
//        $action = Route::currentRouteAction();
//
        Log::info($path);
        Log::info(explode('/', $path));
//        Log::info($route->getActionMethod());
//
//        Log::info($name);
//
//        Log::info($action);

        return $next($request);
    }
}
