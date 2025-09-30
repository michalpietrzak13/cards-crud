<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'card_number',
        'pin',
        'activated_at',
        'expires_at',
        'balance',
    ];

    protected $casts = [
        'activated_at' => 'datetime',
        'expires_at' => 'date',
        'balance' => 'decimal:2',
    ];
}
