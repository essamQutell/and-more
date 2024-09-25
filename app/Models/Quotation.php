<?php

namespace App\Models;

use App\Enums\QuotationStatusEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use SoftDeletes;

    protected $table = 'quotations';
    protected $guarded = [];
    protected array $dates = ['deleted_at'];

    protected $with =['project'];

    protected $casts = [
        'status_id' => QuotationStatusEnum::class
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function quotationServices(): HasMany
    {
        return $this->hasMany(QuotationService::class);
    }
}
