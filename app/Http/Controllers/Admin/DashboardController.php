<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
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
    public function singkat_angka($n, $presisi = 2)
    {
        if ($n < 900) {
            $format_angka = number_format($n, $presisi);
            $simbol = '';
        } else if ($n < 900000) {
            $format_angka = number_format($n / 1000, $presisi);
            $simbol = 'RB';
        } else if ($n < 900000000) {
            $format_angka = number_format($n / 1000000, $presisi);
            $simbol = 'JT';
        } else if ($n < 900000000000) {
            $format_angka = number_format($n / 1000000000, $presisi);
            $simbol = 'M';
        } else {
            $format_angka = number_format($n / 1000000000000, $presisi);
            $simbol = 'T';
        }

        if ($presisi > 0) {
            $pisah = '.' . str_repeat('0', $presisi);
            $format_angka = str_replace($pisah, '', $format_angka);
        }

        return $format_angka . $simbol;
    }
    public function index()
    {

        $title = "Dashboard";
        //charts
        $year = date("Y");
        for ($i = 1; $i <= 12; $i++) {
            # code...
            $revenue[] = Order::where('status', Order::DELIVERED)
                ->whereBetween('order_date', [$year . '-' . $i . '-01 00:00:00', $year . '-' . $i . '-31 23:59:59'])
                ->sum('base_total_price');
        }
        $month = [
            "January", "Februry", "March", "April",
            "May", "June", "July", "August",
            "Sepetember", "October", "November", "Desember"
        ];
        $i = 0;
        $data =[];
        foreach ($revenue as $item) {
            $temp['x'] = $month[$i++];
            $temp['y'] = $item;
            array_push($data,$temp);
        }
        //new orders
        $newOrders = Order::where('status',Order::CONFIRMED)->get();
        //out of stock
        $ofs = DB::table('products')
                ->join('product_atributes','products.id','=','product_atributes.product_id')
                ->where('qty',0)
                ->get();
        //item sold
        $itemsold = OrderItem::get()->sum('qty');
        //income
        $income = Order::where('status', Order::DELIVERED)->sum('base_total_price');
        $income = $this->singkat_angka($income);
        return view('admin.dashboard.index',compact('title','data','newOrders','ofs','itemsold','income'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        //
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
