@extends('backend.layouts.app')
@section('title')
    Kontakt - Baxış
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title text-uppercase"><span class="text-warning">Mesaj</span> - {{ $contact->name }}</h4>
                        <p class="card-description">
                            <a href="{{ route('admin.contact.index') }}" class="btn btn-success btn-sm">Kontaktlar</a>
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

                    <div class="d-flex">
                        <div class="form-group mr-5">
                            <label for="titl" class="text-danger">Ad</label>
                            <p class="text-monospace lead">{{ $contact->name }}</p>
                        </div>

                        <div class="form-group">
                            <label for="title" class="text-danger">Başlıq</label>
                            <p class="text-monospace lead">{{ $contact->subject }}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="text-danger">Email</label>
                        <p class="text-monospace lead">{{ $contact->email }}</p>
                    </div>

                    <div class="form-group mb-5">
                        <label for="title" class="text-danger">Mesaj</label>
                        <p class="text-monospace lead">{!! $contact->message !!}</p>
                    </div>


                    <hr class="border mb-5">

                    <form class="forms-sample"
                          action="{{ route('admin.contact.update', $contact->id) }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <label for="status">Status</label>

                        <div class="form-group d-flex justify-content-between">
                            @php
                                $status = $contact->status ?? '1';
                            @endphp

                            <select class="form-select form-control col-5 text-primary " name="status" id="status"
                                    aria-label="Default select example">

                                <option value="0" {{$status=='0' ? 'selected' : ''}}>Passiv</option>
                                <option value="1" {{$status=='1' ? 'selected' : ''}}>Aktiv</option>
                            </select>
                            <button type="submit" class="btn btn-success col-5 mr-2 w-100">Güncəllə</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

