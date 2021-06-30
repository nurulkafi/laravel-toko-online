<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //field yang bisa diisikan oleh user
    protected $fillable =['name','slug','parent_id'];
    use HasFactory;
}
