<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    protected $with = ['roles'];

    protected array $dates = ['deleted_at'];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'status' => StatusEnum::class,
    ];

    public function role()
    {
        return $this->roles()->first();
    }

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

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_admins', 'admin_id', 'project_id');
    }
}
