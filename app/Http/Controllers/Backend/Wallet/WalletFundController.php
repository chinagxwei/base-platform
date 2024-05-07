<?php

namespace App\Http\Controllers\Backend\Wallet;

use App\Http\Controllers\PlatformController;
use App\Models\ActionLog;
use App\Models\Wallet\WalletFund;
use App\Models\Wallet\WalletRecharge;
use Illuminate\Http\Request;

class WalletFundController extends PlatformController
{
    protected $controller_event_text = "钱包充值管理";

    public function index(Request $request)
    {
        $res = (new WalletFund())->searchBuild($request->all(), ['unit'])
            ->orderBy('created_at', 'desc')
            ->paginate();
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
                    'wallet_id' => 'required',
                    'denomination' => 'required',
                    'balance' => 'required',
                    'unit_id' => 'required',
                    'frozen' => 'required',
                    'channel' => 'required',
                    'gift' => 'required',
                ]);

                if ($id > 0) {
                    $model = WalletFund::findOneByID($id);
                } else {
                    $model = new WalletFund();
                }

                if ($model->fill($request->all())->save()) {
                    $text = [
                        $model->id,
                        $model->denomination,
                        $model->balance,
                        $model->unit_id,
                        $model->frozen,
                        $model->gift,
                    ];
                    $this->saveEvent(join(" | ", $text));
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
            if ($model = WalletFund::findOneByID($id)) {
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
            if ($model = WalletFund::findOneByID($id)) {
                $text = [
                    $model->id,
                    $model->denomination,
                    $model->balance,
                    $model->unit_id,
                    $model->frozen,
                    $model->gift,
                ];
                $this->deleteEvent(join(" | ", $text));
                $model->delete();
                return self::successJsonResponse();
            }
        }

        return self::failJsonResponse();
    }
}
