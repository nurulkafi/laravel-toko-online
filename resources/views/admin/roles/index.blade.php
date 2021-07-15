@extends('admin.layouts.main')
@section('Role','active')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">
            Roles
        </h4>
        <a href="{{ url('admin/role/add') }}" class="btn btn-info">Add</a>
    </div>
    <div class="card-content">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td>No</td>
                    <td>Name</td>
                    <td>Action</td>
                </tr>
                @foreach ($role as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
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
