<?php

namespace App\Traits;

trait HashPassword {

    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = bcrypt($value);
    }


    public function getNameAttribute()
    {
        return "$this->firstname $this->lastname";
    }
}
