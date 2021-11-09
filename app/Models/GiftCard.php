<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $casts = [
        'meta' => 'object'
    ];

    public function currencies()
    {
        return $this->hasMany(Currency::class);
    }

    public function trades()
    {
        return $this->morphMany(Trade::class,'tradeable');
    }
}
