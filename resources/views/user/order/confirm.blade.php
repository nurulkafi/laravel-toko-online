@extends('user.layout.main')
@section('content')
<div id="content">
    <section class="contact padding-top-100 padding-bottom-100">
        <div class="row">
            <div class="col-md-6">
                <div class="contact-info" style="margin-top: -40px">
                    <h5>Your Address : </h5>
                    <ul>
                      <li> <i class="fa fa-user"></i>
                        <div class="row">
                          <div class="col-md-3">Name</div>
                          <div class="col-md-9">{{ " : ".$order->customer_first_name." ".$order->customer_last_name  }}</div>
                        </div>
                      </li>
                      <li> <i class="fas fa-map-marker-alt"></i>
                        <div class="row">
                          <div class="col-md-3">Address</div>
                          <div class="col-md-9">{{ " : ".$order->customer_address1 }}</div>
                        </div>
                      </li>
                      <li> <i class="fa fa-envelope"></i>
                        <div class="row">
                          <div class="col-md-3">Email</div>
                          <div class="col-md-9">{{ " : ".$order->customer_email }}</div>
                        </div>
                      </li>
                      <li> <i class="fa fa-phone"></i>
                        <div class="row">
                          <div class="col-md-3">Phone</div>
                          <div class="col-md-9">{{ " : ".$order->customer_phone }}</div>
                        </div>
                      </li>
                  </ul>
                  </div>
            </div>
            <div class="col-md-6">
                <div class="contact-info" style="margin-top: -40px">
                    <h5>Order Detail : </h5>
                    <ul>
                      <li> <i class="fa fa-hashtag"></i>
                        <div class="row">
                          <div class="col-md-3">Invoice Code</div>
                          <div class="col-md-9">{{ " : ".$order->code}}</div>
                        </div>
                      </li>
                      <li> <i class="fa fa-calendar-alt"></i>
                        <div class="row">
                          <div class="col-md-3">Order Date</div>
                          <div class="col-md-9">{{ " : ".date('l,d/m/Y H:i:s', strtotime($order->order_date));}}</div>
                        </div>
                      </li>
                      <li><i class="fa fa-money-check"></i>
                        <div class="row">
                          <div class="col-md-3">Payment Status</div>
                          <div class="col-md-9"> {{ " : ".$order->payment_status }}</div>
                        </div>
                      </li>
                      <li> <i class="fa fa-shipping-fast"></i>
                        <div class="row">
                          <div class="col-md-3">Shipping </div>
                          <div class="col-md-9">{{ " : ".$order->shipping_courier." ".$order->shipping_service_name }}</div>
                        </div>
                      </li>
                  </ul>
                  </div>
            </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-md-6">
                <div class="contact-info">
                    <h5>Items :</h5>
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Item Name</th>
                            <th>Item Size</th>
                            <th>Item Price</th>
                            <th>Qty</th>
                            <th>Total Item Price</th>
                        </tr>
                        @forelse ($items as $item)
                        <tr>
                            <td>{{ $item->sku }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->size }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->qty*$item->price }}</td>
                        </tr>
                        @empty
                            <h1>Empty!</h1>
                        @endforelse
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-info">
                    <h5>Paid :</h5>
                    <ul>
                        <li> <i class="fa fa-tshirt"></i>
                            <div class="row">
                                <div class="col-md-3">Total Items Price </div>
                                <div class="col-md-9">{{ " : RP. ".$order->base_total_price }}</div>
                            </div>
                        </li>
                        <li> <i class="fa fa-shipping-fast"></i>
                            <div class="row">
                                <div class="col-md-3">Shipping Cost </div>
                                <div class="col-md-9">{{ " : RP. ".$order->shipping_cost }}</div>
                            </div>
                        </li>
                        <li> <i class="fa fa-money-check-alt"></i>
                            <div class="row">
                                <div class="col-md-3">GRAND TOTAL</div>
                                <div class="col-md-9">{{ " : RP. ".$order->grand_total }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
                @if (!$order->isPaid())
                    <a href="{{ $order->payment_url }}" class="btn pull-right margin-top-20" >Payment</a>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
