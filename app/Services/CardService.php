<?php

namespace App\Services;


use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CardService
{
    public function showCart()
    {
        // استرجاع عناصر السلة
        $cartItems = Cart::instance('cart')->content();
        return $cartItems;
    }

    public function addProduct($productId, $quantity)
    {
        $product = Product::find($productId);
        if ($product) {
            // إضافة المنتج إلى السلة
            Cart::instance('cart')->add($productId, $product->name, $quantity, $product->price)
                ->associate('App\Models\Product');
            return true;
        }
        return false;
    }

    public function updateCart($rowId, $quantity): array
    {
        $cart = Cart::instance('cart')->get($rowId);

        if ($cart) {
            if ($quantity > 0) {
                Cart::update($rowId, $quantity);
                return [
                    'success' => true,
                    'message' => 'تم تحديث العربة بنجاح.',
                    'cartTotal' => Cart::total(),
                    'itemTotal' => $cart->price * $quantity
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'الكمية يجب أن تكون أكبر من صفر.'
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => 'المنتج غير موجود في السلة.'
            ];
        }
    }

    public function removeFromCart($rowId)
    {
        $cart = Cart::instance('cart')->get($rowId);

        if ($cart) {
            Cart::remove($rowId);
            return [
                'success' => true,
                'message' => 'تم حذف المنتج من السلة بنجاح.'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'المنتج غير موجود في السلة.'
            ];
        }
    }



}
