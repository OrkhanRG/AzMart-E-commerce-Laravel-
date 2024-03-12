<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\TestController;


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
});
