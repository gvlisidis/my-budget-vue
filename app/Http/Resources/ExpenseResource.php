<?php

namespace App\Http\Resources;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       // dd(989, $this->amount,);
        return [
            'id' => $this->id,
            'user' => (new UserResource($this->user)),
            'category' => (new CategoryResource($this->category)),
            'label' => $this->label,
            'type' => $this->type, //Str::ucfirst($this->formatted_type),
            'amount' => $this->amount,
            'issued_at' => $this->issued_at->format('Y-m-d')
        ];
    }

}
