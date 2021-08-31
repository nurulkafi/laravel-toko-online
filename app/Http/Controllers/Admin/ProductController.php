<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\ProductAtribute;
use App\Models\ProductImage;
use Facade\Ignition\Support\FakeComposer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Storage;

class ProductController extends Controller


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
    public function index()
    {
        //
        $data = Product::get();
        $title = 'Products';
        $newOrders = Order::where('status', Order::CONFIRMED)->get();
        return view('admin.products.index',compact('data','title', 'newOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sku(){
        $sku = DB::table('product_atributes')->orderBy('sku', 'DESC')->first();

        if ($sku != null) {
            $urutan = substr($sku->sku, 3, 3);
            $urutan = $urutan+1;
            $huruf = "ANM";
            $kode = $huruf . sprintf('%03s', $urutan);
            return $kode;
        } else {
            $urutan = 1;
            $huruf = "ANM";
            $kode = $huruf . sprintf('%03s', $urutan);
            return $kode;
        }
    }
    public function create()
    {
        $title = "Add Product";
        $data = Category::get()->where('parent_id',0);
        $newOrders = Order::where('status', Order::CONFIRMED)->get();
        return view('admin.products.formAdd',compact('title','data','newOrders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function _saveProductImage($id,$request){
        $image = $request;
        $slug = Str::slug($image);
        $fileName = $slug . '.' . $image->getClientOriginalExtension();

        $folder = '/uploads/images';
        $filepath = $image->storeAs($folder, $fileName, 'public');

        $largeImageFilePath = 'uploads/images' . '/large/' . $fileName;
        $largeImageFile = Image::make($image)->fit(478, 512)->stream();
        \Storage::put('public/' . $largeImageFilePath, $largeImageFile);
        $resizedImage = $largeImageFilePath;

        $mediumFilePath = 'uploads/images' . '/medium/' . $fileName;
        $mediumFile = Image::make($image)->fit(270, 352)->stream();
        \Storage::put('public/' . $mediumFilePath, $mediumFile);
        $resizedmediumImage = $mediumFilePath;

        $smallFilePath = 'uploads/images' . '/small/' . $fileName;
        $smallFile = Image::make($image)->fit(170, 170)->stream();
        \Storage::put('public/' . $smallFilePath, $smallFile);
        $resizedsmallImage = $smallFilePath;

        $extraFilePath = 'uploads/images' . '/extra_large/' . $fileName;
        $extraFile = Image::make($image)->fit(700, 710)->stream();
        \Storage::put('public/' . $extraFilePath, $extraFile);
        $resizedextraImage = $extraFilePath;
        ProductImage::create([
            'product_id' => $id,
            'path' => $filepath,
            'small' => $resizedsmallImage,
            'large' => $resizedImage,
            'medium' => $resizedmediumImage,
            'extra_large' => $resizedextraImage
        ]);
    }
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $name = $request->name;
        $category_id = $request->parent;
        $slug = Str::slug($name);
        $weight = $request->weight;
        $description = $request->description;
        $short_description = $request->short_description;
        $status = $request->status;
        $saved = Product::create([
            'user_id' => $user_id,
            'category_id' => $category_id,
            'name' => $name,
            'slug' => $slug,
            'weight' => $weight,
            'short_description' => $short_description,
            'description' => $description,
            'status' => $status
        ]);
        if(!$saved){
            Alert::success('Tambah Data', 'gagal!');
            return redirect('admin/product');
        }else {
            $image = $request->image;
            $sumImage = count($image);
            for ($i = 0; $i < $sumImage; $i++) {
                $images = $image[$i];
                $this->_saveProductImage($saved->id,$images);
            }
            $price = $request->price;
            $qty = $request->qty;
            $size = $request->size;

            for ($i=0; $i < count($size) ; $i++) {
                ProductAtribute::create([
                    'sku' => $this->sku(),
                    'product_id' => $saved->id,
                    'size' => $size[$i],
                    'price' => $price[$i],
                    'qty' => $qty[$i]
                ]);
            }
            Alert::success('Tambah Data', 'Behasil!');
            return redirect('admin/product');
        }
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
        $title = "Edit Product";
        $product = Product::find($id);
        $cats = Category::get()->where('parent_id', 0);
        $newOrders = Order::where('status', Order::CONFIRMED)->get();
        return view('admin.products.formEdit', compact('title','cats','product','newOrders'));
    }
    public function editImage($id)
    {
        $title = "Edit Product Image";
        $newOrders = Order::where('status', Order::CONFIRMED)->get();
        $productimg = DB::table('product_images')->where('product_id',$id)->get();
        return view('admin.products.formEditImage', compact('title', 'productimg','newOrders'));
    }
    public function editAttribute($id){
        $title = "Edit Product Attribute";
        $newOrders = Order::where('status', Order::CONFIRMED)->get();
        $product = DB::table('product_atributes')->where('product_id',$id)->get();
        return view('admin.products.formEditAttribute',compact('title','product','newOrders'));
    }
    public function updateAtribute($id,Request $request){
        $productatr = ProductAtribute::findOrfail($id);
        $productatr->price = $request->price;
        $productatr->size = $request->size;
        $productatr->qty = $request->qty;
        $productatr->save();
        Alert::success('Update Product Attribute', 'success');
        return redirect('admin/product/atribute/edit/' . $productatr->product_id);
    }
    public function addImage(Request $request,$id){
        $saved = $this->_saveProductImage($id,$request->image);
        Alert::success('Add Image', 'Success!');
        return redirect('admin/product/images/edit/'.$id);
    }
    public function addAttribute(Request $request){
        ProductAtribute::create([
            'sku' => $this->sku(),
            'product_id' =>$request->product_id,
            'size' => $request->size,
            'price' =>$request->price,
            'qty' => $request->qty
        ]);
        Alert::success('Add Product Attribute','success');
        return redirect('admin/product/atribute/edit/'.$request->product_id);
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
        $user_id = Auth::user()->id;
        $name = $request->name;
        $category_id = $request->parent;
        $slug = Str::slug($name);
        $weight = $request->weight;
        $description = $request->description;
        $short_description = $request->short_description;
        $status = $request->status;
        Product::where('id',$id)->first()->update([
            'user_id' => $user_id,
            'category_id' => $category_id,
            'name' => $name,
            'slug' => $slug,
            'weight' => $weight,
            'short_description' => $short_description,
            'description' => $description,
            'status' => $status
        ]);
        Alert::success('Update Data','Success!');
        return redirect('admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productImage = DB::table('product_images')->where('product_id', '=', $id)->get();
        for ($i = 0; $i < count($productImage); $i++) {
            Storage::delete(['public/'.$productImage[$i]->path, 'public/' . $productImage[$i]->small, 'public/' . $productImage[$i]->medium, 'public/' . $productImage[$i]->large, 'public/' . $productImage[$i]->extra_large]);
        }
        Product::where('id',$id)->delete();
        Alert::success('Hapus Data', 'Success');
        return redirect('/admin/product');
    }
    public function destroyImage($id){
        $data = ProductImage::findOrfail($id);
        Storage::delete(['public/' . $data->path, 'public/' . $data->small, 'public/' . $data->medium, 'public/' . $data->large, 'public/' . $data->extra_large]);
        ProductImage::findOrfail($id)->delete();
        Alert::success('Delete Image!', 'Success');
        return redirect('admin/product/images/edit/' . $data->product_id);
    }
    public function destroyAtribute($id)
    {
        $data = ProductAtribute::findOrfail($id);
        ProductAtribute::findOrfail($id)->delete();
        Alert::success('Delete Atribute!', 'Success');
        return redirect('admin/product/atribute/edit/' . $data->product_id);
    }
}
