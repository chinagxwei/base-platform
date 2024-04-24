<?php

namespace App\Models\System;

use App\Models\BaseDataModel;
use App\Models\Trait\CreatedRelation;
use App\Models\Trait\SearchData;
use App\Models\Trait\UpdatedRelation;
use Carbon\Carbon;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string id
 * @property string name
 * @property string main_projects
 * @property string contacts
 * @property string telephone
 * @property string introduce
 * @property string logo
 * @property int created_by
 * @property int updated_by
 * @property Carbon created_at
 */
class SystemEnterprise extends BaseDataModel
{
    use HasFactory, SoftDeletes, Uuids, SearchData, CreatedRelation, UpdatedRelation;

    protected $table = 'system_enterprise';

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
        'name', 'main_projects',
        'contacts', 'telephone', 'introduce', 'logo',
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

        if (!empty($this->name)) {
            $build = $build->where('title', 'like', "%{$this->name}%");
        }

        return $build->with($with);
    }
}
