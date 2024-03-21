<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        $oldTotalPrice = $totalPrice;

        if (session('newTotalPrice') && $totalPrice > 0) {
            $totalPrice = session('newTotalPrice');
        }

        return view('frontend.pages.cart',
            [
                'cartItems' => $cartItems,
                'totalPrice' => $totalPrice,
                'oldTotalPrice' => $oldTotalPrice
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

        if (array_key_exists($productID, $cartItems)) {
            $cartItems[$productID]['count'] += $count;
        } else {
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

        if (!array_key_exists($productID, $cartItems)) {
            return back()->withErrors('Məhsul tapılmadı!');
        }

        unset($cartItems[$productID]);

        session(['cart' => $cartItems]);

        session()->forget('newTotalPrice');

        return back()->with([
            'success' => 'Məhsul səbətdən silindi!'
        ]);
    }

    public function applyCoupon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coupon_name' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'kupon kodu boş girilə bilməz!');
        }

        $coupon = Coupon::query()->where('name', $request->coupon_name)->where('status', 1)->first();
        $price = $coupon->price ?? 0;

        if (!$coupon)
        {
            return back()->with('error', 'Daxil etdiyiniz kupon yanlışdır!');
        }

        $cartItems = session('cart', []);
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['count'];
        }

        if ($totalPrice >= $price) {
            $totalPrice = $totalPrice - $price;
        } else {
            $totalPrice = 0;
        }

        session()->put('newTotalPrice', $totalPrice);
        return back()->with('success', 'Kupon kodu aktiv edildi!');
    }
}
