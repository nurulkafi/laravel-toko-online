<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAtribute extends Model
{
    use HasFactory;
    protected $guarded = [];
    public static function reduceStock($productattr_id, $qty)
    {
        $inventory = self::where('id', $productattr_id)->firstOrFail();
        $inventory->qty = $inventory->qty - $qty;
        $inventory->save();
    }
}
