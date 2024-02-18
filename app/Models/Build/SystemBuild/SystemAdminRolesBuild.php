<?php

namespace App\Models\Build\SystemBuild;

trait SystemAdminRolesBuild
{
    public function setRoleName(string $role_name): void
    {
        $this->role_name = $role_name;
    }
}
