<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Facade\Ignition\Support\FakeComposer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Faker\Factory as Faker;

class ProductController extends Controller


{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Product::get();
        $title = 'Products';
        return view('admin.products.index',compact('data','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sku($index){
        $sku = DB::table('product_skus')->orderBy('sku', 'DESC')->first();

        if ($sku != null) {
            $urutan = substr($sku->sku, 3, 3);
            $urutan = $urutan+$index;
            $huruf = "ANM";
            $kode = $huruf . sprintf('%03s', $urutan);
            return $kode;
        } else {
            $urutan = $index;
            $huruf = "ANM";
            $kode = $huruf . sprintf('%03s', $urutan);
            return $kode;
        }
    }
    public function create()
    {

        $title = "Add Product";
        $data = Category::get()->where('parent_id',0);
        $opt = DB::table('product_options')->orderBy('id','ASC')->get();

        return view('admin.products.formAdd',compact('title','data','opt'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = 1;
        $name = $request->name;
        $category_id = $request->parent;
        $slug = Str::slug($name);
        $weight = $request->weight;
        $description = $request->description;
        $status = $request->status;
        $saved = Product::create([
            'user_id' => $user_id,
            'category_id' => $category_id,
            'name' => $name,
            'slug' => $slug,
            'weight' => $weight,
            'description' => $description,
            'status' => $status
        ]);
        if(!$saved){
            Alert::success('Tambah Data', 'gagal!');
            return redirect('admin/product');
        }else {
            $image = $request->image;
            $sumImage = count($image);
            $data = Product::orderBy('id', 'DESC')->first();
            for ($i = 0; $i < $sumImage; $i++) {
                $images = $image[$i];
                $slug = Str::slug($image[$i]);
                $fileName = $slug . '.' . $images->getClientOriginalExtension();

                $folder = '/uploads/images';
                $filepath = $images->storeAs($folder, $fileName, 'public');

                ProductImage::create([
                    'product_id' => $data->id,
                    'path' => $filepath
                ]);
            }
            $optionID = $request->option_id;
            $valueID = $request->value_id;
            $valueName = $request->value_name;
            $price = $request->price;
            $qty = $request->qty;
            for ($i = 0; $i < count($optionID); $i++) {
                if ($valueName[$i] != "0" && $valueID != "0") {
                    DB::insert(
                        'insert into product_option_values (product_id, product_option_id,name)
                        values (?, ? ,? )',
                        [$data->id, $optionID[$i], $valueName[$i]]
                    );
                }
            }

            for ($j = 0; $j < count($price); $j++) {
                $index = 1;
                $in = $j * 3;
                DB::insert(
                    'insert into product_skus (product_id,sku,price,qty)
                    values (?,?,?,?)',
                    [$data->id, $this->sku($index), $price[$j], $qty[$j]]
                );
                $product_option_id = DB::table('product_option_values')->where('product_id', $data->id)->get();
                $poduct_sku_id = DB::table('product_skus')->where('product_id',$data->id)->get();
                for ($k = $in; $k < 3 * ($j + 1); $k++) {
                    if ($valueName[$k] != "0") {
                        DB::insert(
                            'insert into product_skus_values (product_id,product_sku_id,product_option_id,product_option_value_id)
                        values (?,?,?,?)',
                                [$data->id,$poduct_sku_id[$j]->id, $optionID[$k], $product_option_id[$k]->id]
                            );
                    }
                }
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
        $data = DB::table('products')
                ->join('product_skus_values','products.id','=','product_skus_values.product_id')
                ->join('product_skus', 'product_skus_values.product_sku_id', '=', 'product_skus.id')
                ->join('product_options', 'product_options.id' ,'=','product_skus_values.product_option_id')
                ->join('product_option_values', 'product_option_values.id','=', 'product_skus_values.product_option_value_id')
                ->where('products.id',$id)
                ->orderBy('product_skus_values.id')
                ->get();

        $title = "Edit Product";
        $data2 = Product::find($id);
        $cats = Category::get()->where('parent_id', 0);
        $img = DB::table('product_images')->where('product_id',$id)->get();
        return view('admin.products.formEdit', compact('title','data','data2','cats','img'));
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
        $user_id = 1;
        $sku = $request->sku;
        $name = $request->name;
        $slug = Str::slug($name);
        $price = $request->price;
        $weight = $request->weight;
        $width = $request->width;
        $height = $request->height;
        $length = $request->length;
        $short_description = $request->short_description;
        $description = $request->description;
        $status = $request->status;
        Product::where('id',$id)->first()->update([
            'user_id' => $user_id,
            'sku' => $sku,
            'name' => $name,
            'slug' => $slug,
            'price' => $price,
            'weight' => $weight,
            'width' => $width,
            'height' => $height,
            'length' => $length,
            'short_description' => $short_description,
            'description' => $description,
            'status' => $status
        ]);
        Alert::success('Edit Data','Success!');
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
        //
        Product::where('id',$id)->delete();
        Alert::success('Hapus Data', 'Success');
        return redirect('/admin/product');
    }
    public function edit_pvariant($id){
        $data = DB::table('products')
        ->join('product_skus_values', 'products.id', '=', 'product_skus_values.product_id')
        ->join('product_skus', 'product_skus_values.product_sku_id', '=', 'product_skus.id')
        ->join('product_options', 'product_options.id', '=', 'product_skus_values.product_option_id')
        ->join('product_option_values', 'product_option_values.id', '=', 'product_skus_values.product_option_value_id')
        ->where('products.id', $id)
        ->orderBy('product_skus_values.id')
        ->get();

        $title = "Edit Product";
        $data2 = Product::find($id);
        return view('admin.products.formEditProductVariant', compact('title', 'data', 'data2'));
    }
    public function update_pvariant(Request $request){
        $value_id = $request->option_id;
        $name = $request->value_name;
        $sku_id = $request->sku_id;
        $price = $request->price;
        $qty = $request->qty;
        for ($i = 0; $i < 3; $i++) {
            DB::update('update product_option_values set name = ? where id = ?', [$name[$i], $value_id[$i]]);
        }
        DB::update('update product_skus set price = ? , qty = ? where id = ?', [$price,$qty,$sku_id]);

        Alert::success('Update','Sucess!');
        return redirect()->back();
    }
}
