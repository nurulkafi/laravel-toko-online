@extends('admin.layouts.main')
@section('Orders','active')
@section('content')
<div class="row" id="table-bordered">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Table {{ $title }}</h4>
        </div>
        <div class="card-content">
            <div class="table-responsive">
                <table class="table table-bordered mb-0 data-table" id="table1">
                    <thead>
                        @can('list-care')

                        @endcan
                        <tr>
                            <th>#</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order as $item)
                            @if ($item->status == \App\Models\Order::CONFIRMED)
                            <tr class="table-info">
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->order_date }}</td>
                                <td>{{ $item->payment_status }}</td>
                                <td><a href="{{ url('admin/order/show/'.$item->id) }}" class="btn btn-info">Show</a></td>
                            </tr>
                            @else
                            <tr>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->order_date }}</td>
                                <td>{{ $item->payment_status }}</td>
                                <td><a href="{{ url('admin/order/show/'.$item->id) }}" class="btn btn-info">Show</a></td>
                            </tr>
                            @endif
                        @empty

                        @endforelse
                    </tbody>
                </table>
                {{-- modal --}}
                <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h5 class="modal-title white" id="myModalLabel1">Peringatan</h5>
                                <button type="button" class="close rounded-pill"
                                    data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Apakah Anda Yakin Akan Menghapus Data?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">NO</span>
                                </button>
                                <a class="btn btn-primary ml-1 yesHapusClickP">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Yes</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('simpleDataTable')
<script src="{{ asset('admin/assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
<script>
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
</script>
@endpush
@endsection
