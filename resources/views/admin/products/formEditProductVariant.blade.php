@extends('admin.layouts.main');
@section('Product','active')
@section('content')
    <section id="input-style">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6"><h4 class="card-title">Product</h4></div>
                        </div>
                    </div>
                    <div class="card-body">
                                <table id="variant_table" class="table table-bordered mb-0">
                                    <tr>
                                        <td>Color</td>
                                        <td>Size</td>
                                        <td>Type</td>
                                        <td>Harga</td>
                                        <td>Qty</td>
                                        <td>Action</td>
                                    </tr>
                                    <tbody>
                                        @for ($i = 0; $i < count($data)/3; $i++)
                                            @php
                                                $index = $i * 3
                                            @endphp
                                            <tr>
                                            @for ($j = $index; $j < 3 * ($i + 1); $j++)
                                                <td>{{$data[$j]->name}}
                                                    <input type="hidden" id="option_id" value="{{ $data[$j]->product_option_value_id }}">
                                                </td>
                                            @endfor
                                                <td>{{$data[$i*3]->price}}</td>
                                                <td>{{$data[$i*3]->qty}}</td>
                                                <td>
                                                    <input type="hidden" id="sku_id" value="{{ $data[$i*3]->product_sku_id }}">
                                                    <a id="editBtn" class="btn btn-info">edit</a>
                                                </td>
                                            <tr>
                                        @endfor
                                    </tbody>
                                </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('admin/product_variant/update') }}" method="POST">
                            @csrf{{ method_field('PUT') }}
                            <div class="form-group">
                                <label for="">Color</label>
                                <input id="color" name="value_name[]" type="text" class="form-control">
                                <input type="hidden" name="option_id[]" id="warnaoption_id">
                            </div>
                            <div class="form-group">
                                <label for="">Size</label>
                                <input id="size" name="value_name[]"  type="text" class="form-control">
                                <input type="hidden" name="option_id[]" id="sizeoption_id">
                            </div>
                            <div class="form-group">
                                <label for="">Type</label>
                                <input id="type" name="value_name[]"  type="text" class="form-control">
                                <input type="hidden" name="option_id[]" id="typeoption_id">
                            </div>
                            <div class="form-group">
                                <label for="">Harga</label>
                                <input id="harga"  name="price" type="text" class="form-control">
                                <input type="hidden" name="sku_id" id="insku_id">
                            </div>
                            <div class="form-group">
                                <label for="">Qty</label>
                                <input id="qty" name="qty"  type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@push('simditor')
<script>
    $(document).ready(function () {
        $("#variant_table").on('click','#editBtn',function(){
         // get the current row
         var currentRow=$(this).closest("tr");

         var warnaIn=currentRow.find("td:eq(0) input[type='hidden']").val();
         var sizeIn=currentRow.find("td:eq(1) input[type='hidden']").val();
         var typeIn=currentRow.find("td:eq(2) input[type='hidden']").val();
         var skuIn=currentRow.find("td:eq(5) input[type='hidden']").val();
         var warna=currentRow.find("td:eq(0)").text();
         var size=currentRow.find("td:eq(1)").text();
         var type=currentRow.find("td:eq(2)").text();
         var harga=currentRow.find("td:eq(3)").text();
         var qty=currentRow.find("td:eq(4)").text();
         $('#color').val(warna);
         $('#size').val(size);
         $('#type').val(type);
         $('#harga').val(harga);
         $('#qty').val(qty);
         $('#warnaoption_id').val(warnaIn);
         $('#sizeoption_id').val(sizeIn);
         $('#typeoption_id').val(typeIn);
         $('#insku_id').val(skuIn);

    });
        // no = 0;
        // index = 0;
        // $("#addImages").on('click',function () {
        //     var html = '';
        //     html += '<div id="form-group" style="margin-top:2px">';
        //     html += '<input type="file" name="image[]" class="form-control">';
        //     html += '</div>';
        //     console.log(html);

        //     $("#gambar").append(html);
        // });
        // $('#btnAdd').on('click',function () {

        //     no = no+1;
        //     color = $('#color').val();
        //     size = $('#size').children('option:selected').val();
        //     tipeselect = $("input[name='tipe']:checked").val();
        //     harga = $('#harga').val();
        //     qty = $('#qty').val();
        //     action = '<button id="btnRemove" class="btn icon btn-danger"><i class="bi bi-trash"></i></button>';

        //     optionidcolor = '<input type="hidden"  value="1" name="option_id[]">';
        //     valueIDcolor = '<input type="hidden"  value="'+(index+1)+'" name="value_id[]">';
        //     valueNamecolor = '<input  type="hidden" value="'+color+'" name="value_name[]">';

        //     optionidsize = '<input type="hidden"  value="2" name="option_id[]">';
        //     valueIDsize = '<input type="hidden"  value="'+(index+2)+'" name="value_id[]">';
        //     valueNamesize = '<input  type="hidden" value="'+size+'" name="value_name[]">';
        //     if(tipeselect === undefined || tipeselect === " " || tipeselect === ""){
        //         tipeselect = " "
        //         optionidtype = '<input type="hidden"  value="0" name="option_id[]">';
        //         valueIDtype = '<input type="hidden"  value="0" name="value_id[]">';
        //         valueNametype = '<input  type="hidden" value="0" name="value_name[]">';
        //     }else{
        //         optionidtype = '<input type="hidden"  value="3" name="option_id[]">';
        //         valueIDtype = '<input type="hidden"  value="'+(index+3)+'" name="value_id[]">';
        //         valueNametype = '<input  type="hidden" value="'+tipeselect+'" name="value_name[]">';
        //     }
        //     inputHarga = '<input type="hidden"  value="'+harga+'" name="price[]">';
        //     inputqty = '<input type="hidden"  value="'+harga+'" name="qty[]">';

        //     all = '<tr>';
        //     all += '<td>' +no+ '</td>'
        //     all += '<td>' +color+ optionidcolor + valueIDcolor+valueNamecolor+'</td>'
        //     all += '<td>' +size+ optionidsize + valueIDsize+valueNamesize+'</td>'
        //     all += '<td>' +tipeselect+optionidtype + valueIDtype+valueNametype+ '</td>'
        //     all += '<td>' +harga+inputHarga+'</td>'
        //     all += '<td>' +qty+inputqty+'</td>'
        //     all += '<td>' +action+'</td>'
        //     all += '</tr>'

        //     $('#variant_table').append(all);
        //         index = index+3;
        //     });
        // $("#variant_table").on("click", "#btnRemove", function() {
        //     $(this).closest("tr").remove();
        //     index = index-3;
        //     no = no-1;
        // });
        // $('#btnAdd').on('click',function(){
        //     $('#variant_table tbody').
        // });
    });
</script>
@endpush

@endsection
