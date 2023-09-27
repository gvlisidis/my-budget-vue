<?php

namespace App\Http\Requests;

use App\Models\Expense;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'label' => ['string', 'required'],
            'category_id' => ['integer', 'required', 'exists:App\Models\Category,id'],
            'user_id' => ['integer', 'required', 'exists:App\Models\User,id'],
            'issued_at' => ['required', 'string', 'date', 'before:today'],
            'type' => ['required', 'integer', Rule::in([Expense::DEBIT, Expense::CREDIT]),],
            'amount' => ['required', 'integer']
        ];
    }
}
