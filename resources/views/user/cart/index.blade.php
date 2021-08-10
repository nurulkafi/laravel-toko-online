@extends('user.layout.main')
@section('content')
<div id="content">
    <section class="padding-top-100 padding-bottom-100 pages-in chart-page">
      <div class="container">

        <!-- Payments Steps -->
        <div class="shopping-cart text-center">
          <div class="cart-head">
            <ul class="row">
              <!-- PRODUCTS -->
              <li class="col-sm-2 text-left">
                <h6>PRODUCTS</h6>
              </li>
              <!-- NAME -->
              <li class="col-sm-4 text-left">
                <h6>NAME</h6>
              </li>
              <!-- PRICE -->
              <li class="col-sm-2">
                <h6>PRICE</h6>
              </li>
              <!-- QTY -->
              <li class="col-sm-1">
                <h6>QTY</h6>
              </li>

              <!-- TOTAL PRICE -->
              <li class="col-sm-2">
                <h6>TOTAL</h6>
              </li>
              <li class="col-sm-1"> </li>
            </ul>
          </div>
          <form action="{{ url('cart/update') }}" method="POST">
          @csrf
          {{ method_field('PUT') }}
          @forelse ($cart as $item)
          @php
              $product = $item->associatedModel;
          @endphp
          <!-- Cart Details -->
          <ul class="row cart-details">
            <li class="col-sm-6">
              <div class="media">
                <!-- Media Image -->
                <div class="media-left media-middle"> <a href="#." class="item-img"> <img class="media-object" src="{{ asset('storage/'.$product->productImage->first()->small) }}" alt=""> </a> </div>
                <!-- Item Name -->
                <div class="media-body">
                  <div class="position-center-center">
                    <h5>{{ $item->name }}</h5>
                    <p>Size : {{ $item->attributes[0] }}</p>
                  </div>
                </div>
              </div>
            </li>

            <!-- PRICE -->
            <li class="col-sm-2">
              <div class="position-center-center"> <span class="price"><small>Rp.</small>{{ number_format($item->price) }}</span> </div>
            </li>

            <!-- QTY -->
            <li class="col-sm-1">
              <div class="position-center-center">
                <div class="quinty">
                  <!-- QTY -->
                  <input type="number" name="qty[]" value="{{ $item->quantity }}" style="border: 0.5px solid black" class="form-control">
                  <input type="hidden" name="id[]" value="{{ $item->id }}">
                </div>
              </div>
            </li>

            <!-- TOTAL PRICE -->
            <li class="col-sm-2">
              <div class="position-center-center"> <span class="price"><small>Rp</small>{{ number_format($item->price * $item->quantity) }}</span> </div>
            </li>

            <!-- REMOVE -->
            <li class="col-sm-1">
              <div class="position-center-center"> <a href="{{ url('cart/remove/'.$item->id) }}"><i class="icon-close"></i></a> </div>
            </li>
          </ul>
          @empty
          <ul class="row cart-details">
              <h4>Empty Cart!</h4>
          </ul>
          @endforelse
        </div>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-5"></div>
            <div class="col-sm-3"><button  type="submit" class="btn">update cart</button></div>
        </div>
        </form>
      </div>
    </section>

    <!--======= PAGES INNER =========-->
    <section class="padding-top-100 padding-bottom-100 light-gray-bg shopping-cart small-cart">
      <div class="container">

        <!-- SHOPPING INFORMATION -->
        <div class="cart-ship-info margin-top-0">
          <div class="row">

            <!-- DISCOUNT CODE -->
            <div class="col-sm-7">
              <h6>DISCOUNT CODE</h6>
              <form>
                <input type="text" value="" placeholder="ENTER YOUR CODE IF YOU HAVE ONE">
                <button type="submit" class="btn btn-small btn-dark">APPLY CODE</button>
              </form>
              <div class="coupn-btn"> <a href="{{ url('product') }}" class="btn">continue shopping</a>  <a href="{{ url('checkout') }}" class="btn">Checkout</a> </div>
            </div>

            <!-- SUB TOTAL -->
            <div class="col-sm-5">
              <h6>grand total</h6>
              <div class="grand-total">
                <div class="order-detail">
                  @foreach ($cart as $item)
                    <p>{{ $item->name }} {{ $item->attributes[0] }} <span>{{ number_format($item->price * $item->quantity) }} </span></p>
                  @endforeach
                  <!-- SUB TOTAL -->
                  <p class="all-total">TOTAL COST <span> {{ number_format(\Cart::getTotal()) }}</span></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
@push('detailproduct')
<script>
$(document).ready(function() {

});
</script>i
@endpush
@endsection
