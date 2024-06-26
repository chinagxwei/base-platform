<?php

namespace App\Models\Trait;


use App\Models\System\SystemRole;

/**
 * @property int role_id
 * @property SystemRole systemRole
 */
trait SystemRoleRelation
{
    public function setAdminRole($role_id){
        $this->role_id = $role_id;
        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function systemRole()
    {
        return $this->hasOne(SystemRole::class, 'id', 'role_id');
    }
}
