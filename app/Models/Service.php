<?php

namespace App\Models;

use App\Services\CalculateCostService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    use HasFactory;

    private CalculateCostService $calculateCostService;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->calculateCostService = new CalculateCostService();
    }

    protected $table = 'services';

    protected $guarded = [];

    protected array $dates = ['deleted_at'];

    protected $with = ['services'];

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->{'name_' . app()->getLocale()}
        );
    }

    public function calculateMainServiceCost(): float|int
    {
        return $this->service?->services()->whereHas('quotationServices')->with('quotationServices')->get()->sum(
            function ($subService) {
                return $subService->quotationServices->sum('cost');
            }
        );
    }

    public function calculateMainServiceSales(): float|int
    {
        return $this->service?->services()->whereHas('quotationServices')->with('quotationServices')->get()->sum(
            function ($subService) {
                return $this->calculateCostService->calculateTotalSales(
                    $subService->quotationServices->sum('price'),
                    $subService->quotationServices->sum('margin'),
                    $subService->quotationServices->sum('quantity'),
                    $subService->quotationServices->sum('days')
                );
            }
        );
    }

    public function calculateMainServiceProfit(): float|int
    {
        return $this->calculateCostService->calculateMargin(
            $this->calculateMainServiceSales(),
            $this->calculateMainServiceCost()
        );
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'parent_id');
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'parent_id');
    }

    public function quotationServices(): HasMany
    {
        return $this->hasMany(QuotationService::class);
    }

    public function quotationDeals(): HasMany
    {
        return $this->hasMany(QuotationDeal::class);
    }


}
