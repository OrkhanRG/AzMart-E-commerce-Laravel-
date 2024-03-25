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

        $colors = $request->color ? explode(',', $request->color) : $request->color;
        $sizes = $request->size ? explode(',', $request->size) : $request->size;

        $min = $request->pricemin == 0 ? 0.1 : $request->pricemin;
        $max = $request->pricemax;

        $order = $request->order ?? 'id';
        $short = $request->short ?? 'desc';

        $products = Product::query()
            ->where('status', 1)
            ->filter($colors, $sizes, $min, $max)
            ->with('categories:id,name,slug')
            ->whereHas('categories', function ($query) use ($category, $slug) {
                if (!empty($slug)) {
                    $query->where('slug', $slug);
                }
                return $query;
            })
            ->orderBy($order, $short)
            ->paginate(12);

        //ajax response
        if ($request->ajax())
        {
            $view = view('frontend.ajax.product-list', compact('products'))->render();
            return response(['data' => $view, 'pagination' => (string) $products->withQueryString()->links()]);
        }

        $sizeName = Product::query()
            ->where('status', 1)->groupBy('size')->pluck('size');

        $colorName = Product::query()
            ->where('status', 1)->groupBy('color')->pluck('color');

        $maxprice = Product::query()->max('price');
        $minprice = 0;

        return view('frontend.pages.product', [
            'products' => $products,
            'sizeName' => $sizeName,
            'colorName' => $colorName,
            'minprice' => $minprice,
            'maxprice' => $maxprice
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
            ->orderBy('id', 'desc')
            ->limit('6')
            ->get();

       $sizeName = Product::query()->where('status', 1)->groupBy('size')->pluck('size')->toArray();

        return view('frontend.pages.product-detail', [
            'product' => $product,
            'products' => $products,
            'sizeName' => $sizeName
        ]);
    }

    public function productBigSale(Request $request, $slug = null)
    {
        $category = $request->segment(1) ?? null;

        $colors = $request->color ? explode(',', $request->color) : $request->color;
        $sizes = $request->size ? explode(',', $request->size) : $request->size;

        $min = $request->pricemin == 0 ? 0.1 : $request->pricemin;
        $max = $request->pricemax;

        $order = $request->order ?? 'id';
        $short = $request->short ?? 'desc';

        $products = Product::query()
            ->where('status', 1)
            ->filter($colors, $sizes, $min, $max)
            ->with('categories:id,name,slug')
            ->whereHas('categories', function ($query) use ($category, $slug) {
                if (!empty($slug)) {
                    $query->where('slug', $slug);
                }
                return $query;
            })
            ->orderBy($order, $short)
            ->paginate(12);

        //ajax response
        if ($request->ajax())
        {
            $view = view('frontend.ajax.product-list', compact('products'))->render();
            return response(['data' => $view, 'pagination' => (string) $products->withQueryString()->links()]);
        }

        $sizeName = Product::query()
            ->where('status', 1)->groupBy('size')->pluck('size');

        $colorName = Product::query()
            ->where('status', 1)->groupBy('color')->pluck('color');

        $maxprice = Product::query()->max('price');
        $minprice = 0;

        return view('frontend.pages.product', [
            'products' => $products,
            'sizeName' => $sizeName,
            'colorName' => $colorName,
            'minprice' => $minprice,
            'maxprice' => $maxprice
        ]);
    }
}
