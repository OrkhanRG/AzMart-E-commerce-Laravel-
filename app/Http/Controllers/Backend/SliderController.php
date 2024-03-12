<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderCreateRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::query()->orderBy('id', 'desc')->paginate(10);

        return view('backend.pages.slider.index', [
            'sliders' => $sliders
        ]);
    }

    public function create()
    {
        return view('backend.pages.slider.edit');
    }

    public function show(int $id)
    {
        $slide = Slider::query()->where('id', $id)->firstOrFail();
        return view('backend.pages.slider.edit', compact('slide'));
    }

    public function store(SliderCreateRequest $request)
    {
        if ($request->hasFile('image'))
        {
            $folder = 'img/sliders/';
            $image = $request->file('image');
            $title = $request->title;
            $fileName = imgUpload($image, $folder, $title);

        }

        Slider::query()->create([
            'title' => $request->title,
            'description' => $request->description ?? '',
            'image' => $fileName ?? null,
            'link' => $request->link ?? '',
            'status' => $request->status
        ]);

        return redirect()->route('admin.slider.index')->with('success', 'Yeni Slayd yaradıldı!');
    }

    public function edit(SliderCreateRequest $request ,int $id)
    {
        $slide = Slider::query()->where('id', $id)->firstOrFail();

        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $folder = 'img/sliders/';
            $title = $request->title;
            $fileName= imgUpload($image,$folder,$title);
            imgDelete($slide->image);
        }

        $update = Slider::query()
            ->where('id', $id)
            ->update([
                'title' => $request->title,
                'description' => $request->description ?? null,
                'image' => $fileName ?? $slide->image,
                'link' => $request->link ?? '',
                'status' => $request->status
            ]);

        if (!$update)
        {
            return back()->with('error', 'Dəyişdirilmə zamanı xəta yarandı!');
        }

        return redirect()->route('admin.slider.index')->with('success', 'Slayd Güncəlləndi!');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $slide = Slider::query()->where('id', $id)->firstOrFail();

        imgDelete($slide->image);
        $slide->delete();

        return response([
            'success' => 'Slayd silindi!',
            'status' => 'ok'
        ]);
    }

    public function statusChange(Request $request)
    {
        $id = $request->id;
        $slide = Slider::query()->where('id', $id)->firstOrFail();

        $slide->update([
            'status' => $slide->status == 1 ? 0 : 1
        ]);

        return response([
            'success' => 'Status dəyişdirildi!',
            'status' => $slide->status
        ]);
    }
}
