<!-- Shop SideBar -->
          <div class="col-sm-3">
            <div class="shop-sidebar">

              <!-- Category -->
              <h5 class="shop-tittle margin-bottom-30">category</h5>
              <ul class="shop-cate">
                @foreach ($category as $item)
                    @if ($item->childs->count() > 0)
                        <li><a href="#."> <b>{{ $item->name }}</b> <span></span></a></li>
                        @foreach ($item->childs as $subMenu)
                        <li><a href="#."> {{ $subMenu->name }} <span></span></a></li>
                        @endforeach
                    @else
                        <li><a href="#."> <b>{{ $item->name }}</b> <span></span></a></li>
                    @endif
                @endforeach
              </ul>

              <!-- FILTER BY PRICE -->
              <h5 class="shop-tittle margin-top-60 margin-bottom-30">FILTER BY PRICE</h5>

              <!-- TAGS -->
              <h5 class="shop-tittle margin-top-60 margin-bottom-30">FILTER BY COLORS</h5>
              <ul class="colors">
                <li><a href="#." style="background:#958170;"></a></li>
                <li><a href="#." style="background:#c9a688;"></a></li>
                <li><a href="#." style="background:#c9c288;"></a></li>
                <li><a href="#." style="background:#a7c988;"></a></li>
                <li><a href="#." style="background:#9ed66b;"></a></li>
                <li><a href="#." style="background:#6bd6b1;"></a></li>
                <li><a href="#." style="background:#82c2dc;"></a></li>
                <li><a href="#." style="background:#8295dc;"></a></li>
                <li><a href="#." style="background:#9b82dc;"></a></li>
                <li><a href="#." style="background:#dc82d9;"></a></li>
                <li><a href="#." style="background:#dc82a2;"></a></li>
                <li><a href="#." style="background:#e04756;"></a></li>
                <li><a href="#." style="background:#f56868;"></a></li>
                <li><a href="#." style="background:#eda339;"></a></li>
                <li><a href="#." style="background:#edd639;"></a></li>
                <li><a href="#." style="background:#daed39;"></a></li>
                <li><a href="#." style="background:#a3ed39;"></a></li>
                <li><a href="#." style="background:#f56868;"></a></li>
              </ul>
            </div>
          </div>
