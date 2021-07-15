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
                        <h4 class="card-title">Input Role</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('admin/role/add_data') }}" >
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Name</label>
                                        <input type="text" id="" name="name" class="form-control round" name="role" placeholder="Role">
                                        <label for="">Permissions</label>
                                    </div>
                                </div>
                            </div>
                            <div class="checkbox">
                                @foreach ($permission as $item)
                                 <div class="form-check">
                                 <input class="form-check-input" type="checkbox" value="{{ $item->id }}" name="permission[]" id="flexCheckDefault">
                                 <label class="form-check-label" for="flexCheckDefault">
                                     {{ $item->name }}
                                 </label>
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
