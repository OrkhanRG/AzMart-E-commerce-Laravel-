<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\SettingController;


Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function (){
    Route::get('/', [HomeController::class, 'index'])->name('index');

    //slider
    Route::get('/slider', [SliderController::class, 'index'])->name('slider.index');
    Route::get('/slider/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('/slider/create', [SliderController::class, 'store']);
    Route::get('/slider/edit/{id}', [SliderController::class, 'show'])->name('slider.edit');
    Route::post('/slider/edit/{id}', [SliderController::class, 'edit']);
    Route::delete('/slider/delete', [SliderController::class, 'delete'])->name('slider.delete');
    Route::post('/slider/status-change', [SliderController::class, 'statusChange'])->name('slider.status-change');

    //category
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/create', [CategoryController::class, 'store']);
    Route::get('/category/edit/{id}', [CategoryController::class, 'show'])->name('category.edit');
    Route::post('/category/edit/{id}', [CategoryController::class, 'edit']);
    Route::delete('/category/delete', [CategoryController::class, 'delete'])->name('category.delete');
    Route::post('/category/status-change', [CategoryController::class, 'statusChange'])->name('category.status-change');

    //about
    Route::get('/about', [AboutController::class, 'index'])->name('about.index');
    Route::post('/about/edit/{id?}', [AboutController::class, 'edit'])->name('about.edit');
    Route::delete('/about/image/delete', [AboutController::class, 'imgDelete'])->name('about.img-delete');


    //contact
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/contact/edit/{id}', [ContactController::class, 'edit'])->name('contact.edit');
    Route::put('/contact/update/{id}', [ContactController::class, 'update'])->name('contact.update');
    Route::post('/contact/status-change', [ContactController::class, 'statusChange'])->name('contact.status-change');
    Route::delete('/contact/delete', [ContactController::class, 'delete'])->name('contact.delete');

    //setting
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::get('/setting/create', [SettingController::class, 'create'])->name('setting.create');
    Route::post('/setting/create', [SettingController::class, 'store']);
    Route::get('/setting/edit/{id}', [SettingController::class, 'edit'])->name('setting.edit');
    Route::post('/setting/edit/{id}', [SettingController::class, 'update']);
    Route::delete('/setting/delete', [SettingController::class, 'delete'])->name('setting.delete');

    //product
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/create', [ProductController::class, 'store']);
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete', [ProductController::class, 'delete'])->name('product.delete');
    Route::post('/product/status-change', [ProductController::class, 'statusChange'])->name('product.status-change');
});
