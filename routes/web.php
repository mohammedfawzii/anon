<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/',[ HomeController::class ,'index'] )->name('home');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('sizes', SizeController::class);
    Route::resource('products', ProductController::class);
});

Route::post('products/{product}/order', [ProductController::class, 'order'])->name('products.order');
Route::post('products/{product}/rate', [ProductController::class, 'rate'])->name('products.rate');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::put('/cart/update/{rowId}', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{rowId}', [CartController::class, 'removeFromCart'])->name('cart.remove');


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {}
);

require __DIR__ . '/auth.php';
