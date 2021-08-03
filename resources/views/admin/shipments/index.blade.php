@extends('admin.layouts.main')
@section('sub', 'has-sub')
@section('submenu')
<ul class="submenu ">
    <li class="submenu-item">
        <a href="{{ url('admin/order') }}">Table Order</a>
    </li>
    <li class="submenu-item">
        <a href="{{ url('admin/order/show/'.$shipment->order_id) }}">Info</a>
    </li>
    <li class="submenu-item active">
        <a href="{{ url('admin/shipment/'.$shipment->order_id) }}">Shippment</a>
    </li>
</ul>
@endsection
@section('content')
<div class="row" id="table-bordered">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $title }} Info</h4>
        </div>
        <div class="card-content">
            <div class="card-body" style="margin-top:-40px">
                <form action="{{ url('admin/order/shipment/save/'.$shipment->order_id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" disabled class="form-control" value="{{ $shipment->first_name }}">
                            </div>
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="text" disabled class="form-control" value="{{ $shipment->phone }}">
                            </div>
                            <div class="form-group">
                                <label for="">Province</label>
                                <input type="text" disabled class="form-control" value="{{ \App\Models\Order::province($shipment->province_id) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" disabled class="form-control" value="{{ $shipment->last_name }}">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" disabled class="form-control" value="{{ $shipment->email }}">
                            </div>
                            <div class="form-group">
                                <label for="">City</label>
                                <input type="text" disabled class="form-control" value="{{ \App\Models\Order::city($shipment->city_id)}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea name="" id="" disabled cols="30" rows="10" class="form-control">{{ $shipment->address1 }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Total Item</label>
                                <input type="text" disabled class="form-control" value="{{ $shipment->total_qty }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Total Weight</label>
                                <input type="text" disabled class="form-control" value="{{ $shipment->total_weight }}">
                            </div>
                        </div>
                    </div>
                    @if ($shipment->status == App\Models\Shipment::SHIPPED)
                    <div class="form-group">
                        <label for="">Truck Number</label>
                        <input type="text" class="form-control" value="{{ $shipment->track_number }}" name="truck_number">
                    </div>
                    @else
                    <div class="form-group">
                        <label for="">Truck Number</label>
                        <input type="text" class="form-control" name="truck_number">
                    </div>
                    @endif
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
