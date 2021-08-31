@extends('admin.layouts.main')
@section('Categories','active')
@section('content')
<div class="row" id="table-bordered">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6"><h4 class="card-title">Table {{ $title }}</h4></div>
                <div class="col-md-6">
                    <a href="categories/add" class="btn btn-primary float-end">Add Category</a>
                </div>
            </div>
        </div>
        <div class="card-content">
            <div class="table-responsive">
                <table class="table table-bordered mb-0" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Parent ID</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>{{ $item->parent_id }}</td>
                            <td>
                                <a href="categories/edit/{{ $item->id }}" class="btn btn-sm btn-info">Edit</a>
                                <a class="btn btn-sm btn-danger hapusClick" data-bs-toggle="modal" data-bs-target="#default" data-id="{{ $item->id }}">Delete</a>
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
                                <a class="btn btn-primary ml-1 yesHapusClick">
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
