<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model {
    use HasFactory;

    protected $fillable = ['customer_id', 'shoe_id', 'rating', 'comment', 'image'];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function shoe() {
        return $this->beLongsTo(Shoe::class);
    }
}
