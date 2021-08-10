@extends('user.layout.main')
@section('content')
<!-- Popular Products -->
    <section class="padding-top-100 padding-bottom-100">
      <div class="container">

        <!-- SHOP DETAIL -->
        <form action="{{ url('cart/add') }}" method="POST">
            @csrf
        <div class="shop-detail">
          <div class="row">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <!-- Popular Images Slider -->
            <div class="col-md-7">

              <!-- Images Slider -->
              <div class="images-slider">
                <ul class="slides">
                    @foreach ($product->productImage as $img)
                    <li data-thumb="{{ asset('storage/'.$img->extra_large)}}"> <img class="img-responsive" src="{{ asset('storage/'.$img->path) }}"  alt=""> </li>
                    @endforeach
                </ul>
              </div>
            </div>

            <!-- COntent -->
            <div class="col-md-5">
              <h4>{{ $product->name }}</h4>
              <span class="price" id="price"><small>Rp</small>{{ number_format($product->productPriceMax->first()->price) }}</span>
              <!-- Sale Tags -->
              <ul class="item-owner">
                <li>Category :<span> <a href="{{ url('product/category/'.$product->category($product->category_id)->slug) }}">{{ $product->category($product->category_id)->name }}</a></span></li>
                <li>Stock :<span style="color: black" id="stock"> {{ $product->productPriceMax->first()->qty }}</span></li>
              </ul>

              <!-- Item Detail -->

              <!-- Short By -->
              <div class="some-info">
                <ul class="row margin-top-30">
                    <li class="col-xs-4">Qty</li>
                    <li class="col-xs-4">Size</li>
                    <li class="col-xs-4">&nbsp;</li>
                    <li class="col-xs-4">
                    <div class="quinty">
                      <!-- QTY -->
                      <input type="number" name="qty" min="1" max="{{ $product->productPriceMax->first()->qty }}" style="border:0.5px solid black" class="form-control">
                    </div>
                  </li>
                  <li class="col-xs-4">
                    <div class="quinty">
                      <!-- QTY -->
                      <select class="selectpicker" name="atribut_id" id="size">
                        @foreach ($product->productAtribute as $item)
                            <option data-id="{{ $item->id }}" value="{{ $item->id }}">{{ $item->size }}</option>
                        @endforeach
                      </select>
                    </div>
                  </li
                  <!-- ADD TO CART -->
                  <li class="col-xs-4"> <a href="#." class="like-us"><i class="icon-heart"></i></a> </li>
                  <li class="col-xs-12"> <button type="submit" class="btn">ADD TO CART</button> </li>

                  <!-- LIKE -->
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!--======= PRODUCT DESCRIPTION =========-->
        <div class="item-decribe">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs animate fadeInUp" data-wow-delay="0.4s" role="tablist">
            <li role="presentation" class="active"><a href="#descr" role="tab" data-toggle="tab">DESCRIPTION</a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content animate fadeInUp" data-wow-delay="0.4s">
            <!-- DESCRIPTION -->
            <div role="tabpanel" class="tab-pane fade in active" id="descr">
              {!! $product->description !!}
            </div>
          </div>
        </div>
        </form>
      </div>
    </section>

    <!-- Popular Products -->
    <section class="light-gray-bg padding-top-150 padding-bottom-150">
      <div class="container">

        <!-- Main Heading -->
        <div class="heading text-center">
          <h4>YOU MAY LIKE IT</h4>
          <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec faucibus maximus vehicula.
          Sed feugiat, tellus vel tristique posuere, diam</span> </div>

        <!-- Popular Item Slide -->
        <div class="papular-block block-slide single-img-demos">
          @foreach ($productsame as $item)
          <!-- Item -->
          <div class="item">
            <!-- Item img -->
            <div class="item-img"> <img class="img-1" src="{{ url('storage/'.$item->productImage->first()->path) }}" alt="" >
              <!-- Overlay -->
              <div class="overlay">
                <div class="position-center-center">
                  <div class="inn"><a href="{{ url('storage/'.$item->productImage->first()->path) }}" data-lighter><i class="icon-magnifier"></i></a> <a href="{{ url('product/detail/'.$item->slug) }}"><i class="icon-basket"></i></a> <a href="#." ><i class="icon-heart"></i></a></div>
                </div>
              </div>
            </div>
            <!-- Item Name -->
            <div class="item-name"> <a href="#.">{{ $item->name }}</a>
              <p>{{ $item->short_description }}</p>
            </div>
            <!-- Price -->
            <span class="price"><small>Rp</small>{{ $item->productPriceMin->first()->price }}</span>
            </div>

          @endforeach
        </div>
      </div>
    </section>
@push('detailproduct')
<script>
     $(document).ready(function () {
        $('#size').on('change',function () {
            let sku = $(this).val();
            $.ajax({
                url: '/product/detail/search/'+sku,
                data: {id : sku},
                type: 'get',
                dataType: 'json',
                success:function(data) {
                    $('#price').html("<small>Rp</small>" + data.price),
                    $('#stock').html(data.qty)
                }
            });
        });
        $('#provinsiTujuan').on('change',function(){
            let id = $(this).val();
                $.ajax({
                    url: '/province/search/'+id,
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        $('#kotaTujuan').empty();
                        $('#kotaTujuan').append(`<option value="">Kabupaten . . . . . . . </option>`);
                        $.each(data, function(key, value){
                            $('#kotaTujuan').append(`<option value="${key}"> ${value} </option>`);
                        });
                },
                });
        });
        $('#kotaTujuan').on('change',function(){
            $('#kurir').empty();
            let tujuan = $('#kotaTujuan').children("option:selected").val();
            let berat = {{ $product->weight }};
            $.ajax({
                url: '/cekongkir/'+tujuan+'/berat/'+berat+'/kurir/'+'jne',
                type: 'get',
                dataType: 'json',
                success:function(data) {
                    // $('#total_ongkir').html("Ongkos Kirim : Rp."+data);
                    // $.each(response[0]['costs'].results, function(key,result) {
                    //     console.log(result.service)
                    // })
                    for (let index = 0; index < 3; index++) {
                        let kurir = data[index].results[0].code.toUpperCase();
                        $.each(data[index].results[0].costs, function(key,result) {
                            $('#kurir').append('<option>'+ kurir+" "+result.service+" | "+result.cost[0].value+'</option>')
                        })
                    }
                }
            });
        });
        $('#kurir').on('change',function(){
            let tujuan = $('#kotaTujuan').children("option:selected").val();
            let kurir = $('#kurir').children("option:selected").val();
            let berat = {{ $product->weight }};
            $.ajax({
                url: '/cekongkir/'+tujuan+'/berat/'+berat+'/kurir/'+kurir,
                type: 'get',
                dataType: 'json',
                success:function(data) {
                    $('#total_ongkir').html("Ongkos Kirim : Rp."+data);
                }
            });
        });
    });
</script>
@endpush
@endsection
