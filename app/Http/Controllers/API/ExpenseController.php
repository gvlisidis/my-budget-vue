<?php

namespace App\Http\Controllers\API;

use App\Filters\Expenses\ExpenseFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\MonthlyExpensesFileRequest;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Imports\ExpensesImport;
use App\Models\Expense;
use App\Services\ExpenseService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExpenseController extends Controller
{
    public function index(ExpenseFilters $filters, Request $request)
    {
        $expenses =  Expense::filter($filters)->paginate($request->perPage);

        return ExpenseResource::collection($expenses);
    }

    public function getTotals(Request $request)
    {
        $expenseService = new ExpenseService($request->all());

        return $expenseService->results();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
        Expense::create([
            'label' => $request->label,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'issued_at' => Carbon::parse($request->issued_at)->format('Y-m-d'),
            'type' => $request->type,
            'amount' => $request->amount
        ]);

        return response()->json(['message' => 'Expense created successfully!']);
    }

    public function uploadFile(MonthlyExpensesFileRequest $request)
    {
        Excel::import(new ExpensesImport(), $request->file('file'));

        return response()->json(['message' => 'File uploaded successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        return new ExpenseResource($expense);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->all());

        return response()->json(['message' => 'Expense updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return response()->noContent();
    }
}
