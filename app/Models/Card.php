<?php

namespace App\Models;

use App\Filters\ModelFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Card extends Model
{
    use HasFactory, ModelFilterTrait;

    public $timestamps = false;

    protected $fillable = [
        'number',
        'balance',
        'user_id',
        'card_type_id',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cardType(): BelongsTo
    {
        return $this->belongsTo(CardType::class);
    }

    public function setBalance()
    {
        $spending = Transaction::select(DB::raw('sum(money_count) as balance'))
            ->where('is_spending', 1)
            ->where('card_id', $this->id)
            ->first();
        $revenue = Transaction::select(DB::raw('sum(money_count) as balance'))
            ->where('is_spending', 0)
            ->where('card_id', $this->id)
            ->first();
        $balance = $revenue?->balance - $spending?->balance;
        $this->update(["balance" => $balance]);
    }
}
