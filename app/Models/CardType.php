<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CardType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'price',
        'user_category_id',
        'transport_id',
        'city_id',
    ];

    public function user_category(): BelongsTo {
        return $this->belongsTo(UserCategory::class);
    }

    public function transport(): BelongsTo {
        return $this->belongsTo(Transport::class);
    }

    public function city(): BelongsTo {
        return $this->belongsTo(City::class);
    }
}
