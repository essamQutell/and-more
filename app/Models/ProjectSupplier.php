<?php

namespace App\Models;

use App\Enums\ApprovalsEnum;
use App\Enums\AttachmentEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectSupplier extends Model
{

    protected $table = 'project_suppliers';
    protected $guarded = [];

    protected $casts = [
        'approvals' => ApprovalsEnum::class,
        'attachment_id' => AttachmentEnum::class,
    ];


    public function project():BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
    public function quotation():BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }

    public function supplier():BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function team():BelongsTo
    {
        return $this->belongsTo(ProjectAdmin::class,'project_team_id');
    }
}
