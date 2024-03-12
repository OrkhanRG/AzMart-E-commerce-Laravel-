@extends('frontend.layouts.app')
@section('title', 'Məhsullar')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="index.html">Anasəhifə</a> <span class="mx-2 mb-0">/</span> <strong
                        class="text-black">Məhsullar</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-md-9 order-2">

                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4"><h2 class="text-black h5">Bütün Məhsullar</h2></div>
                            <div class="d-flex">
                                <div class="dropdown mr-1 ml-md-auto">

                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                            id="dropdownMenuReference" data-toggle="dropdown">Sırala
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                        <a class="dropdown-item" data-sira="a_z_order" href="#">A-Z-ə sırala</a>
                                        <a class="dropdown-item" data-sira="z_a_order" href="#">Z-A-a sırala</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" data-sira="price_max_order" href="#">Ucuzdan-Bahaya
                                            doğru sırala</a>
                                        <a class="dropdown-item" data-sira="price_min_order" href="#">Bahadan-Ucuza
                                            doğru sırala</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div class="row mb-5">
                        @foreach($products as $product)
                            <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="productID" value="{{ $product->id }}">

                                    <div class="block-4 text-center border">
                                        <figure class="block-4-image">
                                            <a href="{{ route('productDetail', ['slug' => $product->slug]) }}"><img
                                                    src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                                    class="img-fluid"></a>
                                        </figure>
                                        <div class="block-4-text p-4">
                                            <h3>
                                                <a href="{{ route('productDetail', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                            </h3>
                                            <p class="mb-0">{{ $product->short_name }}</p>
                                            <p class="text-primary font-weight-bold">{{ $product->price }} AZN</p>
                                            <button type="submit" class="buy-now btn btn-sm btn-primary">Səbətə Əlavə
                                                Et
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        @endforeach


                    </div>
                    <div class="row" data-aos="fade-up">
                        <div class="col-md-12 text-center">
                            {{--<div class="site-block-27">
                                 <ul>
                                     <li><a href="#">&lt;</a></li>
                                     <li class="active"><span>1</span></li>
                                     <li><a href="#">2</a></li>
                                     <li><a href="#">3</a></li>
                                     <li><a href="#">4</a></li>
                                     <li><a href="#">5</a></li>
                                     <li><a href="#">&gt;</a></li>
                                 </ul>

                             </div>--}}
                            <div class="d-flex justify-content-center">
                                {{ $products->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 order-1 mb-5 mb-md-0">
                    <div class="border p-4 rounded mb-4">
                        <h3 class="mb-3 h6 text-uppercase text-black d-block">Kateqoriyalar</h3>
                        <ul class="list-unstyled mb-0">
                            @if(!empty($categories) && $categories->count() > 0)
                                @foreach($categories->where('parent_category', null) as $category)
                                    <li class="mb-1"><a href="{{ route('product'.$category->slug) }}"
                                                        class="d-flex"><span>{{ $category->name }}</span> <span
                                                class="text-black ml-auto">({{ $category->getTotalProductCount() }})</span></a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>

                    <div class="border p-4 rounded mb-4">
                        <div class="mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">Qiymətə Görə Sırala</h3>
                            <div id="slider-range" class="border-primary"></div>
                            <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white"
                                   disabled=""/>
                        </div>

                        <div class="mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">Ölçü</h3>
                            @if(!empty($sizeName) && $sizeName->count() > 0)
                                @foreach($sizeName as $key => $size)
                                    <label for="size{{ $key }}" class="d-flex">
                                        <input type="checkbox" id="size{{ $key }}" value="{{ $size }}" {{ isset(request()->size) && in_array($size, explode(',', request()->size)) ? 'checked' : '' }} class="mr-2 mt-1 inputSize"> <span
                                            class="text-black">{{ $size }}</span>
                                    </label>
                                @endforeach
                            @endif
                        </div>

                        <div class="mb-4">
                            <h3 class="mb-3 h6 text-uppercase text-black d-block">Color</h3>
                            @if(!empty($colorName) && $colorName->count() > 0)
                                @foreach($colorName as $key => $color)
                                    <label for="color{{ $key }}" class="d-flex">
                                        <input type="checkbox" id="color{{ $key }}" value="{{ $color }}" {{ isset(request()->color) && in_array($color, explode(',', request()->color)) ? 'checked' : '' }} class="mr-2 mt-1 inputColor"> <span
                                            class="text-black">{{ $color }}</span>
                                    </label>
                                @endforeach
                            @endif
                        </div>

                        <button class="btn btn-primary btn-block btnFilter">Filtr</button>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="site-section site-blocks-2">
                        <div class="row justify-content-center text-center mb-5">
                            <div class="col-md-7 site-section-heading pt-4">
                                <h2>Kateqoriyalar</h2>
                            </div>
                        </div>
                        <div class="row">
                            @if(!empty($categories) && count($categories) > 0)
                                @foreach($categories->where('parent_category', null) as $category)
                                    <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade"
                                         data-aos-delay="">
                                        <a class="block-2-item" href="{{ route('product'.$category->slug) }}">
                                            <figure class="image">
                                                <img src="{{ asset($category->image) }}" alt="{{ $category->name }}"
                                                     class="img-fluid">
                                            </figure>
                                            <div class="text">
                                                <span class="text-uppercase">Geyim</span>
                                                <h3>{{ $category->name }}</h3>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script>
        var pricemax = {{ request()->pricemax ?? $maxprice }};
        var pricemin = {{ request()->pricemin ?? 0 }};
        var maxprice = {{ $maxprice }};
    </script>

    <script>
        $('.btnFilter').on('click', function (){
            let url = new URL(window.location.href);
            let colorList = $('.inputColor:checked').map((item, index) => index.value).get();
            let sizeList = $('.inputSize:checked').map((item, index) => index.value).get();

            if (colorList.length > 0){
                url.searchParams.set('color', colorList.join(','));
            }else {
                url.searchParams.delete('color');
            }

            if (sizeList.length > 0){
                url.searchParams.set('size', sizeList.join(','));
            }else {
                url.searchParams.delete('size');
            }

            newURL = url.href;
            window.history.pushState({}, '', newURL);
            location.reload();
        });
    </script>
@endsection
