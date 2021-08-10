@extends('user.layout.main')
@section('content')
<div class="container">
    @forelse ($order as $item)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Order Info</h3>
        </div>
        <div class="panel-body">
            @foreach ($item->orderItems as $orderItems)
            <div class="row">
                <div class="col-md-2">
                    <img class="img-thumbnail" src="{{ url('storage/'.$orderItems->product->productImage->first()->small ) }}" alt="">
                </div>
                <div class="col-md-3">
                    <h6>
                        {{ $orderItems->product->name." ''".$orderItems->product->productAtribute->first()->size }} <span style="text-transform: lowercase">{{ " x".$orderItems->qty }}</span>
                    </h6>
                    <h6>
                        Rp.{{ number_format($orderItems->product->productAtribute->first()->price) }}
                    </h6>
                </div>
            </div>
            @endforeach
            <hr>
            <div class="row">
                <div class="col-md-2">
                    <p>Total Items Cost</p>
                </div>
                <div class="col-md-3">
                    <p>: Rp.{{ number_format($item->base_total_price) }}<p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <p>Total Shiping Cost</p>
                </div>
                <div class="col-md-3">
                    <p>: Rp.{{ number_format($item->shipping_cost) }}<p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <p>Grand Total</p>
                </div>
                <div class="col-md-3">
                    <p>: Rp.{{ number_format($item->grand_total) }}<p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-2">
                    <p>{{ $item->created_at }}<p>
                </div>
                <div class="col-md-3">
                    <p>Transaksi Dilakukan<p>
                </div>
            </div>
            @if ($item->status == \App\Models\Order::PROCESSED || $item->status == \App\Models\Order::DELIVERED)
                <div class="row">
                    <div class="col-md-2">
                        <p>{{ $item->approved_at }}<p>
                    </div>
                    <div class="col-md-3">
                        <p>Pesanan Diproses<p>
                    </div>
                </div>
            @endif
            @if ($item->status == \App\Models\Order::DELIVERED)
            <div class="row">
                <div class="col-md-2">
                    <p>{{ $item->track_number->shipped_at }}<p>
                </div>
                <div class="col-md-10">
                    <p>Pesanan Dikirim({{ $item->shipping_courier.":".$item->track_number->track_number }})<p>
                </div>
            </div>
            @endif
        </div>
    </div>
    @if ($item->track_number->track_number != 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Shipping Info</h3>
        </div>
        <div class="panel-body">
            @php
                $kurir = $item->shipping_courier;
                $awb =$item->track_number->track_number;
                $ship = $item->track_number->findTrackNumber($kurir,$awb);
            @endphp
            @foreach ($ship as $ships)
            <div class="row">
                <div class="col-md-2"><p>{{ $ships['date'] }}</p></div>
                <div class="col-md-10"><p>{{ $ships['desc'] }}</p></div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @empty
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Order Info</h3>
        </div>
        <div class="panel-body">
            @foreach ($collection as $item)

            @endforeach
        </div>
    </div>
    @endforelse
</div>
@endsection
