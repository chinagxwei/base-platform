<?php

namespace App\Models\System;

use App\Models\Build\SystemBuild\SystemAdminRolesBuild;
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
 * @property string role_name
 * @property int created_by
 * @property Carbon created_at
 * @property User user
 * @property SystemAdminNavigation[]|Collection navigations
 */
class SystemAdminRole extends Model
{
    use HasFactory, SoftDeletes, SystemAdminRolesBuild, CreatedRelation, UpdatedRelation, SearchData;

    protected $table = 'system_admin_roles';

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
        'role_name', 'created_by', 'updated_by'
    ];

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function navigations()
    {
        return $this->belongsToMany(
            SystemAdminNavigation::class,
            'admin_role_menus',
            'role_id',
            'navigation_id'
        )->with(['children'])->orderBy('navigation_sort');
    }

    function searchBuild($param = [], $with = [])
    {
        // TODO: Implement searchBuild() method.
        $this->fill($param);
        $build = $this;
        if (!empty($this->role_name)) {
            $build = $build->where('role_name', 'like', "%{$this->role_name}%");
        }
        return $build->with($with)->orderBy('id', 'desc');
    }

    /**
     * @param $role_name
     * @param null $created_by
     * @return static|null
     */
    public static function generate($role_name, $created_by = null)
    {
        $model = new static();
        $model->role_name = $role_name;
        $model->created_by = $created_by;
        return $model->save() ? $model : null;
    }
}
