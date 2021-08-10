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
        Alert::success('Success','Add Cart Success!');
        return redirect('/product/detail/' . $product->slug);
    }
    public function update(Request $request)
    {
        $userID = Auth::user()->id;
        $id = $request->id;
        $qty = $request->qty;
        $index = count($request->id);
        for ($i=0; $i <$index ; $i++) {
            \Cart::session($userID)->update($id[$i],
                ['quantity' => ['relative' => false,
                                'value' => $qty[$i]
                ]
        ]);
        }
        if (Auth::check() != false) {
            $cart = \Cart::session($userID)->getContent();
        } else {
            $cart = \Cart::getContent();
        }
        $category = Category::get()->where('parent_id',0);
        Alert::success('Success','Update Cart Success! ');
        return view('user.cart.index',compact('cart','category'));
    }
    public function remove($id){
        $userID = Auth::user()->id;
        $remove = \Cart::session($userID)->remove($id);
        $cart = \Cart::session($userID)->getContent();
        $category = Category::get()->where('parent_id', 0);
        Alert::success('Success', 'Delete Cart Success! ');
        return view('user.cart.index', compact('cart', 'category'));
    }
}
