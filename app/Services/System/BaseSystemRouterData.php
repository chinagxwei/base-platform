<?php

namespace App\Services\System;

class BaseSystemRouterData
{
    public static function getData($created_by)
    {
        $time = time();
        return array_merge(
            self::getAgreement($created_by, $time),
            self::getComplaint($created_by, $time),
            self::getImage($created_by, $time),
            self::getTag($created_by, $time),
            self::getUnit($created_by, $time),
            self::getEnterprise($created_by, $time),
            self::getConfig($created_by, $time),
            self::getNavigation($created_by, $time),
            self::getRole($created_by, $time),
            self::getManager($created_by, $time),
            self::getActionLog($created_by, $time),
            self::getRouters($created_by, $time)
        );
    }

    private static function getAgreement($created_by, $time)
    {
        return [
            [
                'router_name' => '协议列表',
                'router' => '/api/v1/system/agreement/index',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '协议保存',
                'router' => '/api/v1/system/agreement/save',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '协议详情',
                'router' => '/api/v1/system/agreement/view',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除协议',
                'router' => '/api/v1/system/agreement/delete',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private static function getComplaint($created_by, $time)
    {

        return [
            [
                'router_name' => '投诉列表',
                'router' => '/api/v1/system/complaint/index',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '投诉保存',
                'router' => '/api/v1/system/complaint/save',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '投诉详情',
                'router' => '/api/v1/system/complaint/view',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除投诉',
                'router' => '/api/v1/system/complaint/delete',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private static function getImage($created_by, $time)
    {

        return [
            [
                'router_name' => '图片列表',
                'router' => '/api/v1/system/images/index',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '图片保存',
                'router' => '/api/v1/system/images/save',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '图片详情',
                'router' => '/api/v1/system/images/view',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '图片上传',
                'router' => '/api/v1/system/images/upload',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除图片',
                'router' => '/api/v1/system/images/delete',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private static function getTag($created_by, $time)
    {
        return [
            [
                'router_name' => '标签列表',
                'router' => '/api/v1/system/tag/index',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '标签保存',
                'router' => '/api/v1/system/tag/save',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '标签详情',
                'router' => '/api/v1/system/tag/view',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除标签',
                'router' => '/api/v1/system/tag/delete',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private static function getUnit($created_by, $time)
    {
        return [
            [
                'router_name' => '单位列表',
                'router' => '/api/v1/system/unit/index',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '单位保存',
                'router' => '/api/v1/system/unit/save',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '单位详情',
                'router' => '/api/v1/system/unit/view',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除单位',
                'router' => '/api/v1/system/unit/delete',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private static function getEnterprise($created_by, $time)
    {
        return [
            [
                'router_name' => '企业列表',
                'router' => '/api/v1/system/enterprise/index',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '企业保存',
                'router' => '/api/v1/system/enterprise/save',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '企业详情',
                'router' => '/api/v1/system/enterprise/view',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除企业',
                'router' => '/api/v1/system/enterprise/delete',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private static function getConfig($created_by, $time)
    {
        return [
            [
                'router_name' => '配置列表',
                'router' => '/api/v1/system/config/index',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '配置保存',
                'router' => '/api/v1/system/config/save',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '配置详情',
                'router' => '/api/v1/system/config/view',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除配置',
                'router' => '/api/v1/system/config/delete',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private static function getNavigation($created_by, $time)
    {
        return [
            [
                'router_name' => '导航列表',
                'router' => '/api/v1/system/navigation/index',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '导航保存',
                'router' => '/api/v1/system/navigation/save',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '导航详情',
                'router' => '/api/v1/system/navigation/view',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除导航',
                'router' => '/api/v1/system/navigation/delete',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private static function getRole($created_by, $time)
    {
        return [
            [
                'router_name' => '角色列表',
                'router' => '/api/v1/system/role/index',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '角色保存',
                'router' => '/api/v1/system/role/save',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '角色详情',
                'router' => '/api/v1/system/role/view',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除角色',
                'router' => '/api/v1/system/role/delete',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private static function getManager($created_by, $time)
    {
        return [
            [
                'router_name' => '管理员列表',
                'router' => '/api/v1/system/manager/index',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '管理员保存',
                'router' => '/api/v1/system/manager/save',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '管理员详情',
                'router' => '/api/v1/system/manager/view',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '管理员信息',
                'router' => '/api/v1/system/manager/info',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除管理员',
                'router' => '/api/v1/system/manager/delete',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private static function getActionLog($created_by, $time)
    {
        return [
            [
                'router_name' => '管理员日志列表',
                'router' => '/api/v1/system/action-log/index',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除管理员日志',
                'router' => '/api/v1/system/action-log/delete',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }

    private static function getRouters($created_by, $time){
        return [
            [
                'router_name' => '管理路由列表',
                'router' => '/api/v1/system/router/index',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '保存管理路由',
                'router' => '/api/v1/system/router/save',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '删除管理路由',
                'router' => '/api/v1/system/router/delete',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'router_name' => '注册路由',
                'router' => '/api/v1/system/router/registered-route',
                'created_by' => $created_by,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ];
    }
}
