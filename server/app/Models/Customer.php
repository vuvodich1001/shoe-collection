<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
    use HasFactory;

    protected $fillable = ['email', 'first_name', 'last_name', 'phone', 'password', 'birthday'];

    public function addresses() {
        return $this->hasMany(Address::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
