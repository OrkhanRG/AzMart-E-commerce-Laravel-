@extends('backend.layouts.app')
@section('title')
    @if(isset($setting))
        Slayd Güncəllə
    @else
        Slayd Yarat
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
                    <form class="forms-sample"
                          action="{{ isset($setting) ? route('admin.setting.edit', $setting->id) : route('admin.setting.create') }}"
                          method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="type">Type</label><select name="type" id="type" class="form-control col-4">
                                <option value="">Type seçin</option>
                                <option
                                    value="text" {{ isset($setting) && $setting->type == 'text' ? 'selected' : '' }}>
                                    text
                                </option>
                                <option
                                    value="textarea" {{ isset($setting) && $setting->type == 'textarea' ? 'selected' : '' }}>
                                    textarea
                                </option>
                                <option
                                    value="ckeditor" {{ isset($setting) && $setting->type == 'ckeditor' ? 'selected' : '' }}>
                                    ckeditor
                                </option>
                                <option
                                    value="email" {{ isset($setting) && $setting->type == 'email' ? 'selected' : '' }}>
                                    email
                                </option>
                                <option
                                    value="number" {{ isset($setting) && $setting->type == 'number' ? 'selected' : '' }}>
                                    number
                                </option>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="name">Key</label>
                            <input type="text" name="name" id="name" class="form-control"
                                   value="{{ isset($setting) ? $setting->name : '' }}" placeholder="key">
                        </div>
                        <div class="form-group">
                            <label for="#">Məzmun</label>
                            <div class="inputContent">
                                @if(isset($setting) && $setting->type === 'text')
                                    <input type="text" name="content" id="content" class="form-control"
                                           value="{{ isset($setting) ? $setting->content : '' }}">
                                @elseif(isset($setting) && $setting->type === 'textarea')
                                    <textarea name="content" id="content" rows="4" class="form-control"
                                              placeholder="Məzmunu daxil edin">{{ isset($setting) ? $setting->content : ''}}</textarea>
                                @elseif(isset($setting) && $setting->type === 'ckeditor')
                                    <textarea name="content" id="ckeditor" rows="4"
                                              class="form-control ck-editor__editable"
                                              placeholder="Məzmunu daxil edin">{{ isset($setting) ? $setting->content : ''}}</textarea>
                                @elseif(isset($setting) && $setting->type === 'email')
                                    <input type="email" name="content" id="content" class="form-control"
                                           value="{{ isset($setting) ? $setting->content : '' }}">
                                @elseif(isset($setting) && $setting->type === 'number')
                                    <input type="number" name="content" id="content" class="form-control"
                                           value="{{ isset($setting) ? $setting->content : '' }}">
                                @else
                                    <div class="alert alert-warning"><b class="text-primary">Type
                                            Seçilməyib!</b><br><br> Məzmunu boş göndərmək istəmirsizsə, zəhmət olmasa
                                        <b>Type</b> sahəsindən tipi seçiniz
                                    </div>
                                @endif
                            </div>
                        </div>

                        <button type="submit"
                                class="btn btn-primary mr-2">{{ isset($setting) ? 'Güncəllə' : 'Yarat' }}</button>
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
           ckediotr();
        });

        function ckediotr()
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

        $('#type').on('change', function (){
            let type = $(this).val();
            let value = "{!! isset($setting) ? $setting->content : '' !!}"
            let newElement;
            if (type === 'text') {
                newElement = $('<input>', {
                    type: "text",
                    class: "form-control",
                    name: "content",
                    id: "content",
                    value: value
                });
                $('.inputContent').empty().append(newElement);
            }
            else if(type === 'textarea') {
                newElement = $("<textarea></textarea>", {
                    class: "form-control",
                    name: "content",
                    id: "content",
                    rows: "4",
                }).val(value);
                $('.inputContent').empty().append(newElement);
            }
            else if(type === 'ckeditor') {
                newElement = $("<textarea></textarea>", {
                    class: "form-control ck-editor__editable",
                    name: "content",
                    id: "ckeditor",
                }).val(value);
                $('.inputContent').empty().append(newElement);
                ckediotr()
            }
            else if (type === 'email') {
                newElement = $('<input>', {
                    type: "email",
                    class: "form-control",
                    name: "content",
                    id: "content",
                    value: value
                });
                $('.inputContent').empty().append(newElement);
            }
            else if (type === 'number') {
                newElement = $('<input>', {
                    type: "number",
                    class: "form-control",
                    name: "content",
                    id: "content",
                    value: value
                });
                $('.inputContent').empty().append(newElement);
            }

        });
    </script>
@endsection

