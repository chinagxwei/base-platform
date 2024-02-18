<?php

namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\PlatformController;
use App\Models\Admin\AdminNavigation;
use App\Models\System\SystemAdminNavigation;
use Illuminate\Http\Request;

class SystemAdminNavigationController extends PlatformController
{
    protected $controller_event_text = "管理员菜单";

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $res = (new SystemAdminNavigation())->searchBuild($request->all())->paginate();
        return self::successJsonResponse($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        if ($request->isMethod('POST')) {
            $id = $request->input('id',0);
            try {
                $this->validate($request, [
                    'navigation_name' => 'required|min:3',
                ]);

                if ($id > 0) {
                    $model = SystemAdminNavigation::findOneByID($id);
                } else {
                    $model = new SystemAdminNavigation();
                }

                if ($model->fill($request->all())->save()) {
                    $this->saveEvent($model->navigation_name);
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
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function delete(Request $request)
    {
        if ($id = $request->input('id')) {
            if ($model = SystemAdminNavigation::findOneByID($id)) {
                $this->deleteEvent($model->navigation_name);
                $model->delete();
                return self::successJsonResponse();
            }
        }

        return self::failJsonResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function sortChange(Request $request)
    {
        $param = $request->all();
        if (is_array($param)) {
            foreach ($param as $value) {
                if ($model = SystemAdminNavigation::findOneByID($value['id'])) {
                    $model->setNavigationSort($value['sort'])->save();
                }
            }
            $this->generateEvent("修改导航排序", "修改导航排序");
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function allMenu(Request $request)
    {
        $user = auth('api')->user();
        $admin = $user->admin;
        return self::successJsonResponse($admin->role->navigations);
    }
}
