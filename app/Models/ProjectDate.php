<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectDate extends Model
{
    use SoftDeletes;

    protected $table = 'project_dates';
    protected $guarded = [];
    protected array $dates = ['deleted_at'];
    protected $fillable=[
        'project_id',
        'start_date',
        'end_date',
        'type',
    ];

}
