<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CartController extends Controller
{
    public function index()
    {
        $cartItems = session('cart', []);
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['count'];
        }

        return view('frontend.pages.cart',
            [
                'cartItems' => $cartItems,
                'totalPrice' => $totalPrice
            ]);
    }

    public function add(Request $request)
    {
        $productID = $request->productID;
        $product = Product::query()->findOrFail($productID);

        $count = $request->count ?? 1;
        $size = $request->size ?? $product->size;

        if (!$product) {
            return back()->withErrors('Məhsul tapılmadı');
        }

        $cartItems = session('cart', []);

        if (array_key_exists($productID, $cartItems))
        {
           $cartItems[$productID]['count'] += $count;
        }
        else
        {
            $cartItems[$productID] = [
                'image' => $product->image,
                'name' => $product->name,
                'price' => $product->price,
                'count' => $count,
                'size' => $size
            ];
        }

        session([
            'cart' => $cartItems
        ]);

        return back()->with([
            'success' => 'Məhsul Səbətə Əlavə Olundu!'
        ]);
    }

    public function remove(Request $request)
    {
        $productID = $request->productID;
        $cartItems = session('cart', []);

        if (!array_key_exists($productID, $cartItems))
        {
            return back()->withErrors('Məhsul tapılmadı!');
        }

        unset($cartItems[$productID]);

        session(['cart' => $cartItems]);

        return back()->with([
            'success' => 'Məhsul səbətdən silindi!'
        ]);
    }
}
