@extends('admin.layouts.main');
@section('content')
    <section id="input-style">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Input Categories</h4>
                    </div>
                    <div class="card-body">
                        @if ($data->parent_id == 0)
                            <form method="post" action="{{ url('admin/categories/update_data/'.$data->id) }}" >
                                @csrf
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <input type="text" id="categories" class="form-control round" name="categories" placeholder="Categories" value="{{ $data->name }}">
                                    <input type="text" id="categories" class="form-control round" name="parent" placeholder="Categories" value="0">
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
                                        <option value="{{ $data->parent_id }}">{{ $data->parent->name }}</option>
                                        @foreach ($data2 as $item)
                                            @if ($item->parent_id == 0 && $item->name != $data->parent->name)
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
