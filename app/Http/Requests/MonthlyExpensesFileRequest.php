<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MonthlyExpensesFileRequest extends FormRequest
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
            'file' => 'mimes:xls,xlsx,csv|max:10000'
        ];
    }

    public function messages()
    {
        return [
            'file' => 'The file must be a type of .xls, .xlsx, .csv',
        ];
    }
}
