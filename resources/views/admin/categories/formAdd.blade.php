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
                        <form method="POST" action="{{ url('admin/categories/add_data') }}" >
                            @csrf
                            <div class="form-group">
                                <input type="text" id="categories" class="form-control round" name="categories" placeholder="Categories">
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
