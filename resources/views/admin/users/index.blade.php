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
                    <td>No</td>
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
                        <a href="{{ url('admin/role/edit/'.$item->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <button href="" class="btn btn-sm btn-danger">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
