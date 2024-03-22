@extends('backend.layouts.app')
@section('title')
    @if(isset($product))
        Məhsul Güncəllə
    @else
        Məhsul Yarat
    @endif
@endsection

@section('css')
    <style>
        .ck-editor__editable {
            min-height: 200px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">{{ isset($product) ? 'Məhsulu Güncəllə' : 'Yeni Məhsul Yarat'}}</h4>
                        <p class="card-description">
                            <a href="{{ route('admin.product.index') }}" class="btn btn-success btn-sm">Məhsullar</a>
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
                    <form class="forms-sample"
                          action="{{ isset($product) ? route('admin.product.update', $product->id) : route('admin.product.create') }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($product))
                            <div class="form-group">
                                <label for="image"><b
                                        class="text-warning">{{ isset($product->image) ? 'Yüklü Şəkil' : 'Şəkil Yoxdur!' }}</b></label>
                                <div><img width="200"
                                          src="{{ asset(isset($product->image) ? $product->image : '/img/products/default.png') }}"
                                          alt=""></div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="title">Məhsul Adı</label>
                            <input type="text" name="name" id="title" class="form-control"
                                   value="{{ isset($product) ? $product->name : '' }}" placeholder="Məhsul başlığı">
                        </div>
                        <div class="form-group">
                            <label for="short_name">Məhsul Qısa Məzmun</label>
                            <input type="text" name="short_name" id="short_name" class="form-control"
                                   value="{{ isset($product) ? $product->short_name : '' }}" placeholder="Məhsul qısa məzmun">
                        </div>
                        <div class="form-group">
                            <label for="content">Məzmun</label>
                            <textarea name="content" id="ckeditor" rows="4" class="form-control ck-editor__editable"
                                      placeholder="Məzmunu daxil edin">{{ isset($product) ? $product->content : ''}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>File upload</label>
                            <input type="file" name="image" id="image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled=""
                                       placeholder="Upload Image">
                                <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price">Qiymət</label>
                            <input type="text" name="price" id="price" class="form-control"
                                   value="{{ isset($product) ? $product->price : '' }}" placeholder="Məhsul qiyməti">
                        </div>
                        <div class="row form-group">
                            <div class="form-group col-3">
                                <label for="size">Ölçü</label>
                                <select name="size" id="size" class="form-control">
                                    <option value="">Ölçü Seçin</option>
                                    <option value="L" {{ isset($product) && $product->size === 'L' ? 'selected' : '' }}>L</option>
                                    <option value="S" {{ isset($product) && $product->size === 'S' ? 'selected' : '' }}>S</option>
                                    <option value="M" {{ isset($product) && $product->size === 'M' ? 'selected' : '' }}>M</option>
                                    <option value="XL" {{ isset($product) && $product->size === 'XL' ? 'selected' : '' }}>XL</option>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="color">Rəng</label>
                                <select name="color" id="color" class="form-control">
                                    <option value="">Rəng Seçin</option>
                                    <option value="Ağ" {{ isset($product) && $product->color === 'Ağ' ? 'selected' : '' }}>Ağ</option>
                                    <option value="Göy" {{ isset($product) && $product->color === 'Göy' ? 'selected' : '' }}>Göy</option>
                                    <option value="Qara" {{ isset($product) && $product->color === 'Qara' ? 'selected' : '' }}>Qara</option>
                                    <option value="Qırmızı" {{ isset($product) && $product->color === 'Qırmızı' ? 'selected' : '' }}>Qırmızı</option>
                                    <option value="Yaşıl" {{ isset($product) && $product->color === 'Yaşıl' ? 'selected' : '' }}>Yaşıl</option>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="category_id">Kateqoriya</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Kateqoriya Seçin</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                @php
                                    $status = $product->status ?? '1';
                                @endphp
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status" aria-label="Default select example">
                                    <option value="0" {{$status=='0' ? 'selected' : ''}}>Passiv</option>
                                    <option value="1" {{$status=='1' ? 'selected' : ''}}>Aktiv</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit"
                                class="btn btn-primary mr-2">{{ isset($product) ? 'Güncəllə' : 'Yarat' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('backend/js/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function (){
            ckeditor();
        });

        function ckeditor()
        {
            ClassicEditor
                .create(document.querySelector('#ckeditor'))
                .then(editor => {
                    editor.ui.view.editable.element.style.height = '200px';
                })
                .catch(error => {
                    console.error(error);
                });
        }
    </script>
@endsection

