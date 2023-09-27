<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ExpenseController;
use App\Http\Controllers\API\KeywordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', function (){
    return \App\Http\Resources\UserResource::collection(\App\Models\User::all());
});

Route::get('expenses', [ExpenseController::class, 'index']);
Route::get('expenses/{expense}/edit', [ExpenseController::class, 'edit']);
Route::put('expenses/{expense}', [ExpenseController::class, 'update']);
Route::post('expenses/upload-file', [ExpenseController::class, 'uploadFile']);
Route::post('expenses', [ExpenseController::class, 'store']);
Route::delete('expenses/{expense}', [ExpenseController::class, 'destroy']);
Route::get('totals', [ExpenseController::class, 'getTotals']);
Route::get('total-debit', [ExpenseController::class, 'totalDebit']);
Route::get('total-credit', [ExpenseController::class, 'totalCredit']);
Route::prefix('categories')->group(function () {
    Route::get('', [CategoryController::class, 'index']);
    Route::get('{category}/edit', [CategoryController::class, 'edit']);
    Route::post('{category}/keyword', [KeywordController::class, 'create']);
    Route::delete('{category}/keyword', [KeywordController::class, 'destroy']);
});
