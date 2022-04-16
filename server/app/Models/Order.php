<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    use HasFactory;

    protected $fillable = ['customer_id', 'address_id', 'zipcode', 'payment_method', 'total', 'discount', 'shipping_fee', 'total'];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function shoes() {
        return $this->belongsToMany(Shoe::class, 'order_details')->withPivot('quantity', 'subtotal');
    }
}
