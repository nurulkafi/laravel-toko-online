<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'code',
        'status',
        'order_date',
        'payment_due',
        'payment_status',
        'base_total_price',
        'tax_amount',
        'tax_percent',
        'discount_amount',
        'discount_percent',
        'shipping_cost',
        'grand_total',
        'note',
        'customer_first_name',
        'customer_last_name',
        'customer_address1',
        'customer_address2',
        'customer_phone',
        'customer_email',
        'customer_city_id',
        'customer_province_id',
        'customer_postcode',
        'shipping_courier',
        'shipping_service_name',
        'approved_by',
        'approved_at',
        'cancelled_by',
        'cancelled_at',
        'cancellation_note',
    ];

    protected $appends = ['customer_full_name'];

    public const CREATED = 'created';
    public const CONFIRMED = 'confirmed';
    public const PROCESSED ='processed';
    public const DELIVERED = 'delivered';
    public const COMPLETED = 'completed';
    public const CANCELLED = 'cancelled';

    public const ORDERCODE = 'INV';

    public const PAID = 'paid';
    public const UNPAID = 'unpaid';

    public const STATUSES = [
        self::CREATED => 'Created',
        self::CONFIRMED => 'Confirmed',
        self::DELIVERED => 'Delivered',
        self::COMPLETED => 'Completed',
        self::CANCELLED => 'Cancelled',
    ];
    public function orderItems()
    {
        return $this->hasMany('App\Models\OrderItem');
    }
    private static function _isOrderCodeExists($orderCode)
    {
        return Order::where('code', '=', $orderCode)->exists();
    }
    public function track_number(){
        return $this->hasOne('App\Models\Shipment');
    }
    public static function province($id){
        $province = Province::find($id);
        return $province->title;
    }
    public static function city($id)
    {
        $province = city::find($id);
        return $province->title;
    }
    public function image(){
        return $this->hasMany('App\Models\ProductImage');
    }
    /**
     * Check order is paid or not
     *
     * @return boolean
     */
    public function isPaid()
    {
        return $this->payment_status == self::PAID;
    }

    /**
     * Check order is created
     *
     * @return boolean
     */
    public function isCreated()
    {
        return $this->status == self::CREATED;
    }

    /**
     * Check order is confirmed
     *
     * @return boolean
     */
    public function isConfirmed()
    {
        return $this->status == self::CONFIRMED;
    }

    /**
     * Check order is delivered
     *
     * @return boolean
     */
    public function isDelivered()
    {
        return $this->status == self::DELIVERED;
    }

    /**
     * Check order is completed
     *
     * @return boolean
     */
    public function isCompleted()
    {
        return $this->status == self::COMPLETED;
    }

    /**
     * Check order is cancelled
     *
     * @return boolean
     */
    public function isCancelled()
    {
        return $this->status == self::CANCELLED;
    }

    /**
     * Add full_name custom attribute to order object
     *
     * @return boolean
     */
    public function getCustomerFullNameAttribute()
    {
        return "{$this->customer_first_name} {$this->customer_last_name}";
    }
}
