<?php

namespace App\Models;

use App\Enums\ProgressEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuotationDeal extends Model
{
    protected $table = 'quotation_deals';
    protected $guarded = [];

    protected $casts = [
        'progress_id' => ProgressEnum::class
    ];

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class, 'quotation_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }


}
