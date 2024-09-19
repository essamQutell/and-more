<?php

namespace App\Models;

use App\Enums\DateEnum;
use App\Enums\ProjectType;
use App\Enums\StatusEnum;
use App\Http\Resources\RoleAdminResource;
use App\Http\Resources\RoleResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $table = 'projects';

    protected $guarded = [];

    protected array $dates = ['deleted_at'];
    protected $fillable = ['name', 'description', 'type_id', 'user_id', 'status_id', 'deal_status_id'];

    protected $casts = [
        'type_id' => ProjectType::class
    ];

    public function statusName()
    {
       return $this->status()?->whereTypeId(StatusEnum::status->value)->first()?->name;
    }

    public function dealStatusName()
    {
        return $this->dealStatus()?->whereTypeId(StatusEnum::deal->value)->first()?->name;
    }

    public function projectDates($type)
    {
        return $this->dates()?->whereType($type)->first();
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function dealStatus(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'deal_status_id');
    }

    public function admins(): BelongsToMany
    {
        return $this->belongsToMany(Admin::class, 'project_admins', 'project_id', 'admin_id');
    }

    public function dates(): HasMany
    {
        return $this->hasMany(ProjectDate::class, 'project_id');
    }

    public function quotation(): HasOne
    {
        return $this->hasOne(Quotation::class, 'project_id');
    }

}
