<?php

namespace App\Http\Controllers\Backend\Member;

use App\Http\Controllers\PlatformController;
use App\Models\Member\Member;
use App\Services\User\RegisterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MemberController extends PlatformController
{
    protected $controller_event_text = "会员管理";

    public function index(Request $request)
    {
        $res = (new Member())->searchBuild($request->all(), [
                'parent', 'wallet', 'vipInfo',
                'banInfo', 'wallet.accounts', 'games',
                'statisticsCompetition', 'statisticsFund', 'statisticsTeam'
            ]
        )->paginate();
        return self::successJsonResponse($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Request $request)
    {
        if ($request->isMethod('POST') && $id = $request->input('id')) {
            if ($model = Member::findOneByID($id, [
                'parent', 'wallet', 'vipInfo', 'withdrawalAccounts',
                'banInfo', 'wallet.accounts', 'games', 'banGameRule:id,title',
                'statisticsCompetition', 'statisticsFund', 'statisticsTeam',
                'incomeConfig'
            ])) {
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
            if ($model = Member::findOneByID($id)) {
                $this->deleteEvent($model->id);
                $model->delete();
                return self::successJsonResponse();
            }
        }

        return self::failJsonResponse();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function generate(Request $request)
    {

        (new RegisterService())->generateMemberByPlatform();

        return self::successJsonResponse();
    }

}
