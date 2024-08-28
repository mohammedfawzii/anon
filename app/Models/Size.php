<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_size');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_size')->withPivot('stock');
    }
}
