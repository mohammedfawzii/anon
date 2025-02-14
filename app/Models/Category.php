<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','img' ,'branch_id'];
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
}
