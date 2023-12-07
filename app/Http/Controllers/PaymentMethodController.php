<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Stripe\Stripe;

class PaymentMethodController extends Controller
{
  
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment_methods = PaymentMethod::where('user_id', auth()->id())->get();
        return view('admin.payment-methods.index', compact('payment_methods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.payment-methods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        PaymentMethod::create([
            'method' => 'Credit Card',
            'active' => 1,
            'token' => $this->tokenizeCard($request->all()),
            'last_credit_numbers' => substr($request->card_number, -4),
            'user_id' => auth()->id()
        ]);
        return redirect()->route('admin.payment-methods.index')
        ->with('info', 'Payment Method has been successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($paymentMethod)
    {
        PaymentMethod::destroy($paymentMethod);
        return redirect()->route('admin.payment-methods.index')
        ->with('info', 'Payment Method has been successfully deleted.');
    }

    public function tokenizeCard($request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $token = \Stripe\Token::create([
            'card' => [
                'number' => $request['card_number'],
                'exp_month' => $request['exp_month'],
                'exp_year' => $request['exp_year'],
                'cvc' => $request['cvc'],
            ],
        ]);
        return $token->id;
    }
}
