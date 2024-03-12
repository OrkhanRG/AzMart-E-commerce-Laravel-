
@extends('backend.layouts.app')
@section('title', 'Slaydlar')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Slider</h4>
                        <p class="card-description">
                            <a href="{{ route('admin.slider.create') }}" class="btn btn-success btn-sm">Yeni Slayd</a>
                        </p>
                    </div>
                    @if(session()->get('success'))
                        <div class="alert alert-success">{{ session()->get('success') }}</div>
                    @endif
                    @if(session()->get('error'))
                        <div class="alert alert-danger">{{ session()->get('error') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Şəkil</th>
                                <th>Başlıq</th>
                                <th>Məzmun</th>
                                <th>Status</th>
                                <th>Link</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($sliders && count($sliders) > 0)
                                @foreach($sliders as $slider)
                                    <tr id="row-{{ $slider->id }}">
                                        <td class="py-1">
                                            <img src="{{ asset($slider->image) }}" alt="image">
                                        </td>
                                        <td>{{ $slider->title }}</td>
                                        <td>{{ substr($slider->description,0,100) }}...</td>
                                        <td>
                                            <a href="javascript:void(0)" data-id="{{ $slider->id }}"
                                               class="status badge badge-{{ $slider->status == 1 ? 'success' : 'danger' }}">
                                                {{ $slider->status == 1 ? 'Aktiv' : 'Passiv' }}
                                            </a>
                                        </td>
                                        <td>{{ $slider->link }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('admin.slider.edit', $slider->id) }}"
                                               class="btn btn-warning btn-sm mr-2">Dəyişdir</a>
                                            <a href="javascript:void(0)" data-id="{{ $slider->id }}"
                                               class="delete btn btn-danger btn-sm">Sil</a>
                                            {{--<form action="{{ route('admin.slider.delete', $slider->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                                            </form>--}}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">{{ $sliders->links() }}</div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.status').on('click', function () {
                let self = $(this);
                let id = self.data('id');
                alertify.confirm('Statusu Dəyişmək istəyirsiz?',
                    function () {
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('admin.slider.status-change') }}",
                            data: {
                                id: id
                            },
                            success: function (data) {
                                if(data.status == 1)
                                {
                                    self.removeClass('badge-danger').addClass('badge-success');
                                    self.text('Aktiv');
                                    alertify.success('Status Passivdən Aktivə Dəyişdirildi!');
                                }
                                if(data.status == 0)
                                {
                                    self.removeClass('badge-success').addClass('badge-danger');
                                    self.text('Passiv');
                                    alertify.success('Status Aktivdən Passivə Dəyişdirildi!');
                                }

                            },
                            error: function () {
                                alertify.error('Status dəyişdirilmədi!');
                            }
                        });
                    },
                    function () {
                        alertify.error('Status dəyişdirilmədi!')
                    }).set({
                    labels: {
                        ok: 'Bəli',
                        cancel: 'Xeyr'
                    }
                });
            });

            $('.delete').on('click', function () {
                let self = $(this);
                let id = self.data('id');
                alertify.confirm('Slaydı Silmək istəyirsiz?',
                    function () {
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('admin.slider.delete')}}",
                            data: {
                                id: id,
                                _method: "DELETE"
                            },
                            success: function (data) {
                                if(data.status == 'ok')
                                {
                                    $('#row-'+id).remove();
                                    alertify.success('Slayd Silindi!');
                                }
                                else
                                {
                                    alertify.success('Slayd Silinmədi!');
                                }

                            },
                            error: function () {
                                alertify.error('Xəta');
                            }
                        });
                    },
                    function () {
                        alertify.error('Slayd Silinmədi!')
                    }).set({
                    labels: {
                        ok: 'Bəli',
                        cancel: 'Xeyr'
                    }
                });
            });
        })
    </script>
@endsection

