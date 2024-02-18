<?php

namespace App\Models\System;

use App\Models\Build\SystemBuild\SystemAdminMessageBuild;
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
 * @property int admin_id
 * @property string content
 * @property int weight
 * @property int created_by
 * @property Carbon created_at
 * @property User user
 */
class SystemAdminMessage extends Model
{
    use HasFactory, SoftDeletes, CreatedRelation, UpdatedRelation, SystemAdminMessageBuild, SearchData;

    protected $table = 'system_admin_messages';

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
        'title', 'content', 'weight', 'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];


    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->admin_id)) {
            $build = $build->where('admin_id', $this->admin_id);
        }
        return $build->with($with)->orderBy('id', 'desc');
    }
}
