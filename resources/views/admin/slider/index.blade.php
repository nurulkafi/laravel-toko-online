@extends('admin.layouts.main')
@section('Slider','active')
@section('content')
<div class="row" id="table-bordered">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6"><h4 class="card-title">Table {{ $title }}</h4></div>
                <div class="col-md-6">
                    <a href="slider/add" class="btn btn-primary float-end">Add Slider</a>
                </div>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body" style="margin-top:-40px">
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($slider as $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->product($item->product_id)->name }}</td>
                                <td>
                                    @if ($item->status == 0)
                                        Draft
                                    @elseif($item->status == 1)
                                        Active
                                    @else
                                        Inactive
                                    @endif
                                </td>
                                <td>
                                    <a href="slider/edit/{{ $item->id }}" class="btn btn-sm btn-info">Edit</a>
                                    <a class="btn btn-sm btn-danger hapusSlider" data-bs-toggle="modal" data-bs-target="#default" data-id="{{ $item->id }}">Delete</a>
                                </td>
                            </tr>
                            @endforeach
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
                                    <a class="btn btn-primary ml-1 yesHapusSlider">
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
</div>
@push('simpleDataTable')
<script src="{{ asset('admin/assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
<script>
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
</script>
@endpush
@endsection
