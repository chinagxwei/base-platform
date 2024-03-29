<?php

namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\PlatformController;
use App\Models\System\SystemRole;
use Illuminate\Http\Request;

class SystemRoleController extends PlatformController
{
    protected $controller_event_text = "系统角色";

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $res = (new SystemRole())->searchBuild($request->all())->paginate();
        return self::successJsonResponse($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Request $request)
    {
        if ($id = $request->input('id')) {
            if ($model = SystemRole::findOneByID($id, ['navigations', 'routers'])) {
                return self::successJsonResponse($model);
            }
        }

        return self::failJsonResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        if ($request->isMethod('POST')) {
            $id = $request->input('id');

            try {
                $this->validate($request, [
                    'role_name' => 'required|min:2',
                ]);

                if ($id > 0) {
                    $model = SystemRole::findOneByID($id);
                } else {
                    $model = new SystemRole();
                }

                if ($model->fill($request->all())->save()) {
                    $this->saveEvent($model->role_name);
                    return self::successJsonResponse();
                }
            } catch (\Exception $e) {
                return self::failJsonResponse($e->getMessage());
            }
        }
        return self::failJsonResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        if ($id = $request->input('id')) {
            if ($model = SystemRole::findOneByID($id)) {
                $this->deleteEvent($model->role_name);
                $model->delete();
                return self::successJsonResponse();
            }
        }

        return self::failJsonResponse();
    }

    public function setNavigation(Request $request){
        if ($id = $request->input('id')) {
            $navigation_ids = $request->input('navigation_ids');
            if ($model = SystemRole::findOneByID($id)) {
                $model->navigations()->sync($navigation_ids);
                return self::successJsonResponse();
            }
        }

        return self::failJsonResponse();
    }

    public function setRouter(Request $request){
        if ($id = $request->input('id')) {
            $router_ids = $request->input('router_ids');
            if ($model = SystemRole::findOneByID($id)) {
                $model->routers()->sync($router_ids);
                return self::successJsonResponse();
            }
        }

        return self::failJsonResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRouterByRole(Request $request){
        if ($id = $request->input('id')) {
            if ($model = SystemRole::findOneByID($id)) {
                return self::successJsonResponse($model->routers);
            }
        }

        return self::failJsonResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNavigationByRole(Request $request){
        if ($id = $request->input('id')) {
            if ($model = SystemRole::findOneByID($id)) {
                return self::successJsonResponse($model->navigations);
            }
        }

        return self::failJsonResponse();
    }
}
