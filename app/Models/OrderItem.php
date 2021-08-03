<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'product_atribut_id',
        'qty',
        'base_price',
        'base_total',
        'tax_amount',
        'tax_percent',
        'discount_amount',
        'discount_percent',
        'sub_total'
    ];

    /**
     * Define relationship with the Product
     *
     * @return void
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
