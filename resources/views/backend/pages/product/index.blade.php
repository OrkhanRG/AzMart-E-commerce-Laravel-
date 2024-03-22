
@extends('backend.layouts.app')
@section('title', 'Məhsullar')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Products</h4>
                        <p class="card-description">
                            <a href="{{ route('admin.product.create') }}" class="btn btn-success btn-sm">Yeni Məhsul</a>
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
                                <th>Ad</th>
                                <th>Qısa Məzmun</th>
                                <th>Məzmun</th>
                                <th>Price</th>
                                <th>Kateqoriya</th>
                                <th>Ölçü</th>
                                <th>Rəng</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($products && count($products) > 0)
                                @foreach($products as $product)
                                    <tr id="row-{{ $product->id }}">
                                        <td class="py-1">
                                            <img src="{{ asset($product->image) }}" alt="image">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->short_name }}</td>
                                        <td>
                                            <a href="javascript:void(0)" style="text-decoration:none" class="text-primary">
                                                <i class="ti-eye"  data-toggle="modal" data-target="#productModal{{$product->id}}" style="font-size: 20px;"></i>
                                            </a>
                                        </td>

                                        <td>{{ $product->price }} &#8380;</td>
                                        <td>{{ $product->categories->name ?? ''}}</td>
                                        <td>{{ $product->size }}</td>
                                        <td>{{ $product->color }}</td>
                                        <td>
                                            <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                               class="status badge badge-{{ $product->status == 1 ? 'success' : 'danger' }}">
                                                {{ $product->status == 1 ? 'Aktiv' : 'Passiv' }}
                                            </a>
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('admin.product.edit', $product->id) }}"
                                               class="btn btn-warning btn-sm mr-2">Dəyişdir</a>
                                            <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                               class="delete btn btn-danger btn-sm">Sil</a>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="productModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-warning" id="exampleModalLabel"><span class="text-black">Məzmun -</span> {{ $product->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! $product->content !!}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">{{ $products->withQueryString()->links() }}</div>

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
                            url: "{{ route('admin.product.status-change') }}",
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
                alertify.confirm('Sil' ,'Slaydı Silmək istəyirsiz?',
                    function () {
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('admin.product.delete')}}",
                            data: {
                                id: id,
                                _method: "DELETE"
                            },
                            success: function (data) {
                                if(data.status === 'ok')
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

