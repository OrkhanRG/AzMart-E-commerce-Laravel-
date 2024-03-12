@extends('backend.layouts.app')
@section('title', 'Slaydlar')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Kontakt Qutusu</h4>
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
                                <th>Ad</th>
                                <th>Başlıq</th>
                                <th>Email</th>
                                <th>Mesaj</th>
                                <th>İP</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($contacts && count($contacts) > 0)
                                @foreach($contacts as $contact)
                                    <tr id="row-{{ $contact->id }}">
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->subject }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ substr($contact->message, 0, 30) }} ...</td>
                                        <td>{{ $contact->ip }}</td>
                                        <td>
                                            <a href="javascript:void(0)" data-id="{{ $contact->id }}"
                                               class="status badge badge-{{ $contact->status == 1 ? 'success' : 'danger' }}">
                                                {{ $contact->status == 1 ? 'Aktiv' : 'Passiv' }}
                                            </a>
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('admin.contact.edit', $contact->id) }}"
                                               class="btn btn-outline-primary btn-sm mr-2"><i class="ti-eye"></i></a>
                                            <a href="javascript:void(0)" data-id="{{ $contact->id }}"
                                               class="delete btn btn-danger btn-sm">Sil</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">{{ $contacts->links() }}</div>

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
                alertify.confirm('Status', 'Statusu Dəyişmək istəyirsiz?',
                    function () {
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('admin.contact.status-change') }}",
                            data: {
                                id: id
                            },
                            success: function (data) {
                                if (data.status == 1) {
                                    self.removeClass('badge-danger').addClass('badge-success');
                                    self.text('Aktiv');
                                    alertify.success('Status Passivdən Aktivə Dəyişdirildi!');
                                }
                                if (data.status == 0) {
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
                alertify.confirm('Kontaktı Silmək istəyirsiz?',
                    function () {
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('admin.contact.delete')}}",
                            data: {
                                id: id,
                                _method: "DELETE"
                            },
                            success: function (data) {
                                if (data.status == 'ok') {
                                    $('#row-' + id).remove();
                                    alertify.success('Kontakt Silindi!');
                                } else {
                                    alertify.success('Kontakt Silinmədi!');
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
