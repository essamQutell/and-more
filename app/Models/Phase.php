<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Phase extends Model
{
    use SoftDeletes;

    protected $table = 'phases';

    protected $guarded = [];

    protected $with = ['phases'];

    protected array $dates = ['deleted_at'];

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->{'name_'.app()->getLocale()}
        );
    }

    public function phase(): BelongsTo
    {
        return $this->belongsTo(Phase::class, 'parent_id');
    }

    public function phases(): HasMany
    {
        return $this->hasMany(Phase::class, 'parent_id');
    }
}
