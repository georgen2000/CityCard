<?php

namespace App\Models;

use App\Filters\ModelFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        $balance = $this->transactions->sum(function ($transaction) {
            $res = $transaction->money_count;
            return $transaction->is_spending ? -$res : $res;
        });
        $this->update(["balance" => $balance]);
    }
}
