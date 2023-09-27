<?php

namespace App\Filters\Expenses;

use Illuminate\Database\Eloquent\Builder;

class YearFilter
{
    public function __invoke(Builder $query, int $year): Builder
    {
        return $query->whereYear('issued_at', $year);
    }
}
