@extends('backend.layouts.app')
@section('title')
    @if(isset($slide))
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
                        <h4 class="card-title">{{ isset($slide) ? 'Slaydı Güncəllə' : 'Yeni Slayd Yarat'}}</h4>
                        <p class="card-description">
                            <a href="{{ route('admin.slider.index') }}" class="btn btn-success btn-sm">Slaydlar</a>
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
                    <form class="forms-sample" action="{{ isset($slide) ? route('admin.slider.edit', $slide->id) : route('admin.slider.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($slide))
                            <div class="form-group">
                                <label for="title"><b class="text-warning">{{ isset($slide->image) ? 'Yüklü Şəkil' : 'Şəkil Yoxdur!' }}</b></label>
                                <div><img width="100" src="{{ asset(isset($slide->image) ? $slide->image : '/img/sliders/default.png') }}" alt=""></div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="title">Başlıq</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ isset($slide) ? $slide->title : '' }}" placeholder="Slayd başlığı">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Məzmun</label>
                            <textarea name="description" id="decription" rows="4" class="form-control" placeholder="Məzmunu daxil edin">{{ isset($slide) ? $slide->description : ''}}</textarea>
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
                            <label for="title">Link</label>
                            <input type="text" name="link" id="link" class="form-control" value="{{ isset($slide) ? $slide->link : '' }}" placeholder="Slayd Linki">
                        </div>
                        <div class="form-group">
                            @php
                                $status = $slide->status ?? '1';
                            @endphp
                            <select class="form-select" name="status" id="status" aria-label="Default select example">
                                <option value="0" {{$status=='0' ? 'selected' : ''}}>Passiv</option>
                                <option value="1" {{$status=='1' ? 'selected' : ''}}>Aktiv</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">{{ isset($slide) ? 'Güncəllə' : 'Yarat' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

