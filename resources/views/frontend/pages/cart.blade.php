@extends('frontend.layouts.app')
@section('title', 'Məhsullar')

@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="index.html">Anasəhifə</a> <span class="mx-2 mb-0">/</span> <strong
                            class="text-black">Səbət</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="site-blocks-table">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="product-thumbnail">Şəkil</th>
                                <th class="product-name">Adı</th>
                                <th class="product-price">Qiymət</th>
                                <th class="product-quantity">Miqdar</th>
                                <th class="product-total">Ümumi Qiymət</th>
                                <th class="product-remove">Məhsulu Sil</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(!empty($cartItems) && count($cartItems) > 0)
                                @foreach($cartItems as $key => $item)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <img src="{{ $item['image'] }}" alt="Image" class="img-fluid">
                                        </td>
                                        <td class="product-name">
                                            <h2 class="h5 text-black">{{ $item['name'] }}</h2>
                                        </td>
                                        <td>{{ $item['price'] }} AZN</td>
                                        <td>
                                            <div class="input-group mb-3" style="max-width: 120px;">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-primary js-btn-minus"
                                                            type="button">
                                                        &minus;
                                                    </button>
                                                </div>
                                                <input type="text" class="form-control text-center"
                                                       value="{{ $item['count'] }}" placeholder=""
                                                       aria-label="Example text with button addon"
                                                       aria-describedby="button-addon1">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-primary js-btn-plus"
                                                            type="button">
                                                        &plus;
                                                    </button>
                                                </div>
                                            </div>

                                        </td>
                                        <td>{{ $item['price'] * $item['count'] }} AZN</td>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="productID" value="{{ $key }}">
                                            <td>
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    X
                                                </button>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('apply-coupon') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-black h4" for="coupon">Kupon</label>
                                <p>Kupon kodunuzu aşağıdakı sahəyə daxil edərək endirimdən yararlana bilərsiz.</p>
                            </div>
                            <div class="col-md-8 mb-3 mb-md-0">
                                <input type="text" name="coupon_name" class="form-control py-3" id="coupon"
                                       placeholder="Kupon Kod">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-sm">Kuponu Təsdiq Et</button>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Ümumi Məbləğ</h3>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <span class="text-black">Ümumi Məbləğ</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">{{ $oldTotalPrice }} AZN</strong>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Son Məbləğ</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-danger" style="font-size: 20px">{{ $totalPrice }} AZN</strong>
                                    <br>
                                    @if(session('newTotalPrice') && $totalPrice > 0)
                                        @php
                                            $percentage = round(100 - $totalPrice*100/$oldTotalPrice, 2);
                                            $percentage = floor($percentage*100)/100;
                                        @endphp
                                        <strong class="text-warning">{{ $percentage }} %</strong>
                                        <small style="margin-left: 5px">
                                            <s class="text-secondary">{{ $oldTotalPrice }} AZN</s>
                                        </small>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-lg py-3 btn-block"
                                            onclick="window.location='checkout.html'">Ödənişi Təsdiq Et
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
