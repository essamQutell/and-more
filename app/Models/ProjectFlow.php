<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectFlow extends Model
{
    protected $table = 'project_flows';

    protected $guarded = [];
    protected $fillable = ['project_id', 'phase_id'];



    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function phase(): BelongsTo
    {
        return $this->belongsTo(Phase::class, 'phase_id');
    }
}
