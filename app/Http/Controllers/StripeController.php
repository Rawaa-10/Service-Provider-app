<?php

namespace App\Http\Controllers;

use App\Http\Services\Global\StripePaymentService;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    protected $stripeservice;
    public function __construct(StripePaymentService $stripeservice){
        $this-> stripeservice = $stripeservice;
    }
    public function pay(Request $request , StripePaymentService $stripeservice){
        return $this->stripeservice->pay($request,$stripeservice);
    }
}
