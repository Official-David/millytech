<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $casts = [
        'meta' => 'object',
    ];

    public function tradeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trade_items()
    {
        return $this->hasMany(TradeItem::class);
    }

}
