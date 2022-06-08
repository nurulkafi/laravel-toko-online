<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Courier;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductAtribute;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Input\Input;

class ProductController extends Controller
{
    //
    public function index(){
        if(Auth::check() != false){
            $userID = Auth::user()->id;
            $cart = \Cart::session($userID)->getContent();
        }else{
            $cart = \Cart::getContent();
        }
        $product = Product::paginate(10);
        $category = Category::get()->where('parent_id',0);
        return view('user.product.index',compact('product','cart', 'category'));
    }
    public function show($slug)
    {
        if (Auth::check() != false) {
            $userID = Auth::user()->id;
            $cart = \Cart::session($userID)->getContent();
        } else {
            $cart = \Cart::getContent();
        }
        $courier = Courier::get();
        $province = Province::get();
        $product = Product::where('slug',$slug)->first();
        $productsame = Product::where('id','!=',$product->id)->paginate(5);
        $category = Category::get()->where('parent_id', 0);
        return view('user.product.detail', compact('product','cart','productsame', 'category','courier','province'));
    }
    public function searchPriceAndQty($id){
        $data = ProductAtribute::where('id',$id)->first();
        return json_encode($data);
    }
    public function searchCity($id){
        $data = City::where('province_code', $id)->pluck('title', 'code');
        return json_encode($data);
    }
    private function postData($key, $url, $data_origin, $data_destination, $data_weight, $data_courier)
    {
        //retry() maskudnya function untuk retry hit API jika time out sebanyak parameter pertama dan range interval pada parameter kedua dalam milisecon
        //asForm() maksudnya menggunakan application/x-www-form-urlencoded content type biasanya untuk method POST
        //withHeaders() maksudnya parameter header (Jika diminta, masing2 API punya header masing-masing dan yang tidak pakai header)
        return Http::retry(10, 200)->asForm()->withHeaders([
            'key' => $key
        ])->post($url, [
            'origin' => $data_origin,
            'destination' => $data_destination,
            'weight' => $data_weight,
            'courier' => $data_courier
        ]);
        //setelah $url itu adalah array yaitu parameter wajib yg dibutuhkan ketika meminta POST request
    }
    public function cekOngkir($id,$berat){
        $kurirs = array('jne' ,'pos','tiki');
        $apiKey = env('RAJA_ONGKIR_KEY');
        $kotaAsal = 23; //kota bandung
        $kotaTujuan = $id;
        $url = 'https://api.rajaongkir.com/starter/cost';
        for ($i=0; $i < count($kurirs) ; $i++) {
            $respons = $this->postData($apiKey, $url, $kotaAsal, $kotaTujuan, $berat, $kurirs[$i]);
            $responses[] = json_decode(json_encode($respons['rajaongkir']), FALSE);
        }
        return json_decode(json_encode($responses), FALSE);
    }
    public function searchForm(Request $request){
        $input = $request->searchName;
        return redirect('product/search/'.$input);
    }
    public function resultSearch($id){
        if (Auth::check() != false) {
            $userID = Auth::user()->id;
            $cart = \Cart::session($userID)->getContent();
        } else {
            $cart = \Cart::getContent();
        }
        $product = Product::where('name',$id)->get();
        $category = Category::get()->where('parent_id', 0);
        return view('user.product.index', compact('product', 'category','cart'));
    }
    public function searchCategory1($slug){
        if (Auth::check() != false) {
            $userID = Auth::user()->id;
            $cart = \Cart::session($userID)->getContent();
        } else {
            $cart = \Cart::getContent();
        }
        $parent_cat = Category::where('slug', $slug)->first();
        $child_cat = Category::where('parent_id', $parent_cat->id)->first();
        $product = Product::where('category_id',$parent_cat->id)->orWhere('category_id', $child_cat->id)->paginate(10);
        $category = Category::get()->where('parent_id', 0);
        return view('user.product.index', compact('product', 'category','cart'));
    }
    public function searchCategory2($slug,$slug2)
    {
        if (Auth::check() != false) {
            $userID = Auth::user()->id;
            $cart = \Cart::session($userID)->getContent();
        } else {
            $cart = \Cart::getContent();
        }
        $cat = Category::where('slug',$slug2)->first();
        $product = Product::where('category_id', $cat->id)->paginate(10);
        $category = Category::get()->where('parent_id', 0);
        return view('user.product.index', compact('product', 'category', 'cart'));
    }
}
