<?php

namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\PlatformController;
use App\Models\System\SystemRouter;
use Illuminate\Http\Request;

class SystemRouterController extends PlatformController
{
    protected $controller_event_text = "系统路由";

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $res = (new SystemRouter())->searchBuild($request->all())->paginate();
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
                    'router_name' => 'required|min:3',
                    'router' => 'required|min:3',
                ]);

                if ($id > 0) {
                    $model = SystemRouter::findOneByID($id);
                } else {
                    $model = new SystemRouter();
                }

                if ($model->fill($request->all())->save()) {
                    $this->saveEvent($model->router_name);
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
            if ($model = SystemRouter::findOneByID($id)) {
                $this->deleteEvent($model->router_name);
                $model->delete();
                return self::successJsonResponse();
            }
        }

        return self::failJsonResponse();
    }

}
