<?php

namespace App\Filters\Expenses;

use Illuminate\Database\Eloquent\Builder;

class TypeFilter
{
    public function __invoke(Builder $query, string $type): Builder
    {
        return $query->when($type !== 'all', function (Builder $query) use ($type) {
            $query->where('type', $type);
        });
    }
}
