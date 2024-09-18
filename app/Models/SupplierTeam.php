<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupplierTeam extends Model
{
    use HasFactory;

    protected $table = 'supplier_teams';
    protected $guarded = [];
    protected $fillable = ['name', 'email', 'phone', 'supplier_id'];


    public function supplier():BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
