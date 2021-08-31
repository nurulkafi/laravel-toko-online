<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function revenue($year){
        $title = "Revenue";
        // $revenue = DB::table('orders')
        //             ->select('base_total_price',DB::raw('SUM(base_total_price) as total'))
        //             ->get();

        for ($i=1; $i <= 12 ; $i++) {
            # code...
            $revenue[] = Order::where('status', Order::DELIVERED)
            ->whereBetween('order_date', [ $year.'-'.$i.'-01 00:00:00', $year.'-'.$i. '-31 23:59:59'])
            ->sum('base_total_price');
        }
        $newOrders = Order::where('status', Order::CONFIRMED)->get();
        return view('admin.reports.revenue',compact('title','revenue', 'newOrders'));
    }
}
