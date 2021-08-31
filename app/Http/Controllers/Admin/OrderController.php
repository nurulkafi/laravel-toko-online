<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        //
        $title = "Order";
        $order = Order::get();
        $newOrders = Order::where('status', Order::CONFIRMED)->get();
        return view('admin.orders.index',compact('title', 'newOrders','order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $order_items = DB::table('order_items')
        ->select('sku', 'size', 'name', 'price', 'order_items.qty')
        ->join('products', 'products.id', '=', 'order_items.product_id')
        ->join('product_atributes', 'product_atributes.id', '=', 'order_items.product_atribut_id')
        ->where('order_id', $id)
        ->get();
        $title = "Order Info";
        $newOrders = Order::where('status', Order::CONFIRMED)->get();
        return view('admin.orders.show',compact('title','order','order_items','newOrders'));
    }
    public function process($id){
        $order = Order::findOrfail($id);

        $order->status = Order::PROCESSED;
        $order->approved_by = Auth::user()->id;
        $order->approved_at = now();
        $order->save();
        Alert::success('success','Order On Process');
        return redirect('admin/order');
    }
    public function print($id){
        $order = Order::find($id);
        $order_items = DB::table('order_items')
        ->select('sku', 'size', 'name', 'price', 'order_items.qty')
        ->join('products', 'products.id', '=', 'order_items.product_id')
        ->join('product_atributes', 'product_atributes.id', '=', 'order_items.product_atribut_id')
        ->where('order_id', $id)
        ->get();
        return view('admin.orders.print',compact('order','order_items'));
    }
    public function saveinvoice($id)
    {
        $order = Order::find($id);
        $order_items = DB::table('order_items')
        ->select('sku', 'size', 'name', 'price', 'order_items.qty')
        ->join('products', 'products.id', '=', 'order_items.product_id')
        ->join('product_atributes', 'product_atributes.id', '=', 'order_items.product_atribut_id')
        ->where('order_id', $id)
        ->get();
        $pdf = PDF::loadView('admin.orders.print', compact('order','order_items'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('invoice-pdf.pdf');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
