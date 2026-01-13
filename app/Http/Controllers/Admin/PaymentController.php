<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments.
     */
    public function index()
    {
        $payments = Payment::with(['booking'])->get();
        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Display the specified payment.
     */
    public function show($id)
    {
        $payment = Payment::with(['booking'])->findOrFail($id);
        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Verify the specified payment.
     */
    public function verify($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->statusPembayaran = 'success';
        $payment->tanggalBayar = now();
        $payment->save();

        // Update the associated booking status
        $booking = $payment->booking;
        if ($booking) {
            $booking->status = 'confirmed';
            $booking->save();
        }

        return redirect()->back()->with('success', 'Payment verified successfully!');
    }

    /**
     * Process the specified payment.
     */
    public function process(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        // In a real implementation, you would process the payment through a payment gateway
        // For now, we'll just update the status based on the request

        $request->validate([
            'status' => 'required|in:pending,success,failed'
        ]);

        $payment->statusPembayaran = $request->status;
        if ($request->status === 'success') {
            $payment->tanggalBayar = now();
        }
        $payment->save();

        // Update the associated booking status if payment is successful
        if ($request->status === 'success') {
            $booking = $payment->booking;
            if ($booking) {
                $booking->status = 'confirmed';
                $booking->save();
            }
        }

        return redirect()->back()->with('success', 'Payment processed successfully!');
    }
}
