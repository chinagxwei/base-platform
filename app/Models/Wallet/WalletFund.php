<?php

namespace App\Models\Wallet;

use App\Models\BaseDataModel;
use App\Models\Order\Order;
use App\Models\Trait\CreatedRelation;
use App\Models\Trait\OrderRelation;
use App\Models\Trait\SearchData;
use App\Models\Trait\SignData;
use App\Models\Trait\UnitRelation;
use App\Models\Trait\UpdatedRelation;
use App\Models\Trait\WalletRelation;
use Carbon\Carbon;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string id
 * @property string order_sn
 * @property string wallet_id
 * @property int denomination
 * @property int balance
 * @property int unit_id
 * @property int frozen
 * @property string sign
 * @property int created_by
 * @property int updated_by
 * @property Carbon created_at
 */
class WalletFund extends BaseDataModel
{
    use HasFactory, SoftDeletes, Uuids, CreatedRelation, UpdatedRelation, UnitRelation, OrderRelation, WalletRelation, SignData, SearchData;

    protected $table = 'wallet_funds';

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
        'wallet_id', 'order_sn', 'denomination',
        'balance', 'unit_id', 'frozen', 'sign',
        'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    /**
     * @param $wallet_id
     * @param $order_sn
     * @param $denomination
     * @param $unit_id
     * @param int $gift
     * @param int $channel
     * @return static|null
     */
    public static function generate($wallet_id, $order_sn, $denomination, $unit_id, $gift = self::DISABLE, $channel = self::CHANNEL_MEMBER)
    {
        $model = new static();
        $model->wallet_id = $wallet_id;
        $model->order_sn = $order_sn;
        $model->denomination = $denomination;
        $model->balance = $denomination;
        $model->unit_id = $unit_id;
        $model->frozen = 0;
        $model->setSign();
        return $model->save() ? $model : null;
    }

    /**
     * @param $wallet_id
     * @param $unit_id
     * @param bool $hasFrozen
     * @param bool $hasGift
     * @return int|mixed
     */
    public static function getTotalBalance($wallet_id, $unit_id, $hasFrozen = false, $hasGift = true)
    {
        $query = self::query()
            ->where('wallet_id', $wallet_id)
            ->where('unit_id', $unit_id);

        if (!$hasGift) {
            $query = $query->where('gift', 0);
        }

        if (!$hasFrozen) {
            $query = $query->where(function ($q) {
                $q->orWhere('frozen', 0)->orWhereNull('frozen');
            });
        }

        return $query->sum('balance');
    }

    function setSign()
    {
        // TODO: Implement setSign() method.
        $raw = [
            $this->wallet_id ?? 0,
            $this->order_sn ?? '',
            $this->denomination ?? 0,
            $this->unit_id ?? 0,
        ];

        $this->sign = sha1(join('_', $raw));
    }

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;

        if (!empty($this->wallet_id)) {
            $build = $build->where('wallet_id', $this->wallet_id);
        }
        if (!empty($this->unit_id)) {
            $build = $build->where('unit_id', $this->unit_id);
        }

        if (!empty($this->order_sn)) {
            $build = $build->where('order_sn', 'like', "%{$this->order_sn}%");
        }

        return $build->with($with)->orderBy('id', 'desc');
    }
}
