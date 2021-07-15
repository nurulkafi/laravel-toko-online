@extends('user.layout.main')
@section('content')
<section class="shop-page padding-top-100 padding-bottom-100">
      <div class="container">
        <div class="row">
          @include('user.product.sidebar')
          <!-- Item Content -->
          <div class="col-sm-9">
            @include('user.product.filter')

            <!-- Popular Item Slide -->
            <div class="papular-block row single-img-demos">

              <!-- Item -->
              @foreach ($product as $item)
              <div class="col-md-4">
                <div class="item">
                  <!-- Item img -->
                  <div class="item-img"> <img class="img-1" src="{{ 'storage/'.$item->productImage->first()->path }}" alt="" >
                    <!-- Overlay -->
                    <div class="overlay">
                      <div class="position-center-center">
                        <div class="inn"><a href="images/product-2-1.jpg" data-lighter><i class="icon-magnifier"></i></a> <a href="#."><i class="icon-basket"></i></a> <a href="#." ><i class="icon-heart"></i></a></div>
                      </div>
                    </div>
                  </div>
                  <!-- Item Name -->
                  <div class="item-name"> <a href="{{ url('product/detail/'.$item->slug) }}">{{ $item->name }}</a>
                    <p>Lorem ipsum dolor sit amet</p>
                  </div>
                  <!-- Price -->
                  @if ($item->productPriceMax->count() > 1)
                    <span class="price"><small>Rp.</small>{{ $item->productPriceMin->first()->price }} - {{ $item->productPriceMax->first()->price }}</span> </div>
                  @else
                    <span class="price"><small>Rp.</small>{{ $item->productPriceMax->first()->price }}</span> </div>
                  @endif
              </div>
              @endforeach
            </div>

            <!-- Pagination -->
            <ul class="pagination">
              <li class="active"><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>
@endsection
