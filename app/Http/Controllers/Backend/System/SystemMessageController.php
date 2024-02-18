<?php

namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\PlatformController;
use App\Models\System\SystemAdminMessage;
use App\Models\System\SystemMessage;
use App\Service\System\SystemMessageService;
use Illuminate\Http\Request;

class SystemMessageController extends PlatformController
{
    protected $controller_event_text = "系统消息";

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $res = (new SystemAdminMessage())->searchBuild($request->all())->paginate();
        return self::successJsonResponse($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Request $request){
        if ($request->isMethod('POST') && $id = $request->input('id')) {
            if ($model = SystemAdminMessage::findOneByID($id)) {
                return self::successJsonResponse($model);
            }
        }

        return self::failJsonResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request){
        if ($request->isMethod('POST')) {
            $id = $request->input('id');

            try {
                $this->validate($request, [
                    'title' => 'required|min:1',
                    'content' => 'required|min:1',
                ]);

                if ($id > 0) {
                    $model = SystemAdminMessage::findOneByID($id);
                } else {
                    $model = new SystemAdminMessage();
                }

                if ($model->fill($request->all())->save()) {
                    $this->saveEvent($model->title);
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
    public function delete(Request $request){
        if ($id = $request->input('id')) {
            if ($model = SystemAdminMessage::findOneByID($id)) {
                $this->deleteEvent($model->title);
                $model->delete();
                return self::successJsonResponse();
            }
        }

        return self::failJsonResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request){
        if ($id = $request->input('id')) {
            SystemMessageService::send($id);
            return self::successJsonResponse();
        }

        return self::failJsonResponse();
    }
}
