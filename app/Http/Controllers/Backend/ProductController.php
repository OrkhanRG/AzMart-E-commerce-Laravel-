<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->with('categories')->orderBy('id', 'desc')->paginate(15);

        return view('backend.pages.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.pages.product.edit', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $folderName = 'img/products/';
            $title = $request->name;

            $imgName = imgUpload($image, $folderName, $title);
        }

        Product::query()->create([
            'image' => $imgName ?? '',
            'name' => $request->name,
            'short_name' => $request->short_name,
            'slug' => Str::slug($request->name.'-'.uniqid()),
            'content' => $request->content,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'size' => $request->size,
            'color' => $request->color,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('admin.product.index')->with('success', 'Yeni Məhsul yaradıldı!');
    }

    public function edit(string $id)
    {
        $product = Product::query()->where('id', $id)->firstOrFail();
        $categories = Category::all();

        return view('backend.pages.product.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, string $id)
    {
        $product = Product::query()->where('id', $id)->firstOrFail();

        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $folderName = 'img/products/';
            $title = $request->name;
            $imgName = imgUpload($image, $folderName, $title);

            imgDelete($product->image);
        }

        $product->update([
            'image' => $imgName ?? $product->image,
            'name' => $request->name,
            'short_name' => $request->short_name,
            'content' => $request->content,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'size' => $request->size,
            'color' => $request->color,
            'status' => $request->status ?? 1,
        ]);

        return back()->with('success', 'Məhsul güncəlləndi!');
    }

    public function delete(Request $request)
    {
        $product = Product::query()->where('id', $request->id)->firstOrFail();

        $delete = $product->delete();

        if (!$delete)
        {
            return response([
                'success' => 'Slayd silinmədi!',
                'status' => 'no'
            ]);
        }

        imgDelete($product->image);

        return response([
            'success' => 'Slayd silindi!',
            'status' => 'ok'
        ]);
    }

    public function statusChange(Request $request)
    {
        $id = $request->id;
        $product = Product::query()->where('id', $id)->first();

        $product->status = $product->status ? 0 : 1;
        $product->save();

        return response([
            'success' => 'Status dəyişdirildi!',
            'status' => $product->status
            ]);
    }
}
