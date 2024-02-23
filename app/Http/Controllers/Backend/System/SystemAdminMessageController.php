<?php

namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\PlatformController;
use App\Models\System\SystemAdminMessage;
use Illuminate\Http\Request;

class SystemAdminMessageController extends PlatformController
{
    protected $controller_event_text = "管理员消息";

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $res = SystemAdminMessage::query()->paginate();
        return self::successJsonResponse($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Request $request){
        if ($id = $request->input('id')) {
            if ($model = SystemAdminMessage::findOneByID($id)) {
                return self::successJsonResponse($model);
            }
        }

        return self::failJsonResponse();
    }

}
