<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;


class AboutController extends Controller
{
    public function index(int $id = 1)
    {
        $about = About::query()->where('id', $id)->first();

        return view('backend.pages.about.index', [
            'about' => $about
        ]);
    }

    public function edit(Request $request, int $id = 1 )
    {
        $about = About::query()->where('id', $id)->firstOrFail();

        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $folder = 'img/about/';
            $title = $request->name;
            $fileName= imgUpload($image,$folder,$title);
            imgDelete($about->image);
        }

        $update = About::query()->update([
            'name' => $request->name,
            'content' => $request->content,
            'image' => $fileName ?? $about->image,
            'text_1' => $request->text_1,
            'text_1_icon' => $request->text_1_icon,
            'text_1_content' => $request->text_1_content,
            'text_2' => $request->text_2,
            'text_2_icon' => $request->text_2_icon,
            'text_2_content' => $request->text_2_content,
            'text_3' => $request->text_3,
            'text_3_icon' => $request->text_3_icon,
            'text_3_content' => $request->text_3_content,
        ]);

        if (!$update)
        {
            return back()->with('error', 'Dəyişdirilmə zamanı xəta yarandı!');
        }

        return back()->with('success', 'Dəyişdirilmə prossesi uğurla icra edildi!');
    }

    public function imgDelete(Request $request, int $id = 1)
    {
        $about = About::query()->where('id', $id)->firstOrFail();
        imgDelete($about->image);

        if (!$about->image)
        {
            return response([
                'error' => 'Şəkil yoxdur!',
                'status' => 'no'
            ]);
        }

        $about->update([
            'image' => null
        ]);

        return response([
            'success' => 'Şəkil silindi!',
            'status' => 'ok'
        ]);
    }
}
