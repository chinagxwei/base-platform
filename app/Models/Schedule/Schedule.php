<?php

namespace App\Models\Schedule;

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
 * @property int year
 * @property int started_weeks
 * @property int ended_weeks
 * @property int started_at
 * @property int ended_at
 * @property string remark
 * @property int loop
 * @property int tips
 * @property int openness
 * @property int gmt
 * @property double latitude
 * @property double longitude
 * @property int created_by
 * @property Carbon created_at
 * @property User user
 */
class Schedule extends Model
{
    use HasFactory, SoftDeletes, CreatedRelation, UpdatedRelation, SearchData;

    protected $table = 'schedules';

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
        'title', 'year', 'started_weeks', 'ended_weeks',
        'started_at', 'ended_at', 'remark', 'loop', 'tips',
        'openness', 'gmt', 'latitude', 'longitude',
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
        if (!empty($this->title)) {
            $build = $build->where('title', 'like', "%{$this->title}%");
        }

        return $build->with($with)->orderBy('id', 'desc');
    }
}
