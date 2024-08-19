<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectAdmin extends Model
{
    use SoftDeletes;

    protected $table = 'project_admins';
    protected $guarded = [];
    protected array $dates = ['deleted_at'];
}
