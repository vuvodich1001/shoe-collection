<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model {
    use HasFactory;

    protected $fillable = ['name'];

    protected $hidden = ['pivot'];

    public function shoeDetail() {
        return $this->hasMany(ShoeDetail::class);
    }

    public function image() {
        return $this->hasMany(Image::class);
    }

    public function shoes() {
        return $this->belongsToMany(Shoe::class, 'images')->withPivot('image', 'image_sort', 'default');
    }
}
