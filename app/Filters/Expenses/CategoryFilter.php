<?php

namespace App\Filters\Expenses;

use Illuminate\Database\Eloquent\Builder;

class CategoryFilter
{
    public function __invoke(Builder $query, string $category): Builder
    {
        return $query->when($category !== 'all', function (Builder $query) use ($category) {
            $query->where('category_id', $category);
        });
    }
}
