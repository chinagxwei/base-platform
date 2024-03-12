<?php

namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\PlatformController;
use App\Models\System\SystemAdmin;
use App\Models\System\SystemNavigation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SystemAdminController extends PlatformController
{
    protected $controller_event_text = "平台管理员";

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $res = (new SystemAdmin())->searchBuild($request->all(), ['creator', 'role'])->paginate();
        return self::successJsonResponse($res);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function save(Request $request)
    {
        if ($request->isMethod('POST')) {
            $id = $request->input('id');
            $param = $request->all();
            if ($id <= 0) {
                $this->validate($request, [
                    'username' => 'required|min:6',
                    'password' => 'required|min:6',
                    'role_id' => 'required',
                ]);
                $model = new User();

                $model->registerManager($request->all());

                $admin = new SystemAdmin();

                $admin->setMobile($param['mobile'])
                    ->setAdminRole($param['role_id'])
                    ->setNickname($model->username);

                if (!empty($param['remark'])) {
                    $admin->setRemark($param['remark']);
                }

                $model->admin()->save($admin);

                $this->saveEvent($model->username);

            } else {
                $admin = SystemAdmin::findOneByID($id);

                $admin->setMobile($param['mobile'])->setAdminRole($param['role_id'])->save();

            }
            return self::successJsonResponse($admin);
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

            if ($admin = SystemAdmin::findOneByID($id)) {

                if ($admin->user->isSuperManager()){
                    return self::failJsonResponse();
                }

                $this->deleteEvent($admin->nickname);

                $admin->user()->delete();

                $admin->delete();

                return self::successJsonResponse();
            }
        }

        return self::failJsonResponse();
    }

    public function info(){
        /** @var User $user */
        $user = auth('api')->user();

        if ($user && ($user->isSuperManager() || $user->isManager() || $user->isEnterpriseManager())) {
            $navigation_str = Cache::get(SystemNavigation::USER_NAVIGATION_KEY . "_{$user->id}");
            $info = $user->admin->toArray();
            $info['navigations'] = json_decode($navigation_str) ?? [];
            return self::successJsonResponse($info);
        }
        return self::failJsonResponse('Not Found');
    }
}
