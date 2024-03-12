<?php

namespace App\Http\Controllers\Backend\Enterprise;

use App\Http\Controllers\PlatformController;
use App\Models\Enterprise\Enterprise;
use Illuminate\Http\Request;

class EnterpriseController extends PlatformController
{
    protected $controller_event_text = "企业管理";

    public function index(Request $request){
        $res = (new Enterprise())->searchBuild($request->all())->paginate();
        return self::successJsonResponse($res);
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
                    'name' => 'required|min:1',
                ]);

                if ($id > 0) {
                    $model = Enterprise::findOneByID($id);
                } else {
                    $model = new Enterprise();
                }

                if ($model->fill($request->all())->save()) {
                    $this->saveEvent($model->name);
                    return self::successJsonResponse();
                }
            } catch (\Exception $e) {
                return self::failJsonResponse($e->getMessage());
            }
        }
        return self::failJsonResponse();
    }

//    /**
//     * @param Request $request
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function view(Request $request)
//    {
//        if ($request->isMethod('POST') && $id = $request->input('id')) {
//            if ($model = Enterprise::findOneByID($id)) {
//                return self::successJsonResponse($model);
//            }
//        }
//
//        return self::failJsonResponse();
//    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        if ($id = $request->input('id')) {
            if ($model = Enterprise::findOneByID($id)) {
                $this->deleteEvent($model->name);
                $model->delete();
                return self::successJsonResponse();
            }
        }

        return self::failJsonResponse();
    }
}
