<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Stripe\Stripe;
use App\Jobs\ProcessData;
class PaymentController extends BaseController
{
    public function index()
    {
        return view('payment');
    }

    public function processPayment(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        // Perform payment processing logic here

        return redirect('/')->with('success', 'Payment successful!');
    }
    public function jobs()
    {
        dispatch(new ProcessData);
        return "hello";

    }
}
