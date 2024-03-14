@if($products && count($products) > 0)
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
@endif
