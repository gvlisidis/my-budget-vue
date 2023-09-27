<?php

namespace App\Filters\Expenses;

use Illuminate\Support\Arr;

class ExpenseFilters
{
    protected array $filters = [
        'month' => MonthFilter::class,
        'year' => YearFilter::class,
        'searchTerm' => SearchFilter::class,
        'type' => TypeFilter::class,
        'category' => CategoryFilter::class,
        'sortBy' => SortFilter::class,
    ];

    public function apply($query)
    {
        foreach ($this->receivedFilters() as $name => $value) {
            $filterInstance = new $this->filters[$name];
            $query = $filterInstance($query, $value);
        }

        return $query;
    }
    private function receivedFilters()
    {
        return Arr::whereNotNull(request()->only(array_keys($this->filters)));
    }
}
