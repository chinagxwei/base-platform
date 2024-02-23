<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\System\RouterCheckService;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

//
class AdminAuthenticate extends Middleware
{
    /**
     * @param $request
     * @param Closure $next
     * @param ...$guards
     * @return Closure|JsonResponse|mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {

        if (!$this->auth->guard('api')->check()) {
            return response()->json(['code' => 401, 'message' => '请先登录']);
        }

        $path = "/" . $request->path();

        Log::info($path);

        /** @var User $user */
        if ($user = auth('api')->user()) {
            // 检测是否是管理员
            if ($user->isMember()) {
                return response()->json(['code' => 403, 'message' => '没有访问内容的权限']);
            }

            if ($user->isSuperManager()) {
                return $next($request);
            }
        }


//        $route = Route::current();
//
//        $action = $route->getActionMethod();
//
//        $path = "/" . $route->getPrefix() . "/{$action}";
//
//        Log::info($path);
//
//        Log::info(explode('/', $path));
//
//        /** @var RouterCheckService $service */
//        $service = app(RouterCheckService::class);
//
//        $res = $service->setAllowedRoutes([
//            '/api/v1/auth/info2',
//        ])->can($path);
//
//        Log::info("type:" . ($res ? '1' : '0'));

        return $next($request);
    }
}
