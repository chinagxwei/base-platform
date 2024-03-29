<?php

namespace App\Models\Member;

use App\Models\Trait\CreatedRelation;
use App\Models\Trait\SearchData;
use App\Models\Trait\UpdatedRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int id
 * @property string member_id
 * @property string openid
 * @property string unionid
 * @property string nickname
 * @property int sex
 * @property string city
 * @property string province
 * @property string country
 * @property string headimgurl
 * @property int created_by
 * @property int updated_by
 * @property Carbon created_at
 */
class MemberWechatMiniprogramAccount extends Model
{
    use HasFactory, SoftDeletes, CreatedRelation, UpdatedRelation, SearchData;

    protected $table = 'member_wechat_miniprogram_accounts';
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
        'member_id', 'openid', 'unionid',
        'nickname', 'sex', 'city',
        'province', 'country', 'headimgurl',
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

        if (!empty($this->member_id)) {
            $build = $build->where('member_id', $this->member_id);
        }

        if (!empty($this->nickname)) {
            $build = $build->where('nickname', 'like', "%{$this->nickname}%");
        }

        if (isset($this->sex)) {
            $build = $build->where('sex', $this->sex);
        }

        if (!empty($this->city)) {
            $build = $build->where('city', 'like', "%{$this->city}%");
        }

        if (!empty($this->province)) {
            $build = $build->where('province', 'like', "%{$this->province}%");
        }

        if (!empty($this->country)) {
            $build = $build->where('country', 'like', "%{$this->country}%");
        }

        return $build->with($with)->orderBy('created_by', 'desc');
    }
}
