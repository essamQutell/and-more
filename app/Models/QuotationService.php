<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationService extends Model
{
    protected $table = 'quotation_services';
    protected $guarded = [];
    protected array $dates = ['deleted_at'];
}
