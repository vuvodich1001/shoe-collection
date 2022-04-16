<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoe extends Model {
    use HasFactory;

    protected $fillable = ['brand_id', 'category_id', 'name', 'description', 'price'];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class, 'order_details')->withPivot('quantity', 'subtotal');
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }

    public function shoeDetails() {
        return $this->hasMany(ShoeDetail::class);
    }
}
