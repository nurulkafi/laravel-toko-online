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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Input Slider</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('admin/slider/add_data') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Product</label>
                                <select name="product_id" id="" class="form-select">
                                    @forelse ($product as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @empty
                                        empty!
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Status">Status</label>
                                <select name="status" class="form-select" id="">
                                    <option value="0">Draft</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Slider Images</label>
                                <input type="file" accept="image/*" onchange="loadFile(event)" name="image" class="form-control">
                                <img id="output" width="250" class="img-thumbnail rounded mx-auto d-block" height="250" style="margin-top:20px;margin-bottom:20px">
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
@push('simditor')
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };

</script>
@endpush
@endsection
