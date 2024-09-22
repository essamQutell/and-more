<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuotationDeal extends Model
{
    protected $table = 'quotation_deals';
    protected $guarded = [];


    protected $casts = [
        'progress_id' => QuotationStatus::class
    ];
}
