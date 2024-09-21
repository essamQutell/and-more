<?php

namespace App\Models;

use App\Enums\AttachmentEnum;
use App\Enums\ItemEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PettyCashCategory extends Model
{
    use softDeletes;
    protected $table = 'petty_cash_categories';
    protected $guarded = [];


    protected $casts = [
        'item' => ItemEnum::class,
        'attachment' => AttachmentEnum::class,
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function pettyCash(): BelongsTo
    {
        return $this->belongsTo(PettyCash::class, 'petty_cash_id');
    }
}
