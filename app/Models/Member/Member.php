<?php

namespace App\Models\Member;

use App\Models\Order\OrderRevenuesConfig;
use App\Models\Trait\CreatedRelation;
use App\Models\Trait\SearchData;
use App\Models\Trait\UpdatedRelation;
use App\Models\Trait\WalletRelation;
use App\Models\Wallet\Wallet;
use Carbon\Carbon;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * @property string id
 * @property string wallet_id
 * @property string enterprise_id
 * @property int order_revenue_config_id
 * @property string nickname
 * @property string mobile
 * @property string avatar
 * @property string remark
 * @property int develop
 * @property int promotion_sn
 * @property int node_level
 * @property string parent_id
 * @property string belong_agent_node
 * @property int register_type
 * @property int created_by
 * @property int updated_by
 * @property Carbon created_at
 * @property OrderRevenuesConfig orderRevenuesConfig
 * @property Wallet wallet
 * @property Member parent
 * @property MemberAddress addresses
 */
class Member extends Model
{
    use HasFactory, SoftDeletes, Uuids, SearchData, WalletRelation, CreatedRelation, UpdatedRelation;

    protected $table = 'members';

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
        'wallet_id', 'order_income_config_id', 'nickname',
        'avatar', 'mobile', 'remark', 'develop',
        'promotion_sn', 'parent_id', 'belong_agent_node',
        'register_type', 'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function orderRevenuesConfig()
    {
        return $this->hasOne(OrderRevenuesConfig::class, "id", "order_revenue_config_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wallet()
    {
        return $this->hasOne(Wallet::class, "id", "wallet_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne(Member::class, "id", "parent_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany(MemberAddress::class, "member_id", "id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function banInfo()
    {
        return $this->hasOne(MemberBan::class, "member_id", "id")
            ->where('started_at', '<', time())
            ->where('ended_at', '>', time());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vipInfo()
    {
        return $this->hasOne(MemberVIP::class, "member_id", "id")
            ->where('started_at', '<=', time())
            ->where('ended_at', '>=', time());
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

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->wallet_id)) {
            $build = $build->where('wallet_id', $this->wallet_id);
        }

        if (!empty($this->promotion_sn)) {
            $build = $build->where('promotion_sn', 'like', "%{$this->promotion_sn}%");
        }

        if (!empty($this->mobile)) {
            $build = $build->where('mobile', 'like', "%{$this->mobile}%");
        }

        if (isset($this->develop)) {
            $build = $build->where('develop', $this->develop);
        }

        if (isset($this->register_type)) {
            $build = $build->where('register_type', $this->register_type);
        }

        return $build->with($with)->orderBy('created_by', 'desc');
    }
}
