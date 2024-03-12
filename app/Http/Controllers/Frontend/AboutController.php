<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::query()->where('id', 1)->first();

        return view('frontend.pages.about', [
            'about' => $about,
        ]);
    }
}
