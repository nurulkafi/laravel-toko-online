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
                        <form method="post" action="{{ url('admin/categories/update_data/'.$data->id) }}" >
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <input type="text" id="categories" class="form-control round" name="categories" placeholder="Categories" value="{{ $data->name }}">
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
