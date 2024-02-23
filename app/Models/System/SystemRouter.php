<?php

namespace App\Models\System;

use App\Models\Trait\CreatedRelation;
use App\Models\Trait\SearchData;
use App\Models\Trait\UpdatedRelation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property string router_name
 * @property string router
 * @property int created_by
 * @property Carbon created_at
 */
class SystemRouter extends Model
{
    use HasFactory, SoftDeletes, CreatedRelation, UpdatedRelation, SearchData;

    public const USER_ROUTER_KEY = "user_system_routers";

    protected $table = 'system_routers';

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
        'router_name', 'router', 'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getAll(){
        return self::query()->select(['router'])->get();
    }

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->router_name)) {
            $build = $build->where('router_name', 'like', "%{$this->router_name}%");
        }
        if (!empty($this->router)) {
            $build = $build->where('router', 'like', "%{$this->router}%");
        }

        return $build->with($with)->orderBy('id', 'desc');
    }
}
