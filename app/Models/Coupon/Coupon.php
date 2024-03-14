<?php

namespace App\Models\Coupon;

use App\Models\Trait\CreatedRelation;
use App\Models\Trait\SearchData;
use App\Models\Trait\SignData;
use App\Models\Trait\UpdatedRelation;
use App\Models\User;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int id
 * @property string title
 * @property int created_by
 * @property Carbon created_at
 * @property User user
 */
class Coupon extends Model
{
    use HasFactory, SoftDeletes, Uuids, CreatedRelation, UpdatedRelation, SearchData, SignData;

    protected $table = 'coupons';

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
        'title', 'day', 'price', 'unit_id', 'show', 'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
    }

    function setSign()
    {
        // TODO: Implement setSign() method.
    }
}
