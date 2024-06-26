<?php

namespace App\Models\Trait;

use App\Models\System\SystemEnterprise;

/**
 * @property int enterprise_id
 * @property SystemEnterprise member
 */
trait EnterpriseRelation
{
    public function setEnterprise($enterprise_id)
    {
        $this->enterprise_id = $enterprise_id;
        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function enterprise()
    {
        return $this->hasOne(SystemEnterprise::class, 'id', 'enterprise_id');
    }
}
