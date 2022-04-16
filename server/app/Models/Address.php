<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Customer;

class Address extends Model {
    use HasFactory;

    protected $fillable = ['customer_id', 'first_name', 'last_name', 'line1', 'line2', 'city', 'country', 'phone'];

    public function order() {
        return $this->hasMany(Order::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
