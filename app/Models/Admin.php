<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\HasRolesAndPermissions;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes;
    use HasRolesAndPermissions;
    use HasApiTokens;
    use Notifiable;

    protected $table = 'admins';

    protected $guarded = [];

    protected array $dates = ['deleted_at'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'status' => StatusEnum::class,
    ];

    public function scopeWithoutSuperAdmin($query)
    {
        return $query->whereHas('roles', function ($query) {
            $query->where('name', '!=', 'super_admin');
        });
    }

    public function scopeByRole($query, $role_id)
    {
        return $query->whereHas('roles', function ($q) use ($role_id) {
            $q->where('role_id', '=', $role_id);
        });
    }
}
