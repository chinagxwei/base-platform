<?php

namespace App\Models\System;

use App\Models\BaseDataModel;
use App\Models\Trait\CreatedRelation;
use App\Models\Trait\SearchData;
use App\Models\Trait\SignData;
use App\Models\Trait\UpdatedRelation;
use Carbon\Carbon;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string id
 * @property int level
 * @property string sign
 * @property int created_by
 * @property int updated_by
 * @property Carbon created_at
 */
class SystemWallet extends BaseDataModel
{
    use HasFactory, SoftDeletes, Uuids, CreatedRelation, UpdatedRelation, SearchData, SignData;

    protected $table = 'system_wallets';

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
        'total_balance', 'level'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    /**
     * @param $total_balance
     * @return $this
     */
    public function setTotalBalance($total_balance)
    {
        $this->total_balance = $total_balance;
        $this->setSign();
        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null|static
     */
    public static function lastOne()
    {
        return self::query()->whereNotExists(function ($query) {
            $query->from('members')
                ->whereRaw('hc_members.wallet_id = hc_wallets.id');
        })->lock()->first();
    }

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;

        return $build->with($with)->orderBy('created_by', 'desc');
    }

    /**
     * @return static|null
     */
    public static function generate()
    {
        $model = new static();
        $model->level = 0;
        $model->setSign();
        return $model->save() ? $model : null;
    }

    function setSign()
    {
        // TODO: Implement setSign() method.
        $raw = [
            $this->total_balance ?? '',
            $this->level ?? '',
            $this->created_by ?? '',
        ];

        $this->sign = sha1(join('_', $raw));
    }
}
