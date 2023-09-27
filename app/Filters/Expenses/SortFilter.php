<?php

namespace App\Filters\Expenses;

use Illuminate\Database\Eloquent\Builder;

class SortFilter
{
    public function __invoke(Builder $query, string $sortBy): Builder
    {
        return $query->when($sortBy, function (Builder $query) {
            $query->orderByDesc('amount');
        });
    }
}
