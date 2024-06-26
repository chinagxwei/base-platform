<?php

namespace App\Models\System;

use App\Models\Build\SystemBuild\SystemAdminBuild;
use App\Models\Trait\CreatedRelation;
use App\Models\Trait\SearchData;
use App\Models\Trait\SystemRoleRelation;
use App\Models\Trait\UpdatedRelation;
use App\Models\User;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property string id
 * @property int role_id
 * @property string nickname
 * @property string mobile
 * @property string remark
 * @property int created_by
 * @property Carbon created_at
 * @property User user
 * @property SystemRole role
 */
class SystemAdmin extends Model
{
    use HasFactory, SoftDeletes, Uuids, SystemAdminBuild, SystemRoleRelation, SearchData, CreatedRelation, UpdatedRelation;

    protected $table = 'system_admins';

    protected $keyType = 'string';

    protected $fillable = [
        'role_id', 'enterprise_id', 'nickname', 'mobile', 'remark', 'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    /**
     * 指定是否模型应该被戳记时间。
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * 模型日期列的存储格式
     *
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        return $this->hasOne(SystemRole::class, 'id', 'role_id');
    }

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->role_id)) {
            $build = $build->where('role_id', $this->role_id);
        }
        return $build->with($with)->orderBy('id', 'desc');
    }
}
