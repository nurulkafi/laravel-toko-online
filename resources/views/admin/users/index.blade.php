@extends('admin.layouts.main')
@section('Users','active')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">
            Roles
        </h4>
        <a href="{{ url('admin/users/add') }}" class="btn btn-info">Add</a>
    </div>
    <div class="card-content">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td>#</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Roles</td>
                    <td>Action</td>
                </tr>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        @if (!empty($item->getRoleNames()))
                            @foreach ($item->getRoleNames() as $role)
                               {{ $role }}
                            @endforeach
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('admin/users/edit/'.$item->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <a class="btn btn-sm btn-danger hapusUser" data-bs-toggle="modal" data-bs-target="#default" data-id="{{ $item->id }}">Delete</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
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
                <a class="btn btn-primary ml-1 yesHapusUsers">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Yes</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
