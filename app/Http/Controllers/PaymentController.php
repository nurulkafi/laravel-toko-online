<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    public function notification(Request $request)
    {
        $payload = $request->getContent();
        $notification = json_decode($payload);
        $validSignatureKey = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . 'SB-Mid-server-hlP3PbyI6b2Xrdj0P3g6-Ws2');
        if ($notification->signature_key != $validSignatureKey) {
            return response(['message' => 'Invalid signature'], 403);
        }
        $this->initpayment();
        $statusCode = null;
        $paymentNotification = new \Midtrans\Notification();
        $order = Order::where('code', $paymentNotification->order_id)->firstOrFail();


        if ($order->isPaid()) {
            return response(['message' => 'The order has been paid before'], 422);
        }

        $transaction = $paymentNotification->transaction_status;
        $type = $paymentNotification->payment_type;
        $orderId = $paymentNotification->order_id;
        $fraud = $paymentNotification->fraud_status;
        $vaNumber = null;
        $vendorName = null;
        if (!empty($paymentNotification->va_numbers[0])) {
            $vaNumber = $paymentNotification->va_numbers[0]->va_number;
            $vendorName = $paymentNotification->va_numbers[0]->bank;
        }else{
            $vaNumber = null;
            $vendorName = null;
        }
        $paymentStatus = null;
        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    $paymentStatus = Payment::CHALLENGE;
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    $paymentStatus = Payment::SUCCESS;
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $paymentStatus = Payment::SETTLEMENT;
        } else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $paymentStatus = Payment::PENDING;
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            $paymentStatus = PAYMENT::DENY;
        } else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $paymentStatus = PAYMENT::EXPIRE;
        } else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            $paymentStatus = PAYMENT::CANCEL;
        }

        $paymentParams = [
            'order_id' => $order->id,
            'number' => Str::random(3),
            'amount' => $paymentNotification->gross_amount,
            'method' => 'midtrans',
            'status' => $paymentStatus,
            'token' => $paymentNotification->transaction_id,
            'payloads' => $payload,
            'payment_type' => $paymentNotification->payment_type,
            'va_number' => $vaNumber,
            'vendor_name' => $vendorName,
            'biller_code' => "null",
            'bill_key' => "null",
        ];

        $payment = Payment::create($paymentParams);

        if ($paymentStatus && $payment) {
            DB::transaction(
                function () use ($order, $payment) {
                    if (in_array($payment->status, [Payment::SUCCESS, Payment::SETTLEMENT])) {
                        $order->payment_status = Order::PAID;
                        $order->status = Order::CONFIRMED;
                        $order->save();
                    }
                }
            );
        }
        $message = 'Payment status is : ' . $paymentStatus;
        $response = [
            'code' => 200,
            'message' => $message,
        ];
        return response($response, 200);
    }

    /**
     * Show completed payment status
     *
     * @param Request $request payment data
     *
     * @return void
     */
    public function completed(Request $request)
    {
        $code = $request->query('order_id');
        $order = Order::where('code', $code)->firstOrFail();
        if ($order->payment_status == Order::UNPAID) {
            Alert::success('success','payment unpaid');
            return redirect('product');
        }
        Alert::success('success', 'payment success');
        return redirect('product');
    }

    /**
     * Show unfinish payment page
     *
     * @param Request $request payment data
     *
     * @return void
     */
    public function unfinish(Request $request)
    {
        $code = $request->query('order_id');
        $order = Order::where('code', $code)->firstOrFail();

        Alert::success('success', 'payment unfinish');
        return redirect('product');
    }

    /**
     * Show failed payment page
     *
     * @param Request $request payment data
     *
     * @return void
     */
    public function failed(Request $request)
    {
        $code = $request->query('order_id');
        $order = Order::where('code', $code)->firstOrFail();

        Alert::failed('success', 'payment failed');
        return redirect('product');
    }
}
