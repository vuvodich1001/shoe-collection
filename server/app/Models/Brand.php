<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shoe;

class Brand extends Model {
    use HasFactory;

    protected $fillable = ['name'];

    public function shoes() {
        return $this->hasMany(Shoe::class);
    }
}
