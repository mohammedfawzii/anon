<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_color')->withPivot('stock');
    }
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'color_size');
    }
}
