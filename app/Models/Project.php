<?php

namespace App\Models;

use App\Enums\DateEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $table = 'projects';

    protected $guarded = [];

    protected array $dates = ['deleted_at'];

    public function statusName()
    {
       return $this->status()?->whereType(StatusEnum::status->value)->first()->name;
    }

    public function dealStatusName()
    {
        return $this->dealStatus()?->whereType(StatusEnum::deal->value)->first()->name;
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

}
