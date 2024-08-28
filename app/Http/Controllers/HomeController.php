<?php

namespace App\Http\Controllers;

use App\Services\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    protected HomeService $homeServices;
    public function __construct(HomeService $homeService)
    {
        $this->homeServices = $homeService;
    }

    public function index()
    {
        $products = $this->homeServices->getProduct();
        // dd($products);
        return view('welcome', compact('products')); ;
    }

}
