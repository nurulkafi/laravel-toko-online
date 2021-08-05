@extends('admin.layouts.main');
@section('sub-product', 'has-sub')
@section('submenu-product')
<ul class="submenu ">
    <li class="submenu-item">
        <a href="{{ url('admin/product') }}">Table Product</a>
    </li>
    <li class="submenu-item ">
        <a href="{{ url('admin/product/edit/'.$productimg[0]->product_id) }}">Product Info</a>
    </li>
    <li class="submenu-item active">
        <a href="{{ url('admin/product/images/edit/'.$productimg[0]->product_id) }}">Product Images</a>
    </li>
    <li class="submenu-item ">
        <a href="{{ url('admin/product/atribute/edit/'.$productimg[0]->product_id) }}">Product Atribute</a>
    </li>
</ul>
@endsection
@section('content')
<section id="input-style">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Product Image</h4>
                            <small>Image Max 5</small>
                        </div>
                        @if (count($productimg) < 5)
                        <div class="col-md-6">
                            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#inlineForm">Add Image</button>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-responsive table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($productimg as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><img width="150" height="150" src="{{ asset('storage/'.$item->path) }}" alt="" class="img-thumbnail"></td>
                            <td><button type="button" class="btn btn-sm rounded-pill btn-danger hapusClickPImage" data-bs-toggle="modal" data-bs-target="#default" data-id="{{ $item->id }}">Delete</button></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- modal add --}}
    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add Image </h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ url('admin/product/images/add/'.$productimg[0]->product_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                         <input type="file" accept="image/*" onchange="loadFile(event)" name="image" class="form-control">
                        <img id="output" width="250" class="img-thumbnail rounded mx-auto d-block" height="250" style="margin-top:20px;margin-bottom:20px">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                            data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Save</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title white" id="myModalLabel1">Peringatan</h5>
                    <button type="button" class="close rounded-pill"
                        data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Apakah Anda Yakin Akan Menghapus Data?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">NO</span>
                    </button>
                    <a class="btn btn-primary ml-1 yesHapusClickImage">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Yes</span>
                    </a>
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
