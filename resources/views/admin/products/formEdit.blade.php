@extends('admin.layouts.main');
@section('Product','active')
@section('content')
    <section id="input-style">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6"><h4 class="card-title">Product</h4></div>
                            <div class="col-md-6">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="{{ url('admin/product_variant/edit/'.$data2->id) }}" class="btn btn-primary me-md-2">Edit Product Variant</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('admin/product/add_data') }}" enctype="multipart/form-data" >
                            @csrf
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" id="name" value="{{ $data2->name }}" class="form-control round" name="name" >
                                </div>
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select name="parent" id="" class="form-select round">
                                        @foreach ($cats as $item)
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
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea type="text" class="form-control round" name="description"  id="editor">{!! $data2->description !!}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="berat">Berat</label>
                                    <input type="text" id="berat" class="form-control round" value="{{ $data2->weight }}" name="weight">
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
                                    <label for="">Gambar</label>
                                    <div class="row">
                                        @for ($i = 0; $i < count($img); $i++)
                                        <div class="col-md-2">
                                            <input type="hidden" value="{{ $img[$i]->path }}" class="form-control" name="image[]">
                                            <img class="img-thumbnail" height="200" width="200" src="{{ asset('storage/'.$img[$i]->path) }}" alt="">
                                        </div>
                                        @endfor
                                    </div>
                                    <div id="gambar"></div>
                                </div>
                                <div class="form-group">
                                    <button id="addImages" class="btn btn-outline-success btn-sm" type="button">Tambah Foto</button>
                                </div>
                                <div class="form-group">
                                    <br>
                                    <h4>Product Variant</h4>
                                </div>
                                <div class="form-group">
                                    <label for="">Color</label>
                                    <input type="text" id="color" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Size</label>
                                    <select name="" id="size" class="form-select">
                                        <option value="XS">XS</option>
                                        <option value="S">S</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <br>
                                    <input type="radio" class="btn-check" name="tipe" id="short"
                                    autocomplete="off" value="short">
                                    <label class="btn btn-outline-dark" for="short">Short</label>

                                    <input type="radio" class="btn-check" name="tipe"  id="Long"
                                        autocomplete="off" value="long">
                                    <label class="btn btn-outline-dark" for="Long">Long</label>
                                    <input type="radio" class="btn-check"name="tipe"  id="No"
                                        autocomplete="off" value=" ">
                                    <label class="btn btn-outline-dark" for="No">No Type</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <input type="text" id="harga" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Qty</label>
                                    <input type="text" id="qty" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" id="btnAdd" type="button">Add</button>
                                </div>
                                <table id="variant_table" class="table table-bordered mb-0">
                                    <tr>
                                        {{-- <td>No</td> --}}
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
                                                <td>
                                                    {{ $data[$j]->name}}
                                                </td>
                                            @endfor
                                                <td>{{ $data[$i*3]->price }}</td>
                                                <td>{{ $data[$i*3]->qty }}</td>
                                            <tr>
                                        @endfor
                                    </tbody>
                                </table>
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
    CKEDITOR.replace('description', {
					// Define the toolbar groups as it is a more accessible solution.
					toolbarGroups: [
						{ "name": 'document', "groups": [ 'mode', 'document', 'doctools' ] },
                        { "name": 'clipboard', "groups": [ 'clipboard', 'undo' ] },
                        { "name": 'editing', "groups": [ 'find', 'selection', 'spellchecker', 'editing' ] },
                        { "name": 'forms', "groups": [ 'forms' ] },
                        { "name": 'basicstyles', "groups": [ 'basicstyles', 'cleanup' ] },
                        { "name": 'paragraph', "groups": [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
                        { "name": 'links', "groups": [ 'links' ] },
                        { "name": 'insert', "groups": [ 'insert' ] },
                        { "name": 'styles', "groups": [ 'styles' ] },
                        { "name": 'colors', "groups": [ 'colors' ] },
                        { "name": 'tools', "groups": [ 'tools' ] },
                        { "name": 'others', "groups": [ 'others' ] },
                        { "name": 'about', "groups": [ 'about' ] }
					],
					// Remove the redundant buttons from toolbar groups defined above.
					removeButtons: 'Source,Save,Templates,PasteFromWord,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Strike,Subscript,Superscript,CopyFormatting,RemoveFormat,Blockquote,CreateDiv,Outdent,Indent,BidiLtr,BidiRtl,Language,Link,Unlink,Anchor,Image,Flash,Table,HorizontalRule,SpecialChar,PageBreak,Iframe,Styles,Format,Font,FontSize,TextColor,BGColor,Maximize,ShowBlocks,About,NewPage,ExportPdf,Preview,Print'
				});
</script>
<script>
    $(document).ready(function () {
        no = 0;
        index = 0;
        $("#addImages").on('click',function () {
            var html = '';
            html += '<div id="form-group" style="margin-top:2px">';
            html += '<input type="file" name="image[]" class="form-control">';
            html += '</div>';
            console.log(html);

            $("#gambar").append(html);
        });
        $('#btnAdd').on('click',function () {
            no = no+1;
            color = $('#color').val();
            size = $('#size').children('option:selected').val();
            tipeselect = $("input[name='tipe']:checked").val();
            harga = $('#harga').val();
            qty = $('#qty').val();
            action = '<button id="btnRemove" class="btn icon btn-danger"><i class="bi bi-trash"></i></button>';

            optionidcolor = '<input type="hidden"  value="1" name="option_id[]">';
            valueIDcolor = '<input type="hidden"  value="'+(index+1)+'" name="value_id[]">';
            valueNamecolor = '<input  type="hidden" value="'+color+'" name="value_name[]">';

            optionidsize = '<input type="hidden"  value="2" name="option_id[]">';
            valueIDsize = '<input type="hidden"  value="'+(index+2)+'" name="value_id[]">';
            valueNamesize = '<input  type="hidden" value="'+size+'" name="value_name[]">';
            if(tipeselect === undefined || tipeselect === " " || tipeselect === ""){
                tipeselect = " "
                optionidtype = '<input type="hidden"  value="0" name="option_id[]">';
                valueIDtype = '<input type="hidden"  value="0" name="value_id[]">';
                valueNametype = '<input  type="hidden" value="0" name="value_name[]">';
            }else{
                optionidtype = '<input type="hidden"  value="3" name="option_id[]">';
                valueIDtype = '<input type="hidden"  value="'+(index+3)+'" name="value_id[]">';
                valueNametype = '<input  type="hidden" value="'+tipeselect+'" name="value_name[]">';
            }
            inputHarga = '<input type="hidden"  value="'+harga+'" name="price[]">';
            inputqty = '<input type="hidden"  value="'+harga+'" name="qty[]">';

            all = '<tr>';
            all += '<td>' +no+ '</td>'
            all += '<td>' +color+ optionidcolor + valueIDcolor+valueNamecolor+'</td>'
            all += '<td>' +size+ optionidsize + valueIDsize+valueNamesize+'</td>'
            all += '<td>' +tipeselect+optionidtype + valueIDtype+valueNametype+ '</td>'
            all += '<td>' +harga+inputHarga+'</td>'
            all += '<td>' +qty+inputqty+'</td>'
            all += '<td>' +action+'</td>'
            all += '</tr>'

            $('#variant_table').append(all);
                index = index+3;
            });
        $("#variant_table").on("click", "#btnRemove", function() {
            $(this).closest("tr").remove();
            index = index-3;
            no = no-1;
        });
        // $('#btnAdd').on('click',function(){
        //     $('#variant_table tbody').
        // });
    });
</script>
@endpush

@endsection
