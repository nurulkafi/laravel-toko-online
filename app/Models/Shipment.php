<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Shipment extends Model
{
    use HasFactory;
    public const PENDING = 'pending';
    public const SHIPPED = 'shipped';

    protected $fillable = [
        'user_id',
        'order_id',
        'track_number',
        'status',
        'total_qty',
        'total_weight',
        'first_name',
        'last_name',
        'address1',
        'address2',
        'phone',
        'email',
        'city_id',
        'province_id',
        'postcode',
        'shipped_by',
        'shipped_at',
    ];
    public function findTrackNumber($kurir,$track_number){
        $response = Http::get('https://api.binderbyte.com/v1/track', [
            'api_key' => env('BINDER_BYTE_KEY'),
            'courier' => $kurir,
            'awb' => $track_number
        ]);
        if ($response->json() == null) {
            $status = 400;
        } else {
            $status = $response->json()['status'];
        }

        if ($status == 200) {
            $history = array_reverse($response->json()['data']['history']);
        } else {
            $history = null;
        }
        return $history;
    }
}
