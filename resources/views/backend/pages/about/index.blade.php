@extends('backend.layouts.app')
@section('title')
    Haqqımızda / Güncəllə
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Haqqımızda Güncəllə</h4>
                        <button class="btn btn-danger imgDelete">Şəkli Sil</button>
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
                          action="{{ route('admin.about.edit') }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($about))
                            <div class="form-group">
                                <label for="title"><b
                                        class="text-warning">{{ isset($about->image) ? 'Yüklü Şəkil' : 'Şəkil Yoxdur!' }}</b></label>
                                <div><img width="300" class="img"
                                          src="{{ asset(isset($about->image) ? $about->image : '/img/about/default.png') }}"
                                          alt=""></div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="title">Başlıq</label>
                            <input type="text" name="name" id="name" class="form-control"
                                   value="{{ isset($about) ? $about->name : '' }}" placeholder="Haqqımızda başlığı">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Məzmun</label>
                            <textarea name="content" id="content" rows="4" class="form-control"
                                      placeholder="Məzmunu daxil edin">{{ isset($about) ? $about->content : ''}}</textarea>
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
                            <label for="title">Text 1</label>
                            <input type="text" name="text_1" id="text_1" class="form-control"
                                   value="{{ isset($about) ? $about->text_1 : '' }}" placeholder="Haqqımızda text 1">
                        </div>
                        <div class="form-group">
                            <label for="title">Text 1 İkon</label>
                            <input type="text" name="text_1_icon" id="text_1_icon" class="form-control"
                                   value="{{ isset($about) ? $about->text_1_icon : '' }}"
                                   placeholder="Haqqımızda text 1 icon">
                        </div>
                        <div class="form-group">
                            <label for="title">Text 1 Məzmun</label>
                            <input type="text" name="text_1_content" id="text_1_content" class="form-control"
                                   value="{{ isset($about) ? $about->text_1_content : '' }}"
                                   placeholder="Haqqımızda text 1 content">
                        </div>

                        <div class="form-group">
                            <label for="title">Text 2</label>
                            <input type="text" name="text_2" id="text_2" class="form-control"
                                   value="{{ isset($about) ? $about->text_2 : '' }}" placeholder="Haqqımızda text 2">
                        </div>
                        <div class="form-group">
                            <label for="title">Text 2 İkon</label>
                            <input type="text" name="text_2_icon" id="text_2_icon" class="form-control"
                                   value="{{ isset($about) ? $about->text_2_icon : '' }}"
                                   placeholder="Haqqımızda text 2 icon">
                        </div>
                        <div class="form-group">
                            <label for="title">Text 2 Məzmun</label>
                            <input type="text" name="text_2_content" id="text_2_content" class="form-control"
                                   value="{{ isset($about) ? $about->text_2_content : '' }}"
                                   placeholder="Haqqımızda text 2 content">
                        </div>

                        <div class="form-group">
                            <label for="title">Text 3</label>
                            <input type="text" name="text_3" id="text_3" class="form-control"
                                   value="{{ isset($about) ? $about->text_3 : '' }}" placeholder="Haqqımızda text 3">
                        </div>
                        <div class="form-group">
                            <label for="title">Text 3 İkon</label>
                            <input type="text" name="text_3_icon" id="text_3_icon" class="form-control"
                                   value="{{ isset($about) ? $about->text_3_icon : '' }}" placeholder="Haqqımızda text 3 icon">
                        </div>
                        <div class="form-group">
                            <label for="title">Text 3 Məzmun</label>
                            <input type="text" name="text_3_content" id="text_3_content" class="form-control"
                                   value="{{ isset($about) ? $about->text_3_content : '' }}" placeholder="Haqqımızda text 3 content">
                        </div>


                        <button type="submit"
                                class="btn btn-primary mr-2">{{ isset($about) ? 'Güncəllə' : 'Yarat' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.imgDelete').on('click', function (){
            let self = $(this);

            alertify.confirm('Şəkil', 'Şəkili Silmək istədiyinizə əminsiz?',
                function () {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('admin.about.img-delete')}}",
                        data: {
                            _method: "DELETE"
                        },
                        success: function (data) {
                            if(data.status == 'ok')
                            {
                                alertify.success('Şəkil Silindi!');
                                $('.img').attr('src', "{{ asset('/img/about/default.png') }}");
                            }
                            if (data.status == 'no')
                            {
                                alertify.error('Şəkil yoxdur!');
                            }
                        },
                        error: function () {
                            alertify.error('Xəta');
                        }
                    });
                },
                function () {
                    alertify.error('Şəkil Silinmədi!')
                }).set({
                labels: {
                    ok: 'Bəli',
                    cancel: 'Xeyr'
                }
            });
        })
    </script>
@endsection



