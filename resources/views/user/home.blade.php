@extends('user.layout.main')
{{-- @section('header')
<section class="home-slider">

    <!-- SLIDE Start -->
    <div class="tp-banner-container">
      <div class="tp-banner">
        <ul>
          <!-- SLIDE  -->
          <li data-transition="random" data-slotamount="7" data-masterspeed="300"  data-saveperformance="off" >
            <!-- MAIN IMAGE -->
            <img src="images/slide-bg-1.jpg"  alt="slider"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
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
                style="z-index: 7; font-size:18px; color:#fff; max-width: auto; max-height: auto; white-space: nowrap;">The Latest Product from PAVSHOP</div>
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
                style="z-index: 6; font-size:80px; color:#2d3a4b; text-transform:uppercase; white-space: nowrap;"><small class="font-regular">$</small>299 </div>
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
                style="z-index: 6; font-size:120px; color:#fff; text-transform:uppercase; white-space: nowrap;">cycle </div>
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
                style="z-index: 8;"><a href="#." class="btn">SHOP NOW</a> </div>
          </li>

          <!-- SLIDE  -->
          <li data-transition="random" data-slotamount="7" data-masterspeed="300"  data-saveperformance="off" >
            <!-- MAIN IMAGE -->
            <img src="images/slide-bg-2.jpg"  alt="slider"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
            <!-- LAYERS -->
            <!-- LAYER NR. 1 -->
            <div class="tp-caption font-playfair sfb tp-resizeme"
                data-x="center" data-hoffset="0"
                data-y="center" data-voffset="-150"
                data-speed="800"
                data-start="500"
                data-easing="Power3.easeInOut"
                data-splitin="none"
                data-splitout="none"
                data-elementdelay="0.1"
                data-endelementdelay="0.1"
                data-endspeed="300"
                style="z-index: 7; font-size:18px; color:#fff; max-width: auto; max-height: auto; white-space: nowrap;">The Latest Product from PAVSHOP</div>
            <!-- LAYER NR. 2 -->
            <div class="tp-caption sfr font-regular tp-resizeme letter-space-4"
                data-x="center" data-hoffset="0"
                data-y="center" data-voffset="-50"
                data-speed="800"
                data-start="800"
                data-easing="Power3.easeInOut"
                data-splitin="chars"
                data-splitout="none"
                data-elementdelay="0.07"
                data-endelementdelay="0.1"
                data-endspeed="300"
                style="z-index: 6; font-size:78px; color:#fff; text-transform:uppercase; white-space: nowrap;">look beautiful </div>
            <!-- LAYER NR. 2 -->
            <div class="tp-caption sfr font-extra-bold tp-resizeme letter-space-4"
                data-x="center" data-hoffset="0"
                data-y="center" data-voffset="60"
                data-speed="800"
                data-start="1300"
                data-easing="Power3.easeInOut"
                data-splitin="chars"
                data-splitout="none"
                data-elementdelay="0.07"
                data-endelementdelay="0.1"
                data-endspeed="300"
                style="z-index: 6; font-size:140px; color:#fff; text-transform:uppercase; white-space: nowrap;">this season </div>
            <!-- LAYER NR. 4 -->
            <div class="tp-caption sfb font-extra-bold tp-resizeme"
                data-x="center" data-hoffset="120"
                data-y="center" data-voffset="200"
                data-speed="800"
                data-start="2200"
                data-easing="Power3.easeInOut"
                data-splitin="none"
                data-splitout="none"
                data-elementdelay="0.07"
                data-endelementdelay="0.1"
                data-endspeed="300"
                style="z-index: 6; font-size:60px; color:#fff; text-transform:uppercase; white-space: nowrap;"><small class="font-regular">$</small> 299 </div>
            <!-- LAYER NR. 4 -->
            <div class="tp-caption lfb tp-scrollbelowslider tp-resizeme"
                data-x="center" data-hoffset="-120"
                data-y="center" data-voffset="200"
                data-speed="800"
                data-start="2200"
                data-easing="Power3.easeInOut"
                data-elementdelay="0.1"
                data-endelementdelay="0.1"
                data-endspeed="300"
                data-scrolloffset="0"
                style="z-index: 8;"><a href="#." class="btn">BUY NOW</a> </div>
          </li>
        </ul>
      </div>
    </div>
  </section>
@endsection --}}
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
          <img class="img-1" src="{{ asset('storage/'.$item->productImage->first()->path) }}" alt="">
          <!-- Overlay  -->
          <div class="overlay">
            <!-- Price -->
            @if ($item->productPriceMax->count() > 1)
            <span class="price"><small>Rp.</small>{{ $item->productPriceMin->first()->price }} - {{ $item->productPriceMax->first()->price }}</span>
                <div class="position-center-center"> <a href="images/item-img-1-1.jpg" data-lighter><i class="icon-magnifier"></i></a> </div>
            @else
                <span class="price"><small>Rp.</small>{{ $item->productPriceMax->first()->price }}</span>
                <div class="position-center-center"> <a href="images/item-img-1-1.jpg" data-lighter><i class="icon-magnifier"></i></a> </div>
            @endif
          </div>
          <!-- Item Name -->
          <div class="item-name"> <a href="#.">{{ $item->name }}</a>
          </div>
        </div>
        @endforeach
      </div>
    </section>
@endsection
