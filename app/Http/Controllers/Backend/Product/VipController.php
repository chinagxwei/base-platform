<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\PlatformController;
use App\Models\Product\ProductVIP;
use Illuminate\Http\Request;

class VipController extends PlatformController
{
    protected $controller_event_text = "VIP管理";

    public function index(Request $request){
        $res = (new ProductVIP())->searchBuild($request->all(), ['unit'])->paginate();
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
                    'title' => 'required',
                    'day' => 'numeric',
                    'show' => 'numeric',
                ]);

                if ($id > 0) {
                    $model = ProductVIP::findOneByID($id);
                } else {
                    $model = new ProductVIP();
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
    public function view(Request $request)
    {
        if ($request->isMethod('POST') && $id = $request->input('id')) {
            if ($model = ProductVIP::findOneByID($id)) {
                return self::successJsonResponse($model);
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
            if ($model = ProductVIP::findOneByID($id)) {
                $this->deleteEvent($model->title);
                $model->delete();
                return self::successJsonResponse();
            }
        }

        return self::failJsonResponse();
    }
}
