<?php

namespace App\Services\System;

class BaseSystemNavigationData
{

    public static function getSystemNavigationData($menus_id, $created_by)
    {
        $time = time();
        return [
//            [
//                'parent_id' => $menus_id,
//                'navigation_name' => 'banner管理',
//                'navigation_link' => '/system/banner',
//                'hash' => md5('/system/banner'),
//                'navigation_sort' => 1,
//                'menu_show' => 1,
//                'icon' => 'line-chart',
//                'created_by' => $created_by,
//                'created_at' => $time,
//                'updated_at' => $time
//            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '协议管理',
                'navigation_link' => '/system/agreement',
                'hash' => md5('/system/agreement'),
                'navigation_sort' => 2,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '协议编辑',
                'navigation_link' => '/system/agreement/edit',
                'hash' => md5('/system/edit'),
                'navigation_sort' => 2,
                'menu_show' => 0,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '协议详情',
                'navigation_link' => '/system/agreement/details',
                'hash' => md5('/system/details'),
                'navigation_sort' => 2,
                'menu_show' => 0,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '投诉管理',
                'navigation_link' => '/system/complaint',
                'hash' => md5('/system/complaint'),
                'navigation_sort' => 3,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '投诉详情',
                'navigation_link' => '/system/complaint/details',
                'hash' => md5('/system/complaint/details'),
                'navigation_sort' => 2,
                'menu_show' => 0,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '图片管理',
                'navigation_link' => '/system/images',
                'hash' => md5('/system/images'),
                'navigation_sort' => 4,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '标签管理',
                'navigation_link' => '/system/tag',
                'hash' => md5('/system/tag'),
                'navigation_sort' => 5,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],

            [
                'parent_id' => $menus_id,
                'navigation_name' => '单位管理',
                'navigation_link' => '/system/unit',
                'hash' => md5('/system/unit'),
                'navigation_sort' => 6,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '系统配置管理',
                'navigation_link' => '/system/config',
                'hash' => md5('/system/config'),
                'navigation_sort' => 7,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '导航管理',
                'navigation_link' => '/system/navigation',
                'hash' => md5('/system/navigation'),
                'navigation_sort' => 8,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '导航编辑',
                'navigation_link' => '/system/navigation/edit',
                'hash' => md5('/system/navigation/edit'),
                'navigation_sort' => 2,
                'menu_show' => 0,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '导航详情',
                'navigation_link' => '/system/navigation/details',
                'hash' => md5('/system/navigation/details'),
                'navigation_sort' => 2,
                'menu_show' => 0,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '用户角色管理',
                'navigation_link' => '/system/role',
                'hash' => md5('/system/role'),
                'navigation_sort' => 9,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '用户角色编辑',
                'navigation_link' => '/system/role/edit',
                'hash' => md5('/system/role/edit'),
                'navigation_sort' => 2,
                'menu_show' => 0,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '用户角色详情',
                'navigation_link' => '/system/role/details',
                'hash' => md5('/system/role/details'),
                'navigation_sort' => 2,
                'menu_show' => 0,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '管理员管理',
                'navigation_link' => '/system/manager',
                'hash' => md5('/system/manager'),
                'navigation_sort' => 10,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '管理员编辑',
                'navigation_link' => '/system/manager/edit',
                'hash' => md5('/system/manager/edit'),
                'navigation_sort' => 2,
                'menu_show' => 0,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '管理员详情',
                'navigation_link' => '/system/manager/details',
                'hash' => md5('/system/manager/details'),
                'navigation_sort' => 2,
                'menu_show' => 0,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '管理员日志',
                'navigation_link' => '/system/action-log',
                'hash' => md5('/system/action-log'),
                'navigation_sort' => 11,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'parent_id' => $menus_id,
                'navigation_name' => '系统路由管理',
                'navigation_link' => '/system/router',
                'hash' => md5('/system/router'),
                'navigation_sort' => 12,
                'menu_show' => 1,
                'icon' => 'line-chart',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
//            [
//                'parent_id' => $menus_id,
//                'navigation_name' => 'app错误日志管理',
//                'navigation_link' => '/system/app-bug-log',
//                'hash' => md5('/system/app-bug-log'),
//                'navigation_sort' => 12,
//                'menu_show' => 1,
//                'icon' => 'line-chart',
//                'created_by' => $created_by,
//                'created_at' => $time,
//                'updated_at' => $time
//            ],
//            [
//                'parent_id' => $menus_id,
//                'navigation_name' => 'app发布管理',
//                'navigation_link' => '/system/app-publish-log',
//                'hash' => md5('/system/app-publish-log'),
//                'navigation_sort' => 13,
//                'menu_show' => 1,
//                'icon' => 'line-chart',
//                'created_by' => $created_by,
//                'created_at' => $time,
//                'updated_at' => $time
//            ],
        ];
    }

}
