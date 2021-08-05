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
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('admin/product/add_data') }}" enctype="multipart/form-data" >
                            @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" class="form-control round" name="name" >
                                </div>
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select name="parent" id="" class="form-select round">
                                        @foreach ($data as $item)
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
                                    <label for="deskripsi">Short description</label>
                                    <textarea type="text" class="form-control round" name="short_description"  id="ed2itor"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Description</label>
                                    <textarea type="text" class="form-control round" name="description"  id="editor"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="berat">Weight</label>
                                    <input type="number" id="berat" class="form-control round" name="weight">
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
                                    <h5>Product Images</h5>
                                    <input type="file" accept="image/*" onchange="loadFile(event)" name="image[]" class="form-control">
                                    <img id="output" width="250" class="img-thumbnail rounded mx-auto d-block" height="250" style="margin-top:20px;margin-bottom:20px">
                                    <input type="file" accept="image/*" onchange="loadFile1(event)" name="image[]" class="form-control">
                                    <img id="output1" width="250" class="img-thumbnail rounded mx-auto d-block" height="250" style="margin-top:20px;margin-bottom:20px">
                                    <input type="file" accept="image/*" onchange="loadFile2(event)" name="image[]" class="form-control">
                                    <img id="output2" width="250" class="img-thumbnail rounded mx-auto d-block" height="250" style="margin-top:20px;margin-bottom:20px">
                                    <input type="file" accept="image/*" onchange="loadFile3(event)" name="image[]" class="form-control">
                                    <img id="output3" width="250" class="img-thumbnail rounded mx-auto d-block" height="250" style="margin-top:20px;margin-bottom:20px">
                                    <input type="file" accept="image/*" onchange="loadFile4(event)" name="image[]" class="form-control">
                                    <img id="output4" width="250" class="img-thumbnail rounded mx-auto d-block" height="250" style="margin-top:20px;margin-bottom:20px">
                                </div>
                                <div class="form-group">
                                    <br>
                                    <h5>Product Variant</h5>
                                </div>
                                <div class="form-group">
                                    <label for="">Size</label>
                                    <input type="text" id="size" name="size" class="form-control">
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
                                        <td>No</td>
                                        <td>Size</td>
                                        <td>Harga</td>
                                        <td>Qty</td>
                                        <td>Action</td>
                                    </tr>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success float-end" type="submit" style="margin-right:20px">Submit</button>
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
        $('#btnAdd').on('click',function () {
            no = no+1;
            size = $('#size').val()
            harga = $('#harga').val();
            qty = $('#qty').val();
            action = '<button id="btnRemove" class="btn icon btn-danger"><i class="bi bi-trash"></i></button>';

            inputHarga = '<input type="hidden"  value="'+harga+'" name="price[]">';
            inputqty = '<input type="hidden"  value="'+qty+'" name="qty[]">';
            inputSize = '<input type="hidden"  value="'+size+'" name="size[]">';

            all = '<tr>';
            all += '<td>' +no+ '</td>'
            all += '<td>' +size+ inputSize+'</td>'
            all += '<td>' +harga+inputHarga+'</td>'
            all += '<td>' +qty+inputqty+'</td>'
            all += '<td>' +action+'</td>'
            all += '</tr>'

            $('#variant_table').append(all);
            });
        $("#variant_table").on("click", "#btnRemove", function() {
            $(this).closest("tr").remove();
            no = no-1;
        });
        // $('#btnAdd').on('click',function(){
        //     $('#variant_table tbody').
        // });

    });
</script>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
  var loadFile1 = function(event) {
    var output = document.getElementById('output1');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
  var loadFile4 = function(event) {
    var output = document.getElementById('output4');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
  var loadFile2 = function(event) {
    var output = document.getElementById('output2');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
  var loadFile3 = function(event) {
    var output = document.getElementById('output3');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };

</script>
@endpush

@endsection
