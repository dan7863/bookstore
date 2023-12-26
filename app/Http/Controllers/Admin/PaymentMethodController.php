<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\OrderInvoice;
use App\Models\OrderLine;
use App\Models\PaymentMethod;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Stripe\Stripe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function processOrder(Book $book){
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'cop',
                    'product_data' => [
                        'name' => $book->title,
                    ],
                    'unit_amount' => intVal($book->book_purchase_detail->price*100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'invoice_creation' => ['enabled' => true],
            'customer_email' => auth()->user()->email,
            'success_url' => route('books_store.process-payment')."?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('books_store.show', $book),
            'metadata' => [
                'customer_id' => auth()->id(),
                'book_id' => $book->id,
            ],
        ]);

        header("HTTP/1.1 303 See Other");
        return redirect($checkout_session->url);
    }

    public function processPayment(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
        $session_id = $request->get('session_id');

        $session = $stripe->checkout->sessions->retrieve($session_id);

        if(!$session){
            throw new NotFoundHttpException;
        }

        $order_line = OrderLine::create([
            'session_id' => $session_id,
            'buyer_id' => auth()->id()
        ]);

        PurchaseOrder::create([
            'book_id' => $session->metadata->book_id,
            'order_line_id' => $order_line->id
        ]);

        OrderInvoice::create([
            'invoice_id' => $session->invoice,
            'order_line_id' => $order_line->id
        ]);
        
        //Invoice url: $stripe->invoices->retrieve($session->invoice)->hosted_invoice_url
        return redirect()->route('books_store.show', Book::find($session->metadata->book_id))
        ->with('invoice_url', $stripe->invoices->retrieve($session->invoice)->hosted_invoice_url);
    }
}
