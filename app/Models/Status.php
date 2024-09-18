<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'statuses';
    protected $guarded = [];
    protected array $dates = ['deleted_at'];
    protected $fillable = ['name_en', 'name_ar', 'type_id'];

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->{'name_'.app()->getLocale()}
        );
    }

    protected $casts = [
        'type_id' => StatusEnum::class
    ];


}
