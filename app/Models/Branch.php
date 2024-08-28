<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'img'
    ];
    public function category()
    {
        return $this->hasMany(Category::class);
    }
}
