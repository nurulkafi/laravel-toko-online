<header>
    <div class="sticky">
      <div class="container">

        <!-- Logo -->
        <div class="logo"> <a href="index.html"><img class="img-responsive" src="{{ asset('user/images/logo.png') }}" alt="" ></a> </div>
        <nav class="navbar ownmenu">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-open-btn" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"><i class="fa fa-navicon"></i></span> </button>
          </div>

          <!-- NAV -->
          <div class="collapse navbar-collapse" id="nav-open-btn">
            <ul class="nav">
                <li> <a href="{{ url('/home') }}">Home </a> </li>
                <li> <a href="{{ url('/product') }}">Product </a> </li>


              <!-- MEGA MENU -->
              <li class="dropdown megamenu"> <a href="#." class="dropdown-toggle" data-toggle="dropdown">store</a>
                <div class="dropdown-menu">
                  <div class="row">
                    @foreach ($category as $item)
                        <div class="col-md-3">
                        @if ($item->childs->count()>0)
                            <a href="{{ url('product/category/'.$item->slug) }}"><h6><b>{{ $item->name }}</b></h6></a>
                            <ul>
                            @foreach ($item->childs as $subMenu)
                                <li> <a href="{{ url('product/category/'.$item->slug.'/'.$subMenu->slug) }}">{{ $subMenu->name }}</a> </li>
                            @endforeach
                            </ul>
                        @else
                            <a href="{{ url('product/category/'.$item->slug) }}"><h6><b>{{ $item->name }}</b></h6></a>
                        @endif
                        </div>
                    @endforeach
                  </div>
                </div>
              </li>
              <li> <a href="contact.html"> contact</a> </li>
            </ul>
          </div>

          <!-- Nav Right -->
          <div class="nav-right">
            <ul class="navbar-right">

              <!-- USER INFO -->
              @auth
              <li class="dropdown user-acc"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" ><i class="icon-user"></i> </a>
                <ul class="dropdown-menu">
                  <li>
                    <h6>HELLO! {{ Auth::user()->name }} </h6>
                  </li>
                  <li><a href="{{ url('cart') }}">MY CART</a></li>
                  <li><a href="{{ url('order/info') }}">ORDER INFO</a></li>
                  <li><a href="{{ url('logout') }}">LOG OUT</a></li>
                </ul>
              </li>
              @endauth
              @guest
                <li class="dropdown user-acc"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" ><i class="icon-user"></i> </a>
                <ul class="dropdown-menu">
                  <li><a href="{{ url('login') }}">Login</a></li>
                  <li><a href="{{ url('register') }}">Register</a></li>
                </ul>
              </li>
              @endguest
              <!-- USER BASKET -->
              <li class="dropdown user-basket"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="icon-basket-loaded"></i> </a>
                <ul class="dropdown-menu">
                  @foreach ($cart as $item)
                  @php
                    $product = $item->associatedModel;
                  @endphp
                  <li>
                    <div class="media-left">
                      <div class="cart-img"> <a href="#"> <img class="media-object img-responsive" src="{{ asset('storage/'.$product->productImage->first()->small) }}" alt="..."> </a> </div>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading">{{ $item->name }} {{ $item->attributes[0] }}</h6>
                      <span class="price">Rp. {{ number_format($item->price) }}</span> <span class="qty">QTY: {{ $item->quantity }}</span> </div>
                  </li>
                  @endforeach
                  <li>
                    <h5 class="text-center">SUBTOTAL: Rp.{{ number_format(\Cart::getSubTotal()) }}</h5>
                  </li>
                  <li class="margin-0">
                    <div class="row">
                      <div class="col-xs-6"> <a href="{{ url('cart') }}" class="btn">VIEW CART</a></div>
                      <div class="col-xs-6 "> <a href="{{ url('checkout') }}" class="btn">CHECK OUT</a></div>
                    </div>
                  </li>
                </ul>
              </li>

              <!-- SEARCH BAR -->
              <li class="dropdown"> <a href="javascript:void(0);" class="search-open"><i class=" icon-magnifier"></i></a>
                <div class="search-inside animated bounceInUp"> <i class="icon-close search-close"></i>
                  <div class="search-overlay"></div>
                  <div class="position-center-center">
                    <div class="search">
                      <form method="POST" action="{{ url('product/search') }}">
                        @csrf
                        <input type="text" placeholder="Search Shop" name="searchName">
                        <button type="submit"><i class="icon-check"></i></button>
                      </form>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </header>
