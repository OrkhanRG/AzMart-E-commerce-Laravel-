@extends('backend.layouts.app')
@section('title')
    @if(isset($category))
        Kateqoriya Güncəllə
    @else
        Kateqoriya Yarat
    @endif
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">{{ isset($category) ? 'Kateqoriyaı Güncəllə' : 'Yeni Kateqoriya Yarat'}}</h4>
                        <p class="card-description">
                            <a href="{{ route('admin.category.index') }}" class="btn btn-success btn-sm">Kateqoriyalar</a>
                        </p>
                    </div>
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-warning">{{ $error }}</div>
                        @endforeach
                    @endif
                    @if(session()->get('success'))
                        <div class="alert alert-success">{{ session()->get('success') }}</div>
                    @endif
                    @if(session()->get('error'))
                        <div class="alert alert-danger">{{ session()->get('error') }}</div>
                    @endif
                    <form class="forms-sample" action="{{ isset($category) ? route('admin.category.edit', $category->id) : route('admin.category.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($category))
                            <div class="form-group">
                                <label for="title"><b class="text-warning">{{ isset($category->image) ? 'Yüklü Şəkil' : 'Şəkil Yoxdur!' }}</b></label>
                                <div><img width="100" src="{{ asset(isset($category->image) ? $category->image : '/img/category/default.png') }}" alt=""></div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="title">Kateqoriya Adı</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ isset($category) ? $category->name : '' }}" placeholder="Kateqoriya adı">
                        </div>
                        <div class="form-group">
                            <label>File upload</label>
                            <input type="file" name="image" id="image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control col-md-3 file-upload-info" disabled=""
                                       placeholder="Upload Image">
                                <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <select class="form-select form-control col-md-3" name="parent_category" id="parent_category" aria-label="Default select example">
                                <option value="">Kateqoriya Seçin</option>
                                @foreach($categories as $catAll)
                                    <option value="{{ $catAll->id }}" {{isset($category) && $catAll->id == $category->id ? 'selected' : ''}}>{{ $catAll->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            @php
                                $status = $category->status ?? '1';
                            @endphp
                            <select class="form-select form-control col-md-2" name="status" id="status" aria-label="Default select example">
                                <option value="0" {{$status=='0' ? 'selected' : ''}}>Passiv</option>
                                <option value="1" {{$status=='1' ? 'selected' : ''}}>Aktiv</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">{{ isset($category) ? 'Güncəllə' : 'Yarat' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

