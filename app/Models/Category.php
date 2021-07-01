<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //field yang bisa diisikan oleh user
    protected $fillable =['name','slug','parent_id'];
    //Relasi
    public function childs(){
        return $this->hasMany('App\Models\Category','parent_id');
    }
    public function parent(){
        return $this->belongsTo('App\Models\Category','parent_id');
    }
    //
    use HasFactory;
}
