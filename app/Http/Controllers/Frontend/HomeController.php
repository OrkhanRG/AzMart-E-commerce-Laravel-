<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $data = Slider::query()->where('status', 1)->orderBy('id', 'DESC')->first();
        $about = About::query()->where('id', 1)->first();
        $lastProduct = Product::query()->where('status', 1)->orderBy('id', 'desc')->limit(6)->get();

        return view('frontend.index', compact('data', 'about', 'lastProduct'));
    }
}
