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

    public function projectAdmin():BelongsTo
    {
        return $this->belongsTo(ProjectAdmin::class, 'project_admin_id');
    }

    public function status():BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function supplier():BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public  function supplierTeam():BelongsTo
    {
        return $this->belongsTo(SupplierTeam::class, 'supplier_team_id');
    }

    public function dealStatus():BelongsTo
    {
        return $this->belongsTo(Status::class, 'deal_status_id');
    }


}
