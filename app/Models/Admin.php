<?php

namespace App\Models;

use App\Traits\HashPassword;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, HashPassword, Notifiable;
    protected $guarded = ['id'];

    public function giftcards()
    {
        return $this->belongsToMany(GiftCard::class);
    }
}
