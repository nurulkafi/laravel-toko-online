@extends('user.layout.main')
@section('content')
<!-- Popular Products -->
    <section class="padding-top-100 padding-bottom-100">
      <div class="container">

        <!-- SHOP DETAIL -->
        <div class="shop-detail">
          <div class="row">

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
              <span class="price"><small>Rp</small>{{ $product->productPriceMax->first()->price }}</span>
              <!-- Sale Tags -->
              <ul class="item-owner">
                <li>Designer :<span> ABC Art</span></li>
                <li>Brand:<span> LimeWood</span></li>
              </ul>

              <!-- Item Detail -->
              <p>
                  {!! $product->description !!}
              </p>

              <!-- Short By -->
              <div class="some-info">
                <ul class="row margin-top-30">
                  <li class="col-xs-4">
                    <div class="quinty">
                      <!-- QTY -->
                      <select class="selectpicker">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                      </select>
                    </div>
                  </li>

                  <!-- COLORS -->
                  <li class="col-xs-8">
                    <ul class="colors-shop">
                      <li><span class="margin-right-20">Colors</span></li>
                      <li><a href="#." style="background:#958170;"></a></li>
                      <li><a href="#." style="background:#c9a688;"></a></li>
                      <li><a href="#." style="background:#c9c288;"></a></li>
                      <li><a href="#." style="background:#a7c988;"></a></li>
                      <li><a href="#." style="background:#9ed66b;"></a></li>
                      <li><a href="#." style="background:#6bd6b1;"></a></li>
                      <li><a href="#." style="background:#82c2dc;"></a></li>
                      <li><a href="#." style="background:#8295dc;"></a></li>
                    </ul>
                  </li>

                  <!-- ADD TO CART -->
                  <li class="col-xs-6"> <a href="#." class="btn">ADD TO CART</a> </li>

                  <!-- LIKE -->
                  <li class="col-xs-6"> <a href="#." class="like-us"><i class="icon-heart"></i></a> </li>
                </ul>

                <!-- INFOMATION -->
                <div class="inner-info">
                  <h6>DELIVERY INFORMATION</h6>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum finibus ligula a scelerisque gravida. Nullam laoreet tortor ac maximus alique met, consectetur adipiscing elit. </p>
                  <h6>SHIPPING & RETURNS</h6>
                  <h6>SHARE THIS PRODUCT</h6>

                  <!-- Social Icons -->
                  <ul class="social_icons">
                    <li><a href="#."><i class="icon-social-facebook"></i></a></li>
                    <li><a href="#."><i class="icon-social-twitter"></i></a></li>
                    <li><a href="#."><i class="icon-social-tumblr"></i></a></li>
                    <li><a href="#."><i class="icon-social-youtube"></i></a></li>
                    <li><a href="#."><i class="icon-social-dribbble"></i></a></li>
                  </ul>
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

          <!-- Item -->
          <div class="item">
            <!-- Item img -->
            <div class="item-img"> <img class="img-1" src="images/product-1.jpg" alt="" >
              <!-- Overlay -->
              <div class="overlay">
                <div class="position-center-center">
                  <div class="inn"><a href="images/product-1.jpg" data-lighter><i class="icon-magnifier"></i></a> <a href="#."><i class="icon-basket"></i></a> <a href="#." ><i class="icon-heart"></i></a></div>
                </div>
              </div>
            </div>
            <!-- Item Name -->
            <div class="item-name"> <a href="#.">stone cup</a>
              <p>Lorem ipsum dolor sit amet</p>
            </div>
            <!-- Price -->
            <span class="price"><small>$</small>299</span> </div>

          <!-- Item -->
          <div class="item">
            <!-- Item img -->
            <div class="item-img"> <img class="img-1" src="images/product-2.jpg" alt="" >
              <!-- Overlay -->
              <div class="overlay">
                <div class="position-center-center">
                  <div class="inn"><a href="images/product-2.jpg" data-lighter><i class="icon-magnifier"></i></a> <a href="#."><i class="icon-basket"></i></a> <a href="#." ><i class="icon-heart"></i></a></div>
                </div>
              </div>
            </div>
            <!-- Item Name -->
            <div class="item-name"> <a href="#.">gray bag</a>
              <p>Lorem ipsum dolor sit amet</p>
            </div>
            <!-- Price -->
            <span class="price"><small>$</small>299</span> </div>

          <!-- Item -->
          <div class="item">
            <!-- Item img -->
            <div class="item-img"> <img class="img-1" src="images/product-3.jpg" alt="" >
              <!-- Overlay -->
              <div class="overlay">
                <div class="position-center-center">
                  <div class="inn"><a href="images/product-3.jpg" data-lighter><i class="icon-magnifier"></i></a> <a href="#."><i class="icon-basket"></i></a> <a href="#." ><i class="icon-heart"></i></a></div>
                </div>
              </div>
            </div>
            <!-- Item Name -->
            <div class="item-name"> <a href="#.">chiar</a>
              <p>Lorem ipsum dolor sit amet</p>
            </div>
            <!-- Price -->
            <span class="price"><small>$</small>299</span> </div>

          <!-- Item -->
          <div class="item">
            <!-- Item img -->
            <div class="item-img"> <img class="img-1" src="images/product-4.jpg" alt="" >
              <!-- Overlay -->
              <div class="overlay">
                <div class="position-center-center">
                  <div class="inn"><a href="images/product-4.jpg" data-lighter><i class="icon-magnifier"></i></a> <a href="#."><i class="icon-basket"></i></a> <a href="#." ><i class="icon-heart"></i></a></div>
                </div>
              </div>
            </div>
            <!-- Item Name -->
            <div class="item-name"> <a href="#.">STool</a>
              <p>Lorem ipsum dolor sit amet</p>
            </div>
            <!-- Price -->
            <span class="price"><small>$</small>299</span> </div>
        </div>
      </div>
    </section>
@endsection
