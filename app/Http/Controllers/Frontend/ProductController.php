<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\PreDec;

class ProductController extends Controller
{
    public function index(Request $request, $slug = null)
    {
        $category = $request->segment(1) ?? null;

        $color = $request->color;
        $size = $request->size;
        $pricemin = $request->pricemin;
        $pricemax = $request->pricemax;

        $order = $request->order ?? 'id';
        $short = $request->short ?? 'desc';

        $products = Product::query()
            ->where('status', 1)
            ->filter($color, $size, $pricemin, $pricemax)
            ->with('categories:id,name,slug')
            ->whereHas('categories', function ($query) use ($category, $slug) {
                if (!empty($slug)) {
                    $query->where('slug', $slug);
                }
                return $query;
            })
            ->orderBy($order, $short)
            ->paginate(12);

        $sizeName = Product::query()
            ->where('status', 1)->groupBy('size')->pluck('size');

        $colorName = Product::query()
            ->where('status', 1)->groupBy('color')->pluck('color');

        return view('frontend.pages.product', [
            'products' => $products,
            'sizeName' => $sizeName,
            'colorName' => $colorName,
        ]);
    }

    public function productDetail($slug)
    {
        $product = Product::query()
            ->where('status', 1)
            ->where('slug', $slug)
            ->firstOrFail();

        $products = Product::query()
            ->where('status', 1)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit('6')
            ->get();

       $sizeName = Product::query()->where('status', 1)->groupBy('size')->pluck('size')->toArray();

        return view('frontend.pages.product-detail', [
            'product' => $product,
            'products' => $products,
            'sizeName' => $sizeName
        ]);
    }

    public function productBigSale()
    {
        $products = Product::query()->where('status', 1)->paginate(12);

        return view('frontend.pages.product', compact('products'));
    }
}
