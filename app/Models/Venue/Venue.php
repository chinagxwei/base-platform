<?php

namespace App\Models\Venue;

use App\Models\Trait\CreatedRelation;
use App\Models\Trait\SearchData;
use App\Models\Trait\UpdatedRelation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int id
 * @property string title
 * @property string address
 * @property string order_income_config_id
 * @property int created_by
 * @property Carbon created_at
 * @property User user
 */
class Venue extends Model
{
    use HasFactory, SoftDeletes, CreatedRelation, UpdatedRelation, SearchData;

    protected $table = 'venues';

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
        'title', 'address', 'order_income_config_id', 'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->title)) {
            $build = $build->where('title', 'like', "%{$this->title}%");
        }

        if (!empty($this->address)) {
            $build = $build->where('address', 'like', "%{$this->address}%");
        }

        return $build->with($with)->orderBy('id', 'desc');
    }
}
