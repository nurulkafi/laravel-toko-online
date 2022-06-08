@extends('user.layout.main')
@section('content')
<div id="content">
    <!--======= PAGES INNER =========-->
    <section class="chart-page padding-top-100 padding-bottom-100">
      <div class="container">
        <!-- Payments Steps -->
        <div class="shopping-cart">
          <!-- SHOPPING INFORMATION -->
          <div class="cart-ship-info register">
            <div class="row">

              <!-- ESTIMATE SHIPPING & TAX -->
              <div class="col-sm-7">
                <h6>BILLING DETAILS</h6>
                <form action="{{ url('docheckout') }}" method="POST">
                  @csrf
                  <ul class="row">
                      <li class="col-md-6">
                      <label> *FIRST NAME
                        <input type="text" required name="first_name" value="" placeholder="">
                      </label>
                    </li>
                    <!-- LAST NAME -->
                    <li class="col-md-6">
                      <label> *LAST NAME
                        <input type="text" name="last_name" value="" placeholder="">
                      </label>
                    </li>

                    <!-- PHONE -->
                    <li class="col-md-6">
                        <label> *EMAIL
                            <input type="email" name="email" value="" placeholder="">
                        </label>
                    </li>
                    <li class="col-md-6">
                      <label> *PHONE
                        <input type="text" name="phone" value="" placeholder="">
                      </label>
                    </li>
                    <li class="col-md-6">
                        <!-- ADDRESS -->
                        <label>*PROVINCE
                            <select name="province_id" id="provinsiTujuan"  class="selectpicker">
                                      @foreach ($province as $item)
                                          <option value="{{ $item->code }}">{{ $item->title }}</option>
                                      @endforeach
                            </select>
                        </label>
                    </li>
                    <li class="col-md-6">
                      <!-- ADDRESS -->
                      <label>*CITY
                        <select name="city_id" id="kotaTujuan"  class="selectpicker">
                                    <option value="{{ old('first_name') }}">&nbsp;</option>
                        </select>
                      </label>
                    </li>

                    <!-- COUNTRY -->
                    <li class="col-md-12">
                      <label> *ADDRESS
                        <textarea name="address" style="border: 0.5px solid black;border-radius: 0%;margin-top:10px" class="form-control" name="address" id="message" rows="5" placeholder="">{{ old('address') }}</textarea>
                      </label>
                    </li>
                    <li class="col-md-6">
                      <button type="submit" class="btn">SUBMIT</button>
                    </li>
                  </ul>
              </div>

              <!-- SUB TOTAL -->
              <div class="col-sm-5">
                <h6>YOUR ORDER</h6>
                <div class="order-place">
                  <div class="order-detail">
                    @forelse ($cart as $item)
                        <p>{{ $item->quantity."* ".$item->name." ''".$item->attributes[0] }}<span>{{ number_format($item->price*$item->quantity) }}</span></p>
                    @empty
                        <p>Empty!</p>
                    @endforelse
                    <div class="quinty">
                      <!-- QTY -->
                      <div class="row">
                          <div class="col-md-2">
                              <p>Courier</p>
                          </div>
                          <div class="loading"></div>
                            <div class="col-md-10" id="selectkurir">
                                <select class="selectpicker" id="kurir">
                                    <option>&nbsp;</option>
                                </select>
                            </div>
                      </div>
                    </div>
                    <!-- SUB TOTAL -->
                    <p class="all-total">TOTAL COST <span id="total_cost"> RP.{{ number_format(\Cart::getTotal()) }}</span></p>
                  </div>
                  <div class="pay-meth">
                    <button type="submit" class="btn  btn-dark pull-right margin-top-30">PLACE ORDER</button>
                  </div>
                  <input type="hidden" name="codekurir" id="codekurir">
                  <input type="hidden" name="service" id="service">
                  <input type="hidden" name="shippingcost" id="shippingcost">
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    {{-- berat --}}
    @php
        $berat = 0;
    @endphp
    @foreach ($cart as $item)
        @php
            $berat += $item->quantity * $item->associatedModel->weight;
        @endphp
    @endforeach
    <!-- About -->
    <section class="small-about padding-top-150 padding-bottom-150">
      <div class="container">

        <!-- Main Heading -->
        <div class="heading text-center">
          <h4>about PAVSHOP</h4>
          <p>Phasellus lacinia fermentum bibendum. Interdum et malesuada fames ac ante ipsumien lacus, eu posuere odio luctus non. Nulla lacinia,
            eros vel fermentum consectetur, risus purus tempc, et iaculis odio dolor in ex. </p>
        </div>

        <!-- Social Icons -->
        <ul class="social_icons">
          <li><a href="#."><i class="icon-social-facebook"></i></a></li>
          <li><a href="#."><i class="icon-social-twitter"></i></a></li>
          <li><a href="#."><i class="icon-social-tumblr"></i></a></li>
          <li><a href="#."><i class="icon-social-youtube"></i></a></li>
          <li><a href="#."><i class="icon-social-dribbble"></i></a></li>
        </ul>
      </div>
    </section>

    <!-- News Letter -->
    <section class="news-letter padding-top-150 padding-bottom-150">
      <div class="container">
        <div class="heading light-head text-center margin-bottom-30">
          <h4>NEWSLETTER</h4>
          <span>Phasellus lacinia fermentum bibendum. Interdum et malesuada fames ac ante ipsumien lacus, eu posuere odi </span> </div>
        <form>
          <input type="email" placeholder="Enter your email address" required>
          <button type="submit">SEND ME</button>
        </form>
      </div>
    </section>
  </div>
