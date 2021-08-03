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
        $product = Product::get();
        $category = Category::get()->where('parent_id',0);
        return view('user.product.index',compact('product','cart', 'category'));
    }
    public function show($slug)
    {
        $userID = Auth::user()->id;
        $cart = \Cart::session($userID)->getContent();
        $courier = Courier::get();
        $province = Province::get();
        $product = Product::where('slug',$slug)->first();
        $productsame = Product::where('id','!=',$product->id)->paginate(5);
        $category = Category::get()->where('parent_id', 0);
        return view('user.product.detail', compact('product','cart','productsame', 'category','courier','province'));
    }
    public function searchPriceAndQty($id){
        $data = ProductAtribute::where('id',$id)->first();
        echo json_encode($data);
    }
    public function searchCity($id){
        $data = City::where('province_code', $id)->pluck('title', 'code');
        echo json_encode($data);
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
    public function cekOngkir($id,$berat,$kurir){
        $kurirs = array('jne' ,'pos','tiki');
        $apiKey = 'e9cf1dd907c39459883d47f851ea7b86';
        $kotaAsal = 23;
        $kotaTujuan = $id;
        $url = 'https://api.rajaongkir.com/starter/cost';
        // for ($i=0; $i < 3 ; $i++) {
        //     # code...
        //     $response[$i] = $this->postData($apiKey, $url, $kotaAsal, $kotaTujuan, $berat, $kurirs[$i]);

        // }
        $response = $this->postData($apiKey, $url, $kotaAsal, $kotaTujuan, $berat, $kurir);

        if($kurir == 'jne'){
            // echo json_encode($response['rajaongkir']['results'][0]['costs']);
            // return json_decode($response->getBody(),true);
            for ($i=0; $i < count($kurirs) ; $i++) {
                # code...
                $respons = $this->postData($apiKey, $url, $kotaAsal, $kotaTujuan, $berat, $kurirs[$i]);
                $responses[] = json_decode(json_encode($respons['rajaongkir']), FALSE);
            }
            // return json_decode($responses);
        }else{
            echo json_encode($response['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value']);
        }
        // dd($response[0]->json(), $response[1]->json(), $response[2]->json());
        return json_decode(json_encode($responses), FALSE);

    }
    public function searchForm(Request $request){
        $input = $request->searchName;
        return redirect('product/search/'.$input);
    }
    public function resultSearch($id){
        $product = Product::where('name',$id)->get();
        $category = Category::get()->where('parent_id', 0);
        return view('user.product.index', compact('product', 'category'));
    }

}
