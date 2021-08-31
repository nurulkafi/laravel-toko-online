@extends('user.layout.main')
@section('slider')
<section class="home-slider">

    <!-- SLIDE Start -->
    <div class="tp-banner-container">
      <div class="tp-banner">
        <ul>
            @forelse ($slider as $item)
            <!-- SLIDE  -->
            <li data-transition="random" data-slotamount="7" data-masterspeed="300"  data-saveperformance="off" >
              <!-- MAIN IMAGE -->
              <img src="{{ asset('storage/'.$item->path) }}"  alt="slider"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
              <!-- LAYERS -->
              <!-- LAYER NR. 1 -->
              <div class="tp-caption font-playfair sfb tp-resizeme"
                  data-x="left" data-hoffset="0"
                  data-y="center" data-voffset="-200"
                  data-speed="800"
                  data-start="500"
                  data-easing="Power3.easeInOut"
                  data-splitin="none"
                  data-splitout="none"
                  data-elementdelay="0.1"
                  data-endelementdelay="0.1"
                  data-endspeed="300"
                  style="z-index: 7; font-size:18px; color:#fff; max-width: auto; max-height: auto; white-space: nowrap;">The Latest Product from ANONIM PROJECT</div>
              <!-- LAYER NR. 2 -->
              <div class="tp-caption sfl font-extra-bold tp-resizeme"
                  data-x="left" data-hoffset="0"
                  data-y="center" data-voffset="-120"
                  data-speed="800"
                  data-start="800"
                  data-easing="Power3.easeInOut"
                  data-splitin="none"
                  data-splitout="none"
                  data-elementdelay="0.07"
                  data-endelementdelay="0.1"
                  data-endspeed="300"
                  style="z-index: 6; font-size:80px; color:#2d3a4b; text-transform:uppercase; white-space: nowrap;"><small class="font-regular">RP</small>{{ $item->price($item->product_id)->price }} </div>
              <!-- LAYER NR. 2 -->
              <div class="tp-caption sfr font-extra-bold tp-resizeme"
                  data-x="left" data-hoffset="0"
                  data-y="center" data-voffset="0"
                  data-speed="800"
                  data-start="800"
                  data-easing="Power3.easeInOut"
                  data-splitin="chars"
                  data-splitout="none"
                  data-elementdelay="0.07"
                  data-endelementdelay="0.1"
                  data-endspeed="300"
                  style="z-index: 6; font-size:120px; color:#fff; text-transform:uppercase; white-space: nowrap;">featured </div>
              <!-- LAYER NR. 2 -->
              <div class="tp-caption sfr font-extra-bold tp-resizeme"
                  data-x="left" data-hoffset="0"
                  data-y="center" data-voffset="110"
                  data-speed="800"
                  data-start="1300"
                  data-easing="Power3.easeInOut"
                  data-splitin="chars"
                  data-splitout="none"
                  data-elementdelay="0.07"
                  data-endelementdelay="0.1"
                  data-endspeed="300"
                  style="z-index: 6; font-size:120px; color:#fff; text-transform:uppercase; white-space: nowrap;">{{ $item->product($item->product_id)->name }} </div>
              <!-- LAYER NR. 4 -->
              <div class="tp-caption lfb tp-resizeme"
                  data-x="left" data-hoffset="0"
                  data-y="center" data-voffset="240"
                  data-speed="800"
                  data-start="2200"
                  data-easing="Power3.easeInOut"
                  data-elementdelay="0.1"
                  data-endelementdelay="0.1"
                  data-endspeed="300"
                  data-scrolloffset="0"
                  style="z-index: 8;"><a href="{{ url('product/detail/'.$item->product($item->product_id)->slug) }}" class="btn">SHOP NOW</a> </div>
            </li>

          @empty

          @endforelse
        </ul>
      </div>
    </div>
  </section>
@endsection
@section('content')
    <section class="padding-top-100 padding-bottom-100">
      <div class="container">

        <!-- Main Heading -->
        <div class="heading text-center">
          <h4>new arrival</h4>
          <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec faucibus maximus vehicula.
          Sed feugiat, tellus vel tristique posuere, diam</span> </div>
      </div>


      <!-- New Arrival -->
      <div class="arrival-block single-img-demos">
        @foreach ($product as $item)
        <!-- Item -->
        <div class="item">
          <!-- Images -->
          <img class="img-1" src="{{ asset('storage/'.$item->productImage->first()->large) }}" alt="">
          <!-- Overlay  -->
          <div class="overlay">
            <!-- Price -->
            <span class="price"><small>Rp.</small>{{ number_format($item->productPriceMax->first()->price) }}</span>
                <div class="position-center-center"> <a href="images/item-img-1-1.jpg" data-lighter><i class="icon-magnifier"></i></a> </div>
            </div>
          <!-- Item Name -->
          <div class="item-name"> <a href="#.">{{ $item->name }}</a>
          </div>
        </div>
        @endforeach
      </div>
    </section>
@endsection
