<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function initialize(Application $application)
    {
        $reference = 'PAY-' . uniqid();

        $application->update([
            'payment_reference' => $reference
        ]);

        // $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
        //     ->post('https://api.paystack.co/transaction/initialize', [

        //         'email' => auth()->user()->email,

        //         'amount' => $application->amount,

        //         'reference' => $reference,

        //         'callback_url' => route('payment.callback'),
        //     ]);

            $response = Http::withoutVerifying()
    ->withToken(env('PAYSTACK_SECRET_KEY'))
    ->post('https://api.paystack.co/transaction/initialize', [
        'email' => auth()->user()->email,
        'amount' => $application->amount,
        'reference' => $reference,
        'callback_url' => route('payment.callback'),
    ]);

        $data = $response->json();

        if (!$data['status']) {
            return back()->with('error', 'Unable to initialize payment.');
        }

        return redirect($data['data']['authorization_url']);
    }

    
   
    public function callback(Request $request)
{
    $reference = $request->query('reference');

    if (!$reference) {
        return redirect()->route('dashboard')
            ->with('error', 'Payment reference missing.');
    }

    // $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
    //     ->get('https://api.paystack.co/transaction/verify/' . $reference);

        $response = Http::withoutVerifying()
    ->withToken(env('PAYSTACK_SECRET_KEY'))
    ->get('https://api.paystack.co/transaction/verify/' . $reference);

    $data = $response->json();

    if ($data['status'] && $data['data']['status'] === 'success') {

        $application = Application::where('payment_reference', $reference)->firstOrFail();

        $application->update([
            'payment_status' => 'paid',
        ]);

        return redirect('/application/preview/' . $application->id)
            ->with('success', 'Payment successful.');
    }

    return redirect()->route('dashboard')
        ->with('error', 'Payment verification failed.');
}

}