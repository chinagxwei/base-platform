<?php

namespace App\Services\System;

use App\Models\System\SystemAdmin;
use App\Models\System\SystemEnterprise;
use App\Models\System\SystemNavigation;
use App\Models\System\SystemRole;
use App\Models\System\SystemRouter;
use Illuminate\Support\Facades\DB;

class InstallService
{

    /** @var SystemAdmin */
    private $admin;

    public function setup()
    {
        $enterprise = $this->addEnterprise();
        $this->admin = $this->addAdmin($enterprise->id);
        $this->addRouter();
        $this->addMenu();
        $this->addRole();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null|SystemEnterprise
     */
    private function addEnterprise()
    {
        (new SystemEnterprise)->save([
            'name' => 'base platform',
        ]);
        return SystemEnterprise::query()->first();
    }

    private function addAdmin($enterprise_id)
    {
        $baseUser = [
            'username' => 'admin',
            'email' => 'admin@system.com',
            'password' => bcrypt('admin123456'),
            'user_type' => \App\Models\User::USER_TYPE_PLATFORM_SUPER_MANAGER,
            'enterprise_id' => $enterprise_id
        ];

        $user = new \App\Models\User();

        $user->fill($baseUser)->save();

        return $user->admin()->save(new \App\Models\System\SystemAdmin(['nickname' => 'admin'])) ? $user->admin : null;
    }

    private function addMenu()
    {
        SystemNavigation::generateParent("站点首页", "line-menu", $this->admin->created_by, 0, '/');

        $systemMenus = SystemNavigation::generateParent("系统管理", "line-menu", $this->admin->created_by, 7, '/system');

        $systemData = BaseSystemNavigationData::getSystemNavigationData($systemMenus->id, $this->admin->created_by);

        SystemNavigation::query()->insert($systemData);
    }

    private function addRole()
    {
        if ($role = SystemRole::generate("管理员", $this->admin->created_by)) {
            $ids = SystemNavigation::getParentAll()->map(function ($v) {
                return $v->id;
            });

            $role->navigations()->sync($ids->toArray());

            $this->admin->setAdminRole($role->id)->save();
        }
    }

    private function addRouter()
    {
        $data = BaseSystemRouterData::getData($this->admin->created_by);

        SystemRouter::query()->insert($data);
    }
}
