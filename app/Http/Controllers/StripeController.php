<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function checkout()
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'gpb',
                        'product_data' => [
                            'name' => 'Sent mony!!!',
                        ],
                        'unit_amount' => 500,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('success'),
        ]);
    }

    public function success()
    {
        return view('index')->with('success', 'تم التحويل بنجاح');
    }
}
