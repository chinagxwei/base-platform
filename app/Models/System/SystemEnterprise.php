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
 * @property string name_en
 * @property string registered_location
 * @property string registered_number
 * @property string business_registration_number
 * @property string registered_province
 * @property string registered_city
 * @property string registered_address
 * @property string registration_time
 * @property string business_province
 * @property string business_city
 * @property string business_address
 * @property string website
 * @property integer registered_category
 * @property string cir_certificate
 * @property string br_certificate
 * @property string equity_structure
 * @property integer annual_turnover
 * @property string contacts
 * @property string telephone
 * @property string introduce
 * @property string logo
 * @property string remark
 * @property int status
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
        'name', 'name_en', 'registered_location', 'registered_number', 'business_registration_number', 'registered_province',
        'registered_city', 'registered_address', 'registration_time', 'business_province', 'business_city', 'business_address',
        'website', 'registered_category', 'cir_certificate', 'br_certificate', 'equity_structure', 'annual_turnover', 'remark',
        'contacts', 'telephone', 'introduce', 'logo', 'status',
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
