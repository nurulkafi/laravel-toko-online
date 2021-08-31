@extends('admin.layouts.main');
@section('sub-product', 'has-sub')
@section('submenu-product')
<ul class="submenu ">
    <li class="submenu-item">
        <a href="{{ url('admin/product') }}">Table Product</a>
    </li>
    <li class="submenu-item active">
        <a href="{{ url('admin/product/edit/'.$product->id) }}">Product Info</a>
    </li>
    <li class="submenu-item ">
        <a href="{{ url('admin/product/images/edit/'.$product->id) }}">Product Images</a>
    </li>
    <li class="submenu-item ">
        <a href="{{ url('admin/product/atribute/edit/'.$product->id) }}">Product Atribute</a>
    </li>
</ul>
@endsection
@section('content')
    <section id="input-style">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6"><h4 class="card-title">Product</h4></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('admin/product/update/'.$product->id) }}" enctype="multipart/form-data" >
                            {{ method_field('PUT') }}
                            @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" value="{{ $product->name }}" class="form-control round" name="name" >
                                </div>
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select name="parent" id="" class="form-select round">
                                        <option value="{{ \App\Models\Category::cats($product->category_id)->id }}">{{ \App\Models\Category::cats($product->category_id)->parent->name }} / {{ \App\Models\Category::cats($product->category_id)->name }}</option>
                                        @foreach ($cats as $item)
                                            @if ($item->childs->count()>0)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @foreach ($item->childs as $subMenu)
                                                    @if($item->cats($product->category_id)->parent->name != $item->name && $item->cats($product->category_id)->name != $subMenu->name )
                                                    <option value="{{ $subMenu->id }}" style="margin-left: 5px">{{ $item->name }} / {{ $subMenu->name }}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Short description</label>
                                    <textarea type="text" class="form-control round" name="short_description"  id="ed2itor">{{ $product->short_description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Description</label>
                                    <textarea type="text" class="form-control round" name="description"  id="editor">{!! $product->description !!}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="berat">Weight</label>
                                    <input type="text" id="berat" class="form-control round" value="{{ $product->weight }}" name="weight">
                                </div>
                                <div class="form-group">
                                    <label for="Status">Status</label>
                                    <select name="status" class="form-select" id="">
                                        @if ($product->status == 0)
                                            <option value="0">Draft</option>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        @elseif($product->status == 1)
                                            <option value="1">Active</option>
                                            <option value="0">Draft</option>
                                            <option value="2">Inactive</option>
                                        @else
                                            <option value="2">Inactive</option>
                                            <option value="1">Active</option>
                                            <option value="0">Draft</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success float-end" type="submit" style="margin-right:20">Submit</button>
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
