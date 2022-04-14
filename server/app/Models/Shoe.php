<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoe extends Model {
    use HasFactory;

    protected $fillable = ['name', 'color', 'brand', 'size', 'image', 'gender', 'price'];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }
}
