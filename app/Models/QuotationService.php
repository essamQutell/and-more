<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuotationService extends Model
{
    protected $table = 'quotation_services';
    protected $guarded = [];
    protected array $dates = ['deleted_at'];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }
}
