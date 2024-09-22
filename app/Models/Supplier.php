<?php

namespace App\Models;

use App\Traits\FilterableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;
    use FilterableTrait;
    use HasFactory;

    protected $table = 'suppliers';
    protected $fillable=[ 'name', 'email', 'phone', 'address', 'balance'];
    protected $guarded = [];
    protected array $dates = ['deleted_at'];

    public function projects(): HasManyThrough
    {
        return $this->hasManyThrough(Project::class, ProjectSupplier::class, 'supplier_id', 'id');
    }
}
