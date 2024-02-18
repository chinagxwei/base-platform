<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\PlatformController;
use App\Models\ActionLog;
use App\Models\Order\OrderRevenues;
use Illuminate\Http\Request;

class OrderRevenuesController extends PlatformController
{
    protected $controller_event_text = "订单收益管理";

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $res = (new OrderRevenues())->searchBuild($request->all(),['formOrder.unit'])->paginate();
        return self::successJsonResponse($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Request $request)
    {
        if ($request->isMethod('POST') && $id = $request->input('id')) {
            if ($model = OrderRevenues::findOneByID($id)) {
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
            if ($model = OrderRevenues::findOneByID($id)) {
                $this->deleteEvent($model->from_order_sn);
                $model->delete();
                return self::successJsonResponse();
            }
        }

        return self::failJsonResponse();
    }
}
