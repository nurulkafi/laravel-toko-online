@extends('admin.layouts.main')
@section('Orders','active')
@section('content')
<div class="row" id="table-bordered">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Table {{ $title }}</h4>
        </div>
        <div class="card-content">
            <div class="card-body" style="margin-top:-40px">
                {{-- @can('product-add') --}}
                <a href="product/add" class="btn btn-primary">
                    <span>Tambah Data</span>
                </a>
                {{-- @endcan --}}
            </div>
            <div class="table-responsive">
                <table class="table table-bordered mb-0 data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
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
@push('order')
<script type="text/javascript">
  $(function () {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('orders.index') }}",
        columns: [
            {data: 'code', name: 'code'},
            {data: 'status', name: 'status'},
            {data: 'order_date', name: 'order_date'},
            {data: 'payment_status', name: 'payment_status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
</script>
@endpush
@endsection
