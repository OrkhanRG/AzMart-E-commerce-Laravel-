@extends('backend.layouts.app')
@section('title', 'Slaydlar')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Kateqoriyalar</h4>
                        <p class="card-description">
                            <a href="{{ route('admin.category.create') }}" class="btn btn-success btn-sm">Yeni Kateqoriya</a>
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
                                <th>Kateqoriya Adı</th>
                                <th>Status</th>
                                <th>Üst Kateqoriya</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($categories && count($categories) > 0)
                                @foreach($categories as $category)
                                    <tr id="row-{{ $category->id }}">
                                        <td class="py-1">
                                            <img src="{{ asset($category->image) }}" alt="image">
                                        </td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <a href="javascript:void(0)" data-id="{{ $category->id }}"
                                               class="status badge badge-{{ $category->status == 1 ? 'success' : 'danger' }}">
                                                {{ $category->status == 1 ? 'Aktiv' : 'Passiv' }}
                                            </a>
                                        </td>
                                        <td>{{ $category->category->name ?? ''}}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('admin.category.edit', $category->id) }}"
                                               class="btn btn-warning btn-sm mr-2">Dəyişdir</a>
                                            <a href="javascript:void(0)" data-id="{{ $category->id }}"
                                               class="delete btn btn-danger btn-sm">Sil</a>
                                            {{--<form action="{{ route('admin.slider.delete', $category->id) }}"
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
                    <div class="d-flex justify-content-center mt-4">{{ $categories->links() }}</div>

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
                            url: "{{ route('admin.category.status-change') }}",
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
                alertify.confirm('Kateqoriyanı Silmək istəyirsiz?',
                    function () {
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('admin.category.delete')}}",
                            data: {
                                id: id,
                                _method: "DELETE"
                            },
                            success: function (data) {
                                if(data.status == 'ok')
                                {
                                    $('#row-'+id).remove();
                                    alertify.success('Kateqoriya Silindi!');
                                }
                                else
                                {
                                    alertify.success('Kateqoriya Silinmədi!');
                                }

                            },
                            error: function () {
                                alertify.error('Xəta');
                            }
                        });
                    },
                    function () {
                        alertify.error('Kateqoriya Silinmədi!')
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

