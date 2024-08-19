<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laratrust\Traits\HasRolesAndPermissions;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes;
    use HasRolesAndPermissions;

    protected $table = 'admins';

    protected $guarded = [];
}
