@extends('admin.layouts.main');
@section('Categories','active')
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Input Categories</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('admin/categories/add_data') }}" >
                            @csrf
                            <div class="form-group">
                                <input type="text" id="categories" class="form-control round" name="categories" placeholder="Categories">

                            </div>
                            <div class="form-group">
                                <input type="hidden" id="categories" class="form-control round" name="parent" value="0" placeholder="Categories">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Input Sub Categories</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('admin/categories/add_data') }}" >
                            @csrf
                            <div class="form-group">
                                <label for="">Sub Category</label>
                                <input type="text" id="categories" class="form-control round" name="categories" placeholder="Categories">
                            </div>
                            <div class="form-group">
                                <label for="">Category</label>
                                <select name="parent" id="" class="form-select round">
                                    @foreach ($data as $item)
                                        {{-- @if ($item->parent_id == 0)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif --}}
                                        @if ($item->childs->count()>0)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @foreach ($item->childs as $subMenu)
                                                <option value="{{ $subMenu->id }}" style="margin-left: 5px">{{ $item->name }} / {{ $subMenu->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
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
