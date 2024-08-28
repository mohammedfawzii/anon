<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [ 'category_id', 'name', 'description', 'price', 'stock','stars','kind'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class ,'color_product')->withPivot('stock');
    }
    public function sizes()
{
    return $this->belongsToMany(Size::class, 'product_size')->withPivot('stock');
}
public function images()
{
    return $this->hasMany(ProductImage::class);
}
}
