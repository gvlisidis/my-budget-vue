<?php

namespace App\Filters\Expenses;

use Illuminate\Database\Eloquent\Builder;

class SearchFilter
{
    public function __invoke(Builder $query, string $searchTerm): Builder
    {
        return $query->when($searchTerm, function (Builder $query) use ($searchTerm) {
            $query->where('label', 'LIKE', '%' . $searchTerm . '%');
        });
    }
}
