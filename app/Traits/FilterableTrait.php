<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait FilterableTrait
{
    public function filterableColumns(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->filterableColumns
        );
    }
        public function scopeFilter(Builder $query, Request $request, array $filterableColumns): Builder
        {
            // Get all parameters from the request, excluding pagination parameters
            $filters = $request->except(['page_count']);

            foreach ($filterableColumns as $filter) {
                $columns = $filter['columns']?? null;
                $type = $filter['type'] ?? null;
                $searchKey = $filter['search_key'] ?? null;
                $startKey = $filter['start_key'] ?? null;
                $endKey = $filter['end_key'] ?? null;

                if ($type === 'range' && $startKey && $endKey) {
                    // Handle date range filtering
                    $startDate = $filters[$startKey] ?? null;
                    $endDate = $filters[$endKey] ?? null;

                    if ($startDate || $endDate) {
                        $query->where(function ($q) use ($columns, $startDate, $endDate) {
                            if ($startDate) {
                                $q->where($columns, '>=', $startDate);
                            }
                            if ($endDate) {
                                $q->where($columns, '<=', $endDate);
                            }
                        });
                    }
                } elseif ($searchKey && array_key_exists($searchKey, $filters) && $filters[$searchKey]) {
                    $searchValue = $filters[$searchKey];
                    $query->where(function ($q) use ($columns, $searchValue) {
                        if (is_array($columns)) {
                            foreach ($columns as $column) {
                                if (str_contains($column, '.')) {
                                    [$relation, $relationColumn] = explode('.', $column);
                                    $q->orWhereHas($relation, function ($relQuery) use ($relationColumn, $searchValue) {
                                        $relQuery->where($relationColumn, 'LIKE', "%{$searchValue}%");
                                    });
                                } else {
                                    $q->orWhere($column, 'LIKE', "%{$searchValue}%");
                                }
                            }
                        }
                    });
                } elseif (is_array($columns)) {
                    // Handle 'like' type for multiple columns
                    foreach ($columns as $column) {
                        if (array_key_exists($column, $filters) && $filters[$column]) {
                            $query->where(function ($q) use ($filters, $column) {
                                $q->where($column, 'LIKE', "%{$filters[$column]}%");
                            });
                        }
                    }
                } elseif (is_string($columns)) {
                    // Handle single column filters
                    if (array_key_exists($columns, $filters) && $filters[$columns]) {
                        $query->when(true, function ($q) use ($filters, $columns, $type) {
                            if ($type === 'like') {
                                $q->where($columns, 'LIKE', "%{$filters[$columns]}%");
                            } elseif ($type === 'equals') {
                                $q->where($columns, $filters[$columns]);
                            } elseif ($type === 'relation') {
                                $relationSingular = Str::singular(str_replace('_id', '', $columns));
                                $relationPlural = Str::plural($relationSingular);

                                $q->where(function ($q) use ($filters, $columns, $relationSingular, $relationPlural) {
                                    $q->whereHas($relationSingular, function ($relQuery) use ($filters, $columns) {
                                        $relQuery->where($columns, '=', $filters[$columns]);
                                    })->orWhereHas($relationPlural, function ($relQuery) use ($filters, $columns) {
                                        $relQuery->where($columns, '=', $filters[$columns]);
                                    });
                                });
                            }
                        });
                    }
                }
            }

            return $query;
        }

}
