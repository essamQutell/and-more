<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExtraWork extends Model
{
    protected $table = 'extra_works';

    protected $guarded = [];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class, 'quotation_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }



}
