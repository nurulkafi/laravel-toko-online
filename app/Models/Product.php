<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function categories(){
        return $this->belongsToMany('App\Models\Categories');
    }

    public function statuses(){
        return [
            0 => 'draft',
            1 => 'active',
            2 => 'inactive'
        ];
    }

    public function productImage(){
        return $this->hasMany('App\Models\ProductImage')->orderBy('id','ASC');
    }

    public function productPriceMax(){
        return $this->hasMany('App\Models\ProductAtribute')->orderBy('price','Desc');
    }
    public function productPriceMin()
    {
        return $this->hasMany('App\Models\ProductAtribute')->orderBy('price', 'ASC');
    }
    public function productAtribute()
    {
        return $this->hasMany('App\Models\ProductAtribute');
    }
    public function category($id){
        $data = Category::findOrfail($id);
        return $data;
    }
}
