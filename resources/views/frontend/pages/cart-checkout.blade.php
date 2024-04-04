@extends('frontend.layouts.app')
@section('title', 'Məhsullar')

@section('content')
    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="border p-4 rounded" role="alert">
                        Returning customer? <a href="#">Click here</a> to login
                    </div>
                </div>
            </div>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="aler alert-warning mb-3 p-2">
                        <p>*{{ $error }}</p>
                    </div>
                @endforeach
            @endif
            <form action="{{ route('cart.payment-confirm') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-5 mb-md-0">
                        <h2 class="h3 mb-3 text-black">Ödəniş Təfərrüatları</h2>
                        <div class="p-3 p-lg-5 border">
                            <div class="form-group">
                                <label for="c_country" class="text-black">Ölkə <span class="text-danger">*</span></label>
                                <select id="c_country" class="form-control">
                                    <option value="1">Ölkənizi seçin</option>
                                    <option value="3">Azerbaijan</option>
                                    <option value="3">Turkey</option>
                                    <option value="2">bangladesh</option>
                                    <option value="3">Algeria</option>
                                    <option value="4">Afghanistan</option>
                                    <option value="5">Ghana</option>
                                    <option value="6">Albania</option>
                                    <option value="7">Bahrain</option>
                                    <option value="8">Colombia</option>
                                    <option value="9">Dominican Republic</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="name" class="text-black">Ad <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="col-md-6">
                                    <label for="surname" class="text-black">Soyad <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="surname" name="surname">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="company" class="text-black">Şirkət Adı </label>
                                    <input type="text" class="form-control" id="company" name="company">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="address" class="text-black">Ünvan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Küçə ünvanı">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="city" class="text-black">Şəhər <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="city" name="city">
                                </div>
                                <div class="col-md-6">
                                    <label for="post_code" class="text-black">Post / Zip <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="post_code" name="post_code">
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                <div class="col-md-6">
                                    <label for="email" class="text-black">E-mail <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="text-black">Telefon <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefon nömrəniz">
                                </div>
                            </div>

                            {{--Register zamani istifadə olunacaq!--}}
                            {{--<div class="form-group">
                                <label for="c_create_account" class="text-black" data-toggle="collapse" href="#create_an_account" role="button" aria-expanded="false" aria-controls="create_an_account"><input type="checkbox" value="1" id="c_create_account"> Create an account?</label>
                                <div class="collapse" id="create_an_account">
                                    <div class="py-2">
                                        <p class="mb-3">Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                        <div class="form-group">
                                            <label for="c_account_password" class="text-black">Account Password</label>
                                            <input type="email" class="form-control" id="c_account_password" name="c_account_password" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>--}}

                            <div class="form-group">
                                <label for="order_notes" class="text-black">Sifariş Qeydi</label>
                                <textarea name="order_notes" id="order_notes" cols="30" rows="5" class="form-control" placeholder="Sifariş qeydinizi bura yazın..."></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Kupon Kodu</h2>
                                <div class="p-3 p-lg-5 border">

                                    <label for="c_code" class="text-black mb-3">Tətbiq olunan kupon kodu</label>
                                    <div class="input-group w-75">
                                        <input type="text" class="form-control" id="c_code" placeholder="{{ session()->get('coupon_code') ?? 'Kupon Kodu Tətbiq Olunmayıb.' }}" aria-label="Coupon Code" readonly aria-describedby="button-addon2">

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Sifarişləriniz</h2>
                                <div class="p-3 p-lg-5 border">
                                    <table class="table site-block-order-table mb-5">
                                        <thead>
                                        <th>Məhsul</th>
                                        <th>Qiymət</th>
                                        <th>Ümumi Qiymət</th>
                                        </thead>
                                        <tbody>
                                        @foreach(session()->get('cart') as $item)
                                            <tr>
                                                <td>{{ $item['name'] }} <strong class="mx-2">x</strong> {{ $item['count'] }}</td>
                                                <td>{{ $item['price'] }} &#8380;</td>
                                                <td>{{ $item['price'] * $item['count'] }} &#8380;</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                    <div class="border p-3 mb-3 d-flex justify-content-between ">
                                        <h3 class="h6 mb-0">
                                            <strong class="text-black">{{ session('newTotalPrice') ? 'Original' : 'Ümumi' }} Qiymət:</strong>
                                        </h3>
                                        <p class="h6 mb-0">
                                            <strong class="text-black">{{ $oldTotalPrice }} &#8380;</strong>
                                        </p>
                                    </div>

                                    @if(session('newTotalPrice'))
                                        @if(session('newTotalPrice') && $totalPrice > 0)
                                            @php
                                                $percentage = round(100 - $totalPrice*100/$oldTotalPrice, 2);
                                                $percentage = floor($percentage*100)/100;
                                            @endphp
                                            {{--                                    bunun css-in duzenlemek--}}
                                            <div class="">
                                                <p class="m-0">
                                                    <strong class="text-warning">{{ $percentage }} %</strong>
                                                </p>
                                                <p class="m-0">
                                                    <small style="margin-left: 5px">
                                                        <s class="text-secondary">{{ $oldTotalPrice }} AZN</s>
                                                    </small>
                                                </p>
                                            </div>

                                        @endif
                                        <div class="border p-3 mb-3 d-flex justify-content-between ">
                                            <h3 class="h6 mb-0">
                                                <strong class="text-black">Endirimli Qiymət:</strong>
                                            </h3>
                                            <p class="h6 mb-0">
                                                <strong class="text-black">{{ session()->get('newTotalPrice') ?? $oldTotalPrice ?? 0 }} &#8380;</strong>
                                            </p>
                                        </div>
                                    @endif



                                    <div class="form-group">
                                        <button class="btn btn-primary btn-lg py-3 btn-block" >Ödəniş Et</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
            <!-- </form> -->
        </div>
    </div>

@endsection

@section('js')

@endsection
