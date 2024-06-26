<?php

namespace App\Models\System;

use App\Models\Trait\CreatedRelation;
use App\Models\Trait\EnterpriseRelation;
use App\Models\Trait\SearchData;
use App\Models\Trait\SystemRoleRelation;
use App\Models\Trait\UpdatedRelation;
use App\Models\Trait\WalletRelation;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string id
 * @property string wallet_id
 * @property int role_id
 * @property string enterprise_id
 * @property string nickname
 * @property string mobile
 * @property string avatar
 * @property string remark
 * @property int created_by
 * @property int updated_by
 * @property \Illuminate\Support\Carbon created_at
 * @property SystemWallet wallet
 * @property SystemEnterprise enterprise
 * @property SystemRole role
 */
class SystemMember extends Model
{
    use HasFactory, SoftDeletes, Uuids, SearchData, CreatedRelation, UpdatedRelation,
        SystemRoleRelation, WalletRelation, EnterpriseRelation;

    protected $table = 'system_members';

    protected $keyType = 'string';

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

    protected $fillable = [
        'wallet_id', 'role_id', 'enterprise_id', 'nickname',
        'avatar', 'mobile', 'remark',
        'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->wallet_id)) {
            $build = $build->where('wallet_id', $this->wallet_id);
        }

        if (!empty($this->mobile)) {
            $build = $build->where('mobile', 'like', "%{$this->mobile}%");
        }

        return $build->with($with)->orderBy('created_by', 'desc');
    }

    /**
     * @param $user_id
     * @param $with
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null|static
     */
    public static function findOneByUser($user_id, $with = [])
    {
        return self::query()->where('created_by', $user_id)->with($with)->first();
    }
}
