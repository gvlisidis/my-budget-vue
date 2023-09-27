<?php

namespace App\Services;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Builder;

class ExpenseService
{
    public array $data;
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    private function getTotal(int $type): int
    {
        return Expense::query()
            ->when($this->data['month'] < 13, function (Builder $query) {
                $query->whereMonth('issued_at', $this->data['month']);
            })
            ->whereYear('issued_at', $this->data['year'])
            ->where('type', $type)
            ->sum('amount');
    }

    final public function results(): array
    {
        $totalMonthDebit = $this->getTotal(Expense::DEBIT);
        $totalMonthCredit = $this->getTotal(Expense::CREDIT);
        return [
            'totalMonthDebit' =>  number_format( $totalMonthDebit / 100, 2 ),
            'totalMonthCredit' => number_format( $totalMonthCredit / 100, 2 ),
            'is_credit' => $totalMonthCredit > $totalMonthDebit,
            'balance' =>  number_format( ($totalMonthCredit - $totalMonthDebit) / 100, 2 )
        ];
    }
}
