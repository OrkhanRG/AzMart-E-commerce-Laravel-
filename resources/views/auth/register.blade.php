@extends('frontend.layouts.app')
@section('title', 'Qeydiyyat')
@section('content')
    <div class="container col-md-4">
        <div class="d-flex justify-content-center"><h2>Qeydiyyat</h2></div>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-warning">{{ $error }}</div>
            @endforeach
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session()->get('error') }}</div>
        @endif
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Ad Soyad</label>
                <input type="text" name='name' class="form-control" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Ünvanınız</label>
                <input type="email" name='email' class="form-control" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Şifrə</label>
                <input type="password" name='password' class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label for="password_confirm" class="form-label">Şifrə Təkrar</label>
                <input type="password" name='password_confirmation' class="form-control" id="password">
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">Qeydiyyat</button>
        </form>
    </div>
@endsection
