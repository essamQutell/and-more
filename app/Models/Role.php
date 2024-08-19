<?php

namespace App\Models;

use Laratrust\Models\Role as RoleModel;

class Role extends RoleModel
{
    public $guarded = [];

    public function scopeWithoutRoleSuperAdmin($query)
    {
        return $query->where('name', '!=', 'super_admin');
    }
}