@push('detailproduct')
<script>
    $(document).ready(function () {
        $('#selectkurir').hide();
        $('.loading').hide();
        $('#provinsiTujuan').on('change',function(){
            let id = $(this).val();
                $.ajax({
                    url: '/province/search/'+id,
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        $('#kotaTujuan').empty();
                        $.each(data, function(key, value){
                            $('#kotaTujuan').append(`<option value="${key}"> ${value} </option>`);
                        });
                        $('#kotaTujuan').selectpicker('refresh');
                },
                });
        });
        $('#kotaTujuan').on('change',function(){
            $('#kurir').empty();
            $('.loading').show();
            let tujuan = $('#kotaTujuan').children("option:selected").val();
            let berat = {{ $berat }};
            $.ajax({
                url: '/cekongkir/'+tujuan+'/berat/'+berat,
                type: 'get',
                dataType: 'json',
                success:function(data) {
                    $('.loading').hide();
                    $('#selectkurir').show();
                    $('#kurir').append('<option>--Select Courier--</option>')
                    for (let index = 0; index < 3; index++) {
                        let kurir = data[index].results[0].code.toUpperCase();
                        $.each(data[index].results[0].costs, function(key,result) {
                            $('#kurir').append('<option value="'+kurir+"|"+result.service+"|"+result.cost[0].value+'">'+ kurir+" "+result.service+" | "+result.cost[0].value+'</option>')
                        });
                    };

                     $('#kurir').selectpicker('refresh');

                }
            });
            $('#kurir').on('change',function(){
                let total_cost = {{ \Cart::getTotal() }};
                let ongkir = $('#kurir').find(':selected').val();
                const ongkirArray = ongkir.split('|');
                let codekurir = ongkirArray[0];
                let service = ongkirArray[1];
                ongkir = ongkirArray[2];
                total_cost = (parseInt(total_cost)+parseInt(ongkir));
                total_cost = new Intl.NumberFormat(['ban', 'id']).format(total_cost);

                $('#shippingcost').val(ongkir);
                $('#codekurir').val(codekurir);
                $('#service').val(service);
                $('#total_cost').html('RP.'+total_cost+'');
            });
        });
    });
</script>
@endpush
@endsection
