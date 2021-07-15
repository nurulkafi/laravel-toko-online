@extends('admin.layouts.main');
@section('Categories','active')
@section('content')

    <section id="input-style">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Input Categories</h4>
                    </div>
                    <div class="card-body">
                        @error('categories')
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="bi bi-file-excel"></i>{{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                        @enderror
                        @if ($data->parent_id == 0)
                            <form method="post" action="{{ url('admin/categories/update_data/'.$data->id) }}" >
                                @csrf
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <input type="text" id="categories" class="form-control round" name="categories" placeholder="Categories" value="{{ $data->name }}">
                                    <input type="hidden" id="categories" class="form-control round" name="parent" placeholder="Categories" value="0">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </div>
                            </form>
                        @else
                            <form method="POST" action="{{ url('admin/categories/update_data/'.$data->id) }}"  >
                                @csrf
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label for="">Sub Category</label>
                                    <input type="text" id="categories" class="form-control round" value="{{ $data->name }}" name="categories" placeholder="Categories">
                                </div>
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select name="parent" id="" class="form-select round">
                                        <option value="{{ $data->parent_id }}">Kategori Sebelumnya : {{ $data->parent->name }}</option>
                                        {{-- @foreach ($data2 as $item)
                                            @if ($item->parent_id == 0 && $item->name != $data->parent->name)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif --}}
                                        {{-- @endforeach --}}
                                        @foreach ($data2 as $item)
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
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
