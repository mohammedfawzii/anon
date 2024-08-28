<?php

namespace App\Http\Controllers;

use App\Services\CardService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CardService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function showCart()
    {
        $cartItems = $this->cartService->showCart();
        return view('site.cart.cart', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('id');
        $quantity = $request->input('quantity', 1);

        if ($this->cartService->addProduct($productId, $quantity)) {
            return redirect()->back()->with('success', 'Product added to cart');
        }
        return redirect()->back()->with('error', 'Product could not be added');
    }

    public function removeFromCart($id)
    {

            $this->cartService->removeFromCart($id);
            return redirect()->route('cart.show')->with('success', 'تم حذف المنتج من السلة بنجاح.');
    }

    public function updateCart(Request $request)
    {
        $quantities = $request->input('quantities');
        $responses = [];

        foreach ($quantities as $rowId => $quantity) {
            $response = $this->cartService->updateCart($rowId, $quantity);
            $responses[$rowId] = $response;
        }

        return redirect()->route('cart.show')->with('success', 'تم تحديث السلة بنجاح.');
    }

}
