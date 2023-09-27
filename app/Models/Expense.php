<?php

namespace App\Models;

use App\Http\Resources\UserResource;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Expense extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    const DEBIT = 1;
    const CREDIT = 2;

    const EXPENSE_TYPE = [
        self::DEBIT => 'debit',
        self::CREDIT => 'credit',
    ];

    protected $casts = [
        'amount' => 'integer',
        'issued_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $appends = [
        'formatted_amount',
        'formatted_type'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getFormattedAmountAttribute(): string
    {
        return number_format( $this->getAttribute( 'amount' ) / 100, 2 );
    }

    public function getFormattedTypeAttribute(): string
    {
        return Str::ucfirst(self::EXPENSE_TYPE[$this->type]);
    }

    // This is the scope we added
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
