<?php

namespace App\Http\Services\Global;

use Illuminate\Support\Facades\Http;

class StripePaymentService
{
    public function pay($amount, $curancy = "usd")
    {

        $sercriteKey = config("stripe.secret_key");
        Http::withToken($sercriteKey)
            ->post(config("stripe.stripe_base_url") . "v1/checkout/sessions", [
                'mode' => 'payment',
                'payment_method_types[]' => 'card',
                'line_items[0][price_data][currency]' => $curancy,
                'line_items[0][price_data][product_data][name]' => 'Demo Product',
                'line_items[0][price_data][unit_amount]' => $amount * 100,
                'line_items[0][quantity]' => 1,
                'success_url' => "https://www.google.com",
                'cancel_url' => "https://www.facebook.com",
    ]);
    }
}