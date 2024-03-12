<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()->with('category')->orderBy('id', 'desc')->paginate(10);

        return view('backend.pages.category.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.pages.category.edit', [
            'categories' => $categories
        ]);
    }

    public function show(int $id)
    {
        $category = Category::query()->where('id', $id)->firstOrFail();
        $categories = Category::all();
        return view('backend.pages.category.edit', compact('category', 'categories'));
    }

    public function store(CategoryCreateRequest $request)
    {
        if ($request->hasFile('image'))
        {
            $folder = 'img/category/';
            $image = $request->file('image');
            $title = $request->name;
            $fileName = imgUpload($image, $folder, $title);

        }

        Category::query()->create([
            'name' => $request->name,
            'slug' => Str::slug(time().$request->name),
            'image' => $fileName ?? null,
            'parent_category' => $request->parent_category,
            'status' => $request->status
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Yeni Kateqpriya yaradıldı!');
    }

    public function edit(CategoryCreateRequest $request ,int $id)
    {
        $slide = Category::query()->where('id', $id)->firstOrFail();

        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $folder = 'img/category/';
            $title = $request->name;
            $fileName= imgUpload($image,$folder,$title);
            imgDelete($slide->image);
        }

        $update = Category::query()
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'slug' => Str::slug(time().$request->name),
                'image' => $fileName ?? null,
                'parent_category' => $request->parent_category ?? '',
                'status' => $request->status
            ]);

        if (!$update)
        {
            return back()->with('error', 'Dəyişdirilmə zamanı xəta yarandı!');
        }

        return redirect()->route('admin.category.index')->with('success', 'Kateqoriya Güncəlləndi!');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $category = Category::query()->where('id', $id)->firstOrFail();

        imgDelete($category->image);
        $category->delete();

        return response([
            'success' => 'Status dəyişdirildi!',
            'status' => 'ok'
        ]);
    }

    public function statusChange(Request $request)
    {
        $id = $request->id;
        $category = Category::query()->where('id', $id)->firstOrFail();

        $category->update([
            'status' => $category->status == 1 ? 0 : 1
        ]);

        return response([
            'success' => 'Status dəyişdirildi!',
            'status' => $category->status
        ]);
    }
}
