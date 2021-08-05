@extends('user.layout.main')
@section('content')
<section class="shop-page padding-top-100 padding-bottom-100">
      <div class="container">
        <div class="row">
          @include('user.product.sidebar')
          <!-- Item Content -->
          <div class="col-sm-9">
            @include('user.product.filter')

            <div class="papular-block row single-img-demos">
              <!-- Item -->
              @forelse ($product as $item)
              <div class="col-md-4">
                <div class="item">
                  <!-- Item img -->
                  <div class="item-img"> <img class="img-1" src="{{ asset('storage/'.$item->productImage->first()->path) }}" alt="" >
                    <!-- Overlay -->
                    <div class="overlay">
                      <div class="position-center-center">
                        <div class="inn"><a href="{{ asset('storage/'.$item->productImage->first()->path) }}" data-lighter><i class="icon-magnifier"></i></a> <a href="#."><i class="icon-basket"></i></a> <a href="#." ><i class="icon-heart"></i></a></div>
                      </div>
                    </div>
                  </div>
                  <!-- Item Name -->
                  <div class="item-name" style="font-size: 11px"> <a href="{{ url('product/detail/'.$item->slug) }}" style="font-size: 16px">{{ $item->name }}</a>
                    <p>{{ $item->short_description }}</p>
                  </div>
                  <!-- Price -->
                  {{-- @if ($item->productPriceMax->count() > 1)
                    <span class="price"><small>Rp.</small>{{ number_format($item->productPriceMin->first()->price) }} - {{ number_format($item->productPriceMax->first()->price) }}</span> </div>
                  @else --}}
                    <span class="price"><small> Rp.</small>{{ number_format($item->productPriceMax->first()->price) }}</span> </div>
                  {{-- @endif --}}
              </div>
              @empty
              <div class="item">
                  <h4>Product Not Found :(</h4>
              </div>
              @endforelse
            </div>
            <!-- Popular Item Slide -->
            {{-- <div class="papular-block row single-img-demos">

              <!-- Item -->

              @forelse ($product as $item)
              <div class="col-md-4">
                <div class="item">
                  <!-- Item img -->
                  <div class="item-img"> <img class="img-1" src="{{ asset('storage/'.$item->productImage->first()->path) }}" alt="" >
                    <!-- Overlay -->
                    <div class="overlay">
                      <div class="position-center-center">
                        <div class="inn"><a href="{{ asset('storage/'.$item->productImage->first()->path) }}" data-lighter><i class="icon-magnifier"></i></a> <a href="#."><i class="icon-basket"></i></a> <a href="#." ><i class="icon-heart"></i></a></div>
                      </div>
                    </div>
                  </div>
                  <!-- Item Name -->
                  <div class="item-name"> <a href="{{ url('product/detail/'.$item->slug) }}">{{ $item->name }}</a>
                    <p>{{ $item->short_description }}</p>
                  </div>
                  <!-- Price -->
                  @if ($item->productPriceMax->count() > 1)
                    <span class="price"><small>Rp.</small>{{ $item->productPriceMin->first()->price }} - {{ $item->productPriceMax->first()->price }}</span> </div>
                  @else
                    <span class="price"><small>Rp.</small>{{ $item->productPriceMax->first()->price }}</span> </div>
                  @endif --}}
                {{-- </div> --}}
              {{-- @empty
              <div class="item">
                  <h4>Product Not Found :(</h4>
              </div>
              @endforelse --}}
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
