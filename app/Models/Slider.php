<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'status', 'path'];

    public function product($id){
        $product = Product::findOrFail($id);
        return $product;
    }
    public function price($id){
        $product = ProductAtribute::where('product_id',$id)->first();
        return $product;
    }
}
