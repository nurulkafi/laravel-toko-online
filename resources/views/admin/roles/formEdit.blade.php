@extends('admin.layouts.main');
@section('Role','active')
@section('content')
    @error('categories')
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="bi bi-file-excel"></i>{{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
    @enderror
    <section id="input-style">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Role</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('admin/role/update_data/'.$role->id) }}" >
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Name</label>
                                        <input type="text" id="" value="{{ $role->name }}" name="name" class="form-control round" name="role" placeholder="Role">
                                        <label for="">Permissions</label>
                                    </div>
                                </div>
                            </div>
                            <div class="checkbox">
                                @foreach ($permission as $item)
                                 <div class="form-check">
                                 @if (in_array($item->id,$rolePermission))
                                    <input class="form-check-input" type="checkbox" value="{{ $item->id }}" name="permission[]" id="flexCheckDefault" checked>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $item->name }}
                                    </label>
                                 @else
                                    <input class="form-check-input" type="checkbox" value="{{ $item->id }}" name="permission[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $item->name }}
                                    </label>
                                 @endif
                                 </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
