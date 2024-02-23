<?php

namespace App\Models\System;

use App\Models\BaseDataModel;
use App\Models\Build\SystemBuild\SystemAgreementBuild;
use App\Models\Trait\CreatedRelation;
use App\Models\Trait\SearchData;
use App\Models\Trait\UpdatedRelation;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int id
 * @property string title
 * @property string content
 * @property int type
 * @property int show
 * @property int created_by
 * @property Carbon created_at
 */
class SystemAgreement extends BaseDataModel
{
    use HasFactory, SoftDeletes, Uuids, CreatedRelation, UpdatedRelation, SystemAgreementBuild, SearchData;

    protected $table = 'system_agreements';

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
        'title', 'content', 'type', 'show', 'created_by', 'updated_by'
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
        if (!empty($this->content)) {
            $build = $build->where('content', 'like', "%{$this->content}%");
        }
        if (!empty($this->type)) {
            $build = $build->where('type', $this->type);
        }
        if (isset($this->show)) {
            $build = $build->where('show', $this->show);
        }
        return $build->with($with)->orderBy('id', 'desc');
    }
}
