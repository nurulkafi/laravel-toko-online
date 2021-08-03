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
                    <li data-thumb="{{ asset('storage/'.$img->path)}}"> <img class="img-responsive" src="{{ asset('storage/'.$img->path) }}"  alt=""> </li>
                    @endforeach
                </ul>
              </div>
            </div>

            <!-- COntent -->
            <div class="col-md-5">
              <h4>{{ $product->name }}</h4>
              <span class="price" id="price"><small>Rp</small>{{ $product->productPriceMax->first()->price }}</span>
              <!-- Sale Tags -->
              <ul class="item-owner">
                <li>Designer :<span> ABC Art</span></li>
                <li>Stock :<span style="font-size: 20px;font-weight: bold" id="stock"> {{ $product->productPriceMax->first()->qty }}</span></li>
              </ul>

              <!-- Item Detail -->
              <p>
                  {!! $product->description !!}
              </p>

              <!-- Short By -->
              <div class="some-info">
                <ul class="row margin-top-30">
                    <li class="col-xs-4">Qty</li>
                    <li class="col-xs-4">Size</li>
                    <li class="col-xs-4">&nbsp;</li>
                    <li class="col-xs-4">
                    <div class="quinty">
                      <!-- QTY -->
                      <input type="text" name="qty" style="border:0.5px solid black" class="form-control">
                      {{-- <select class="selectpicker">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                      </select> --}}
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

                <!-- INFOMATION -->
                <div class="inner-info">
                  <h6>DELIVERY INFORMATION</h6>

                  <p>
                      <div class="row">
                          <div class="col-md-6">
                              <h6>From</h6>
                              <div class="form-group">
                                  <p for="">Provinsi</p>
                                  <input type="text" disabled class="form-control" placeholder="Jawa Barat">
                              </div>
                              <div class="form-group">
                                  <p for="">Kabupaten</p>
                                  <input type="text" disabled class="form-control" placeholder="Bandung">
                              </div>
                              <div class="form-group">
                                  <p>Courier </p>

                                  <select name="" id="kurir" class="form-control">
                                    <option value="">
                                    </option>
                                  </select>

                              </div>
                            </div>
                          <div class="col-md-6">
                              <h6>To</h6>

                              <div class="form-group">
                                  <p for="">Provinsi</p>
                                  <select name="" id="provinsiTujuan"  class="form-control">
                                      @foreach ($province as $item)
                                          <option value="{{ $item->code }}">{{ $item->title }}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="form-group">
                                  <p for="">Kabupaten / Kota</p>
                                  <select name="" id="kotaTujuan"  class="form-control">
                                    <option value="">&nbsp;</option>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <p id="total_ongkir" style="font-size: 15px;margin-top:40px">Ongkos Kirim : Rp.50000</p>
                              </div>
                          </div>
                      </div>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!--======= PRODUCT DESCRIPTION =========-->
        <div class="item-decribe">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs animate fadeInUp" data-wow-delay="0.4s" role="tablist">
            <li role="presentation" class="active"><a href="#descr" role="tab" data-toggle="tab">DESCRIPTION</a></li>
            <li role="presentation"><a href="#review" role="tab" data-toggle="tab">REVIEW (03)</a></li>
            <li role="presentation"><a href="#tags" role="tab" data-toggle="tab">INFORMATION</a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content animate fadeInUp" data-wow-delay="0.4s">
            <!-- DESCRIPTION -->
            <div role="tabpanel" class="tab-pane fade in active" id="descr">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sed lectus id nisi interdum mollis. Nam congue tellus quis elit mattis congue. Aenean eu massa sed mauris hendrerit ornare sed eget ante.
                Vestibulum id eros quam. Nunc volutpat at magna gravida eleifend. Phasellus sit amet nisi tempus, tincidunt elit ac, tempor metus. <br>
              </p>
              <h6>THE SIMPLE FACTS</h6>
              <ul>
                <li>
                  <p>Praesent faucibus, leo vitae maximus dictum,</p>
                </li>
                <li>
                  <p> Donec porta ut lectus </p>
                </li>
                <li>
                  <p> Phasellus maximus velit id nisl</p>
                </li>
                <li>
                  <p> Quisque a tellus et sapien aliquam sus</p>
                </li>
                <li>
                  <p> Donec porta ut lectus </p>
                </li>
                <li>
                  <p> Phasellus maximus velit id nisl</p>
                </li>
              </ul>
            </div>

            <!-- REVIEW -->
            <div role="tabpanel" class="tab-pane fade" id="review">
              <h6>3 REVIEWS FOR SHIP YOUR IDEA</h6>

              <!-- REVIEW PEOPLE 1 -->
              <div class="media">
                <div class="media-left">
                  <!--  Image -->
                  <div class="avatar"> <a href="#"> <img class="media-object" src="images/avatar-1.jpg" alt=""> </a> </div>
                </div>
                <!--  Details -->
                <div class="media-body">
                  <p class="font-playfair">“Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua.”</p>
                  <h6>TYRION LANNISTER <span class="pull-right">MAY 10, 2016</span> </h6>
                </div>
              </div>

              <!-- REVIEW PEOPLE 1 -->

              <div class="media">
                <div class="media-left">
                  <!--  Image -->
                  <div class="avatar"> <a href="#"> <img class="media-object" src="images/avatar-2.jpg" alt=""> </a> </div>
                </div>
                <!--  Details -->
                <div class="media-body">
                  <p class="font-playfair">“Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua.”</p>
                  <h6>TYRION LANNISTER <span class="pull-right">MAY 10, 2016</span> </h6>
                </div>
              </div>

              <!-- ADD REVIEW -->
              <h6 class="margin-t-40">ADD REVIEW</h6>
              <form>
                <ul class="row">
                  <li class="col-sm-6">
                    <label> *NAME
                      <input type="text" value="" placeholder="">
                    </label>
                  </li>
                  <li class="col-sm-6">
                    <label> *EMAIL
                      <input type="email" value="" placeholder="">
                    </label>
                  </li>
                  <li class="col-sm-12">
                    <label> *YOUR REVIEW
                      <textarea></textarea>
                    </label>
                  </li>
                  <li class="col-sm-6">
                    <!-- Rating Stars -->
                    <div class="stars"> <span>YOUR RATING</span> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                  </li>
                  <li class="col-sm-6">
                    <button type="submit" class="btn btn-dark btn-small pull-right no-margin">POST REVIEW</button>
                  </li>
                </ul>
              </form>
            </div>

            <!-- TAGS -->
            <div role="tabpanel" class="tab-pane fade" id="tags"> </div>
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
