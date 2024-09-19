<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PettyCash extends Model
{
    protected $table = 'petty_cashes';

    protected $fillable = [
        'project_id',
        'total_cost',
        'remaining',
        'expenses'
    ];


    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }


}

