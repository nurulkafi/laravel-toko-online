<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index(){
        $product = Product::get();
        $category = Category::get()->where('parent_id',0);
        return view('user.product.index',compact('product', 'category'));
    }
    public function show($slug)
    {
        // $product = Product::get();
        // $category = Category::get()->where('parent_id', 0);
        // return view('user.product.index', compact('product', 'category'));
        $product = Product::where('slug',$slug)->first();
        $category = Category::get()->where('parent_id', 0);
        return view('user.product.detail', compact('product', 'category'));
    }
}
