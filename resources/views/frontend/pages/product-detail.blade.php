@extends('frontend.layouts.app')
@section('title', 'Məhsullar')

@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{ route('front.index') }}">Anasəhifə</a> <span
                        class="mx-2 mb-0">/</span> <strong class="text-black">{{ $product->name }}</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->get('error'))
                <div class="alert alert-warning">
                    {{ session()->get('error') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset($product->image) }}" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h2 class="text-black">{{ $product->name ?? 'Product Name' }}</h2>
                    <p>{!!   $product->content !!}</p>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf

                        <input type="hidden" name="productID" value="{{ $product->id }}">

                        <div class="mb-1 d-flex">
                            @if(!empty($sizeName))
                                @foreach($sizeName as $name)
                                    <label for="option-sm" class="d-flex mr-3 mb-3">
                                        <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input
                                                type="radio"
                                                {{ $product->size == $name ? 'checked' : '' }} value="{{ $name }}"
                                                id="option-sm" name="size"></span> <span
                                            class="d-inline-block text-black">{{ $name }}</span>
                                    </label>
                                @endforeach
                            @endif
                        </div>
                        <div class="mb-5">
                            <div class="input-group mb-3" style="max-width: 120px;">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                                </div>
                                <input type="text" class="form-control text-center"
                                       {{ $name == $product->size ? 'checked' : '' }} name="count" value="1"
                                       placeholder="" aria-label="Example text with button addon"
                                       aria-describedby="button-addon1">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                                </div>
                            </div>

                        </div>
                        <p>
                            <button type="submit" class="buy-now btn btn-sm btn-primary">Səbətə Əlavə Et</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(!empty($products) && count($products) > 0)
        <div class="site-section block-3 site-blocks-2 bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7 site-section-heading text-center pt-4">
                        <h2>Digər Məhsullar</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="nonloop-block-3 owl-carousel">
                            @foreach($products as $item)
                                <div class="item">
                                    <div class="block-4 text-center">
                                        <figure class="block-4-image">
                                            <img src="{{ asset($item->image) }}" alt="Image placeholder"
                                                 class="img-fluid">
                                        </figure>
                                        <div class="block-4-text p-4">
                                            <h3><a href="#">{{ $item->name }}</a></h3>
                                            <p class="mb-0">{{ $item->short_name }}</p>
                                            <p class="text-primary font-weight-bold">{{ $item->price }} AZN</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
