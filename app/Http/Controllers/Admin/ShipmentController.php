<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ShipmentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id){
        $title = "Shipment";
        $shipment = Shipment::get()->where('order_id',$id)->first();
        $newOrders = Order::where('status', Order::CONFIRMED)->get();
        return view('admin.shipments.index',compact('title','shipment','newOrders'));
    }
    public function store(Request $request,$id){
        $order = Order::findOrfail($id);
        $shipment = Shipment::get()->where('order_id', $id)->first();

            $shipment->track_number = $request->truck_number;
            $shipment->status = Shipment::SHIPPED;
            $shipment->shipped_at = now();
            $shipment->shipped_by = Auth::user()->id;

            $save = $shipment->save();
            if($save){
                $order->status = Order::DELIVERED;
                $saveorder = $order->save();
            }

            if($saveorder){
                Alert::success('success','Order In Delivered');
                return redirect('admin/order');
            }
    }
}
