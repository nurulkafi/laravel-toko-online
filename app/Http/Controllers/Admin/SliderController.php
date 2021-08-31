<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class SliderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $newOrders = Order::where('status', Order::CONFIRMED)->get();
        $title = 'Slider';
        $slider = Slider::get();
        return view('admin.slider.index', compact('newOrders','slider', 'title'));
    }
    public function create()
    {
        $newOrders = Order::where('status', Order::CONFIRMED)->get();
        $title = 'Slider';
        $product = Product::get();
        return view('admin.slider.formAdd', compact('newOrders','title','product'));
    }
    public function store(Request $request){
        $image = $request->image;
        $slug = Str::slug($image);
        $fileName = $slug . '.' . $image->getClientOriginalExtension();


        $FilePath = 'uploads/images' . '/slider/' . $fileName;
        $File = Image::make($image)->fit(1920, 1002)->stream();
        \Storage::put('public/' . $FilePath, $File);
        $resizedImage = $FilePath;

        $saved = Slider::create([
            'product_id' => $request->product_id,
            'status' => $request->status,
            'path' => $resizedImage
        ]);

        if ($saved) {
           Alert::success('Success','Add Slider');
           return redirect('admin/slider');
        }
    }
    public function destroy($id){
        $slider = Slider::findOrFail($id);
        Storage::delete(['public/' . $slider->path]);
        $slider->delete();
        Alert::success('success','Delete Slider!');
        return redirect('admin/slider');
    }
}
