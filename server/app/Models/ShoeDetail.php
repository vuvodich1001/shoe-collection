<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoeDetail extends Model {
    use HasFactory;

    protected $fillable = ['shoe_id', 'size_id', 'color_id', 'quantity', 'stock'];

    public function size() {
        return $this->belongsTo(Size::class);
    }

    public function color() {
        return $this->belongsTo(Color::class);
    }

    public function shoe() {
        return $this->belongsTo(Shoe::class);
    }
}
