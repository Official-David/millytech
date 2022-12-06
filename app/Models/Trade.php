<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trade extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $casts = [
        'meta' => 'object',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            generateReference:
            $reference = Str::random(10);
            if (self::where('reference', $reference)->exists()) {
                goto generateReference;
            }
            $model->reference = $reference;
        });
    }

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
