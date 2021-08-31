<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check() != false) {
            $userID = Auth::user()->id;
            $cart = \Cart::session($userID)->getContent();
        } else {
            $cart = \Cart::getContent();
        }
        $product = Product::paginate(8);
        $category = Category::get()->where('parent_id', 0);
        $slider = Slider::where('status',1)->get();
        return view('user.home', compact('product', 'cart', 'category','slider'));
    }
}
