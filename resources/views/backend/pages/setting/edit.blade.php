@extends('backend.layouts.app')
@section('title')
    @if(isset($setting))
        Slayd Güncəllə
    @else
        Slayd Yarat
    @endif
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">{{ isset($setting) ? 'Parametri Güncəllə' : 'Yeni Slayd Yarat'}}</h4>
                        <p class="card-description">
                            <a href="{{ route('admin.setting.index') }}" class="btn btn-success btn-sm">Parametrlər</a>
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
                    <form class="forms-sample" action="{{ isset($setting) ? route('admin.setting.edit', $setting->id) : route('admin.setting.create') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="type">Type</label><select name="type" id="type" class="form-control col-4">
                                <option value="">Type seçin</option>
                                <option value="text" {{ isset($setting) && $setting->type == 'text' ? 'selected' : '' }}>text</option>
                                <option value="textarea" {{ isset($setting) && $setting->type == 'textarea' ? 'selected' : '' }}>textarea</option>
                                <option value="ckeditor" {{ isset($setting) && $setting->type == 'ckeditor' ? 'selected' : '' }}>ckeditor</option>
                                <option value="email" {{ isset($setting) && $setting->type == 'email' ? 'selected' : '' }}>email</option>
                                <option value="number" {{ isset($setting) && $setting->type == 'number' ? 'selected' : '' }}>number</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="name">Key</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ isset($setting) ? $setting->name : '' }}" placeholder="key">
                        </div>
                        <div class="form-group">
                            <label for="content">Məzmun</label>
                            <textarea name="content" id="content" rows="4" class="form-control" placeholder="Məzmunu daxil edin">{{ isset($setting) ? $setting->content : ''}}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">{{ isset($setting) ? 'Güncəllə' : 'Yarat' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

