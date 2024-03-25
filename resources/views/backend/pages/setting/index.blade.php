
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
                            <a href="{{ route('admin.setting.create') }}" class="btn btn-success btn-sm">Yeni Slayd</a>
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
                                <th width="450">Key</th>
                                <th>Value</th>
                                <th width="250">Type</th>
                                <th width="50">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($settings && count($settings) > 0)
                                @foreach($settings as $setting)
                                    <tr id="row-{{ $setting->id }}">
                                        <td>{{ $setting->name }}</td>
                                        @if(substr($setting->content, 0, 13) === 'img/settings/')
                                            <td>
                                                <img src="{{ asset($setting->content) }}" alt="{{ $setting->name }}">
                                            </td>
                                        @else
                                            <td>{!! $setting->content !!}</td>
                                        @endif
                                        <td>{{ $setting->type }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('admin.setting.edit', $setting->id) }}"
                                               class="btn btn-warning btn-sm mr-2">
                                                Dəyişdir
                                            </a>
                                            <a href="javascript:void(0)"
                                               data-id="{{ $setting->id }}"
                                               class="delete btn btn-danger btn-sm">
                                                Sil
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">{{ $settings->withQueryString()->links() }}</div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {

            $('.delete').on('click', function () {
                let self = $(this);
                let id = self.data('id');
                alertify.confirm('Parametri Silmək istəyirsiz?',
                    function () {
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('admin.setting.delete')}}",
                            data: {
                                id: id,
                                _method: "DELETE"
                            },
                            success: function (data) {
                                if(data.status == 'ok')
                                {
                                    $('#row-'+id).remove();
                                    alertify.success('Parametr Silindi!');
                                }
                                else
                                {
                                    alertify.success('Parametr Silinmədi!');
                                }

                            },
                            error: function () {
                                alertify.error('Ajax Error!');
                            }
                        });
                    },
                    function () {
                        alertify.error('Parametr Silinmədi!')
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

