<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAtribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    //
    public function index(){
        if (Auth::check() != false) {
            $userID = Auth::user()->id;
            $cart = \Cart::session($userID)->getContent();
        } else {
            $cart = \Cart::getContent();
        }
        $category = Category::get()->where('parent_id',0);
        return view('user.cart.index',compact('cart','category'));
    }
    public function store(Request $request){
        $userID = Auth::user()->id;
        $product = Product::findOrfail($request->product_id);
        $attr = ProductAtribute::findOrfail($request->atribut_id);
        $item = [
            'id' => $attr->id,
            'name' => $product->name,
            'price' => $attr->price,
            'quantity' => $request->qty,
            'attributes' => $attr->size,
            'associatedModel' => $product,
        ];
        \Cart::session($userID)->add($item);
        Alert::success('success','Success to add Cart');
        return redirect('/product/detail/' . $product->slug);
    }
}
