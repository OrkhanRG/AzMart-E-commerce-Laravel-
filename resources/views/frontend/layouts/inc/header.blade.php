<!DOCTYPE html>
<html lang="en">
<head>
    <title> @yield('title') &mdash; AzMart </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">


    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>

<div class="site-wrap">
    <header class="site-navbar" role="banner">
        <div class="site-navbar-top">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
                        <form action="" class="site-block-top-search">
                            <span class="icon icon-search2"></span>
                            <input type="text" class="form-control border-0" placeholder="Axtar">
                        </form>
                    </div>

                    <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
                        <div class="site-logo">
                            <a href="{{ route('front.index') }}" class="js-logo-clone">AzMart</a>
                        </div>
                    </div>

                    <div class="col-6 col-md-4 order-3 order-md-3 text-right">
                        <div class="site-top-icons">
                            <ul>
                                <li><a href="#"><span class="icon icon-person"></span></a></li>
                                <li><a href="#"><span class="icon icon-heart-o"></span></a></li>
                                <li>
                                    <a href="{{ route('cart') }}" class="site-cart">
                                        <span class="icon icon-shopping_cart"></span>
                                        <span class="count">{{ session()->get('cart') ? count(session()->get('cart')) : 0 }}</span>
                                    </a>
                                </li>
                                <li class="d-inline-block d-md-none ml-md-0"><a href="#"
                                                                                class="site-menu-toggle js-menu-toggle"><span
                                            class="icon-menu"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="site-navigation text-right text-md-center" role="navigation">
            <div class="container">
                <ul class="site-menu js-clone-nav d-none d-md-block">
                    <li class="{{ Route::is('front.index') ? 'active' : '' }}"><a href="{{ route('front.index') }}">Anasəhifə</a>
                    </li>
                    <li class="has-children">
                        <a href="javascript:void(0)">Kataloq</a>
                        <ul class="dropdown">
                            @if(!empty($categories) && count($categories) > 0)
                                @foreach($categories->where('parent_category', null) as $category)
                                    <li class="has-children">
                                        <a href="{{ route('product'.$category->slug) }}">{{ $category->name }}</a>
                                        <ul class="dropdown">
                                            @foreach($category->subCategory as $parent_category)
                                                <li><a href="{{ route('product'.$category->slug, $parent_category->slug) }}">{{ $parent_category->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                    <li class="{{ Route::is('about') ? 'active' : '' }}"><a href="{{ route('about') }}">Haqqımızda</a>
                    </li>
                    <li class="{{ Route::is('product') ? 'active' : '' }}"><a
                            href="{{ route('product') }}">Məhsullar</a></li>
                    <li class="{{ Route::is('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">Əlaqə</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
