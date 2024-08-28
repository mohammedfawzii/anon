<?php


namespace App\Services;

use App\Models\Product;

class HomeService{


    public function getProduct()
    {
        $products = Product::all();
    return $products;
    }

}
