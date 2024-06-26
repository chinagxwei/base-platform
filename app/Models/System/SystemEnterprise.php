<?php

namespace App\Models\System;

use App\Models\Trait\CreatedRelation;
use App\Models\Trait\SearchData;
use App\Models\Trait\UpdatedRelation;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SystemEnterprise extends Model
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

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
    }
}
