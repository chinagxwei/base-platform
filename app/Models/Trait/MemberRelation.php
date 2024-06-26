<?php

namespace App\Models\Trait;

use App\Models\System\SystemMember;

/**
 * @property int member_id
 * @property SystemMember member
 */
trait MemberRelation
{
    public function setMember($member_id)
    {
        $this->member_id = $member_id;
        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function member()
    {
        return $this->hasOne(SystemMember::class, 'id', 'member_id');
    }
}
