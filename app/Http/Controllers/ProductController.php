<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProduct();
        return view('dashboard.products.index', compact('products'));
    }

    public function create()
    {
        $category = Category::all();
        $sizes =  Size::all();
        $colors = Color::all();
        return view('dashboard.products.create', compact('colors', 'category', 'sizes'));
    }
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $this->productService->createProduct($request->validated());
        // dd($request);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $this->productService->updateProduct($product, $request->validated());

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->productService->deleteProduct($product);

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function order(Request $request, Product $product): RedirectResponse
    {
        $quantity = $request->input('quantity');

        if (!$this->productService->decrementStock($product, $quantity)) {
            return redirect()->back()->with('error', 'Insufficient stock for this product.');
        }

        return redirect()->route('products.index')->with('success', 'Order placed successfully.');
    }

    public function rate(Request $request, Product $product): RedirectResponse
    {
        $rating = $request->input('stars');

        $this->productService->updateProductRating($product, $rating);

        return redirect()->route('products.index')->with('success', 'Product rated successfully.');
    }
}
