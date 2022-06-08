<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Province;
use App\Models\Payment;
use App\Models\ProductAtribute;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    //

    public function codeOrder(){
        $orderDate = date('Y-m-d');
        $order = DB::table('orders')
                ->selectRaw('MAX(code) as last_code')
                ->where('order_date','like','%'.$orderDate.'%')
                ->first();
        $date = date('Ymd');
        if($order != null){
            $order = substr($order->last_code, 13, 4)+1;
            $order = "INV/" . $date . "/" . sprintf('%04s', $order);
            return $order;
        }else{
            $order = "INV/" . $date . "/0001";
            return $order;
        }
    }

    public function index(){
        if (Auth::check() != false) {
            $userID = Auth::user()->id;
            $cart = \Cart::session($userID)->getContent();
        } else {
            $cart = \Cart::getContent();
        }
        $category = Category::get()->where('parent_id', 0);
        $province = Province::get();
        return view('user.order.index', compact('cart', 'category','province'));
    }
    public function _saveOrder($request){
        $userID = Auth::user()->id;
        $totalprice = \Cart::session($userID)->getTotal();
        $grandTotal = ($totalprice+$request['shippingcost']);
        $orderDate = date('Y-m-d H:i:s');
        $paymentDue = (new \DateTime($orderDate))->modify('+7 day')->format('Y-m-d H:i:s');

        $save = [
            'user_id' => $userID,
            'code' => $this->codeOrder(),
            'status' => Order::CREATED,
            'order_date' => $orderDate,
            'payment_due' => $paymentDue,
            'payment_status' => Order::UNPAID,
            'base_total_price' => $totalprice,
            'shipping_cost' => $request['shippingcost'],
            'grand_total' => $grandTotal,
            'customer_first_name' => $request['first_name'],
            'customer_last_name' => $request['last_name'],
            'customer_address1' => $request['address'],
            'customer_phone' => $request['phone'],
            'customer_email' => $request['email'],
            'customer_city_id' => $request['city_id'],
            'customer_province_id' => $request['province_id'],
            'shipping_courier' => $request['codekurir'],
            'shipping_service_name' => $request['service']
        ];

        return Order::create($save);
    }
    public function doCheckout(Request $request){
        $order = DB::transaction(
                    function () use ($request) {
                        $order = $this->_saveOrder($request);
                        $this->_saveOrderItems($order);
                        $this->_generatePaymentToken($order);
                        $this->_saveShipment($order);

                        return $order;
                    }
                );

            if ($order) {
                \Cart::clear();
                Alert::success('success', 'Thank you. Your order has been received!');
                return redirect('order/confirm/'.$order->id);
            }

            return redirect('checkout');
    }
    public function _generatePaymentToken($order){
        $this->initpayment();

        $customerDetails = [
            'first_name' => $order->customer_first_name,
            'last_name' => $order->customer_last_name,
            'email' => $order->customer_email,
            'phone' => $order->customer_phone,
        ];

        $params = [
            'enable_payments' => \App\Models\Payment::PAYMENT_CHANNELS,
            'transaction_details' => [
                'order_id' => $order->code,
                'gross_amount' => $order->grand_total,
            ],
            'customer_details' => $customerDetails,
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s T'),
                'unit' => \App\Models\Payment::EXPIRY_UNIT,
                'duration' => \App\Models\Payment::EXPIRY_DURATION,
            ],
        ];

        $snap = \Midtrans\Snap::createTransaction($params);

        if ($snap->token) {
            $order->payment_token = $snap->token;
            $order->payment_url = $snap->redirect_url;
            $order->save();
        }

    }
    public function _saveOrderItems($order){
        $userID = Auth::user()->id;
        $cart = \Cart::session($userID)->getContent();

        if ($order && $cart) {
            foreach ($cart as $item) {
                $itemBaseTotal = $item->quantity * $item->price;
                $itemSubTotal = $itemBaseTotal;
                $orderItemParams = [
                    'order_id' => $order->id,
                    'product_id' => $item->associatedModel->id,
                    'product_atribut_id' => $item->id,
                    'qty' => $item->quantity,
                    'base_price' => $item->price,
                    'base_total' => $itemBaseTotal,
                    'tax_amount' => 0,
                    'tax_percent' => 0,
                    'discount_amount' => 0,
                    'discount_percent' => 0,
                    'sub_total' => $itemSubTotal,
                ];
                $orderItem = OrderItem::create($orderItemParams);
                if ($orderItem) {
                    ProductAtribute::reduceStock($orderItem->product_atribut_id, $orderItem->qty);
                }
            }
        }
    }
    private function _saveShipment($order)
    {
        $userID = Auth::user()->id;
        $cart = \Cart::session($userID)->getContent();
        $berat = 0;
        foreach ($cart as $item) {
            $berat += $item->quantity * $item->associatedModel->weight;
        }
        $shipmentParams = [
            'user_id' => $userID,
            'order_id' => $order->id,
            'status' => Shipment::PENDING,
            'total_qty' => \Cart::getTotalQuantity(),
            'total_weight' => $berat,
            'first_name' => $order->customer_first_name,
            'last_name' => $order->customer_last_name,
            'email' => $order->customer_email,
            'phone' => $order->customer_phone,
            'address1' => $order->customer_address1,
            'address2' => "null",
            'city_id' => $order->customer_city_id,
            'province_id' => $order->customer_province_id,
            'postcode' => 0,
        ];
        Shipment::create($shipmentParams);
    }
    public function confirm($id){
        $userID = Auth::user()->id;
        $cart = \Cart::session($userID)->getContent();
        $category = Category::get()->where('parent_id', 0);
        $order = Order::find($id);
        $items = DB::table('order_items')
                ->select('sku','size','name','price','order_items.qty')
                ->join('products','products.id','=','order_items.product_id')
                ->join('product_atributes','product_atributes.id','=','order_items.product_atribut_id')
                ->where('order_id',$id)
                ->get();
        return view('user.order.confirm',compact('cart','category', 'order','items'));
    }
}

