@extends('admin.layouts.main');
@section('sub-product', 'has-sub')
@section('submenu-product')
<ul class="submenu ">
    <li class="submenu-item">
        <a href="{{ url('admin/product') }}">Table Product</a>
    </li>
    <li class="submenu-item ">
        <a href="{{ url('admin/product/edit/'.$product[0]->product_id) }}">Product Info</a>
    </li>
    <li class="submenu-item ">
        <a href="{{ url('admin/product/images/edit/'.$product[0]->product_id) }}">Product Images</a>
    </li>
    <li class="submenu-item active">
        <a href="{{ url('admin/product/atribute/edit/'.$product[0]->product_id) }}">Product Atribute</a>
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
                            <div class="col-md-6"><h4 class="card-title">Product Attributes</h4></div>
                            <div class="col-md-6">
                                <button class="btn btn-primary float-end" id="addData" data-bs-toggle="modal" data-bs-target="#inlineForm">Add Attribute</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                            @php
                                $i=1
                            @endphp
                            @foreach ($product as $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->size }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>
                                    <button class="btn rounded-pill btn-sm btn-info editData" type="button"  data-bs-toggle="modal" data-bs-target="#inlineForm" data-id="{{ $item->id }}"> Edit </button>
                                    <button class="btn btn-sm rounded-pill btn-danger hapusClickPAtribute" data-bs-toggle="modal" data-bs-target="#default" data-id="{{ $item->id }}"> Delete </button>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Add Product Attribute</h4>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form method="POST" id="formAttr">
                        @csrf
                        <div id="method">

                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="product_id" value="{{ $product[0]->product_id }}">
                            <div class="form-group">
                                <label for="">Size</label>
                                <input id="size" type="text" name="size" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Price</label>
                                <input id="price" type="text" name="price" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Stock</label>
                                <input id="qty" type="text" name="qty" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="reset" class="btn btn-light-secondary" data-bs-dismiss="modal">
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
                        <a class="btn btn-primary ml-1 yesHapusClickAtribute">
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
    $(document).ready(function () {
        $('#addData').on('click',function() {
            $('#formAttr').attr('action','../add');
        });
        $('.editData').on('click',function() {
            const id = $(this).data('id');
            $('#formAttr').attr('action','../update/'+id);
            var size = $(this).closest("tr").find('td:eq(1)').text();
            var price = $(this).closest("tr").find('td:eq(2)').text();
            var stock = $(this).closest("tr").find('td:eq(3)').text();
            $('#size').val(size);
            $('#price').val(price);
            $('#qty').val(stock);
            $('#method').append("<input type='hidden' name='_method' value='PUT'>");
        });
        $('.hapusClickPAtribute').on('click', function () {
        const id = $(this).data('id');
        $('.yesHapusClickAtribute').on('click', function () {
            $(this).attr('href', "../../../../admin/product/atribute/delete/" + id);
        });
    })
    });
</script>
@endpush

@endsection
