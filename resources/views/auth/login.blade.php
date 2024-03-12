@extends('frontend.layouts.app')
@section('title', 'Giriş')
@section('content')
    <div class="container col-md-4">
        <div class="d-flex justify-content-center"><h2>Giriş</h2></div>
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
        <form action="" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email Ünvanınız</label>
                <input type="email" name='email' class="form-control" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Şifrə</label>
                <input type="password" name='password' class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="remember_me" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Məni Xatırla</label>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">Daxil Ol</button>
        </form>
    </div>
@endsection
