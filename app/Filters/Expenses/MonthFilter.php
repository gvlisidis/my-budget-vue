<?php

namespace App\Filters\Expenses;

use Illuminate\Database\Eloquent\Builder;

class MonthFilter
{
    public function __invoke(Builder $query, int $month): Builder
    {
        return $query->when($month < 13, function (Builder $query) use ($month) {
            $query->whereMonth('issued_at', $month);
        });
    }
}
