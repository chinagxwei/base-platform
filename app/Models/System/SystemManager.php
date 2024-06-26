<?php

namespace App\Models\System;

use App\Models\Trait\CreatedRelation;
use App\Models\Trait\EnterpriseRelation;
use App\Models\Trait\SearchData;
use App\Models\Trait\SystemRoleRelation;
use App\Models\Trait\UpdatedRelation;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string id
 * @property int role_id
 * @property string enterprise_id
 * @property string nickname
 * @property string mobile
 * @property string avatar
 * @property string remark
 * @property int created_by
 * @property int updated_by
 * @property \Illuminate\Support\Carbon created_at
 * @property SystemEnterprise enterprise
 * @property SystemRole role
 */
class SystemManager extends Model
{
    use HasFactory, SoftDeletes, Uuids, SearchData, CreatedRelation,
        UpdatedRelation, SystemRoleRelation, EnterpriseRelation;

    protected $table = 'system_managers';

    /**
     * 指定是否模型应该被戳记时间。
     *
     * @var bool
     */
    public $timestamps = true;

    protected $keyType = 'string';

    /**
     * 模型日期列的存储格式
     *
     * @var string
     */
    protected $dateFormat = 'U';

    protected $fillable = [
        'role_id', 'nickname',
        'avatar', 'mobile', 'remark',
        'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
    }
}
