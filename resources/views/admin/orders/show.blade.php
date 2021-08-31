@extends('admin.layouts.main')
@section('sub', 'has-sub')
@section('submenu')
<ul class="submenu ">
    <li class="submenu-item">
        <a href="{{ url('admin/order') }}">Table Order</a>
    </li>
    <li class="submenu-item active">
        <a href="{{ url('admin/order/show/'.$order->id) }}">Info</a>
    </li>
    <li class="submenu-item ">
        <a href="{{ url('admin/order/shipment/'.$order->id) }}">Shippment</a>
    </li>
</ul>
@endsection
@section('content')
<div class="card">
    <div class="card-title">
        <br>
        <div class="btn-group mb-3 float-end" role="group" style="margin-right: 20px">
            <a class="btn btn-primary icon icon-left" href="{{ url('admin/order/printinvoice/'.$order->id) }}" target="_blank">
                Print
                <i class="bi bi-printer"></i>
            </a>
            <a target="_blank" class="btn btn-info" href="{{ url('admin/order/saveinvoice/'.$order->id) }}">
                Save
                <i class="bi bi-file-pdf"></i>
            </a>
        </div>
    </div>
    <div class="card-content">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h6>Details</h6>
                    <p>
                        <div class="row">
                            <div class="col-md-5">Code</div>
                            <div class="col-md-7"> : {{ $order->code }}</div>
                        </div>
                    </p>
                    <p>
                        <div class="row">
                            <div class="col-md-5">Payment Status</div>
                            <div class="col-md-7"> : {{ $order->payment_status }}</div>
                        </div>
                    </p>
                    <p>
                        <div class="row">
                            <div class="col-md-5">Order Status</div>
                            <div class="col-md-7"> : {{ $order->status }}</div>
                        </div>
                    </p>
                </div>
                <div class="col-md-4">
                    <h6>Customer</h6>
                    <p>
                        <div class="row">
                            <div class="col-md-3">Name</div>
                            <div class="col-md-9"> : {{ $order->customer_first_name }} {{ $order->customer_last_name }}</div>
                        </div>
                    </p>
                    <p>
                        <div class="row">
                            <div class="col-md-3">Email</div>
                            <div class="col-md-9"> : {{ $order->customer_email }}</div>
                        </div>
                    </p>
                    <p>
                        <div class="row">
                            <div class="col-md-3">Phone</div>
                            <div class="col-md-9"> : {{ $order->customer_phone }}</div>
                        </div>
                    </p>
                </div>
                <div class="col-md-4">
                    <h6>Shippment</h6>
                    <p>
                        <div class="row">
                            <div class="col-md-4">City</div>
                            <div class="col-md-8"> : {{ $order->city($order->customer_city_id)}},{{ $order->province($order->customer_province_id)}}</div>
                        </div>
                    </p>
                    <p>
                        <div class="row">
                            <div class="col-md-4">Address</div>
                            <div class="col-md-8"> : {{ $order->customer_address1 }}</div>
                        </div>
                    </p>
                    <p>
                        <div class="row">
                            <div class="col-md-4">Courier</div>
                            <div class="col-md-8"> : {{ $order->shipping_courier }} {{ $order->shipping_service_name }}</div>
                        </div>
                    </p>
                    <p>
                        <div class="row">
                            <div class="col-md-4">Track Number</div>
                            <div class="col-md-8"> : {{ $order->track_number->track_number }}</div>
                        </div>
                    </p>
                </div>
            </div>
            <hr>
            <div class="row">
                <h6>Order Items</h6>
                <table class="table table-bordered">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                        @foreach ($order_items as $item)
                            <tr>
                                <td>{{ $item->sku }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->size }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ number_format($item->price*$item->qty) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4"><h6>Orders Cost</h6></div>
                        <div class="col-md-4"><h6> : RP. {{ number_format($order->base_total_price) }}</h6></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4"><h6>Shippment Cost</h6></div>
                        <div class="col-md-4"><h6> : RP. {{ number_format($order->shipping_cost) }}</h6></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4"><h6>Grand Total</h6></div>
                        <div class="col-md-4"><h6> : RP. {{ number_format($order->grand_total) }}</h6></div>
                    </div>
                    @if ($order->status != \App\Models\Order::DELIVERED && $order->status != \App\Models\Order::PROCESSED)
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-6"></div>
                        <div class="col-md-4"><a href="{{ url('admin/order/process/'.$order->id) }}" class="btn btn-primary rounded-pill">Process Order</a></div>
                        <div class="col-md-2"></div>
                    </div>
                    @endif
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-6"></div>
                        <div class="col-md-4"><a href="{{ url('admin/order/shipment/'.$order->id) }}" class="btn btn-info rounded-pill">Truck Number</a></div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-6"></div>
                        <div class="col-md-4"><a href="" class="btn btn-danger rounded-pill">Cancel Order</a></div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
