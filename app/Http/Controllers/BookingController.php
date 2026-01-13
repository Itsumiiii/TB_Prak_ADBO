<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Package;
use App\Models\Schedule;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Show the booking form.
     */
    public function create()
    {
        $packages = Package::where('aktif', true)->get();

        return view('booking.create', compact('packages'));
    }

    /**
     * Store a new booking.
     */
    public function store(Request $request)
    {
        $rules = [
            'package_id' => 'required|exists:packages,idPaket',
            'tanggalAcara' => 'required|date',
            'waktuAcara' => 'required',
            'lokasiAcara' => 'required|string|max:255',
        ];

        if (!auth()->check()) {
            $rules['name'] = 'required|string|max:255';
            $rules['email'] = 'required|email|max:255';
            $rules['phone'] = 'required|string|max:20';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check availability
        $isAvailable = $this->checkAvailabilityInternal($request->tanggalAcara, $request->package_id);

        if (!$isAvailable) {
            return redirect()->back()->with('error', 'Selected date is not available for booking.')->withInput();
        }

        // Handle Guest
        if (auth()->check()) {
            $guestId = auth()->id();
        } else {
            // Check if guest exists by email
            $guest = \App\Models\Guest::where('email', $request->email)->first();
            
            if (!$guest) {
                $guest = new \App\Models\Guest();
                $guest->id_guest = 'GST' . strtoupper(substr(md5(uniqid()), 0, 8));
                $guest->name = $request->name;
                $guest->email = $request->email;
                $guest->no_hp = $request->phone;
                $guest->no_hp = $request->phone;
                $guest->save();
            } else {
                // Update phone number for existing guest if provided
                if ($request->filled('phone')) {
                    $guest->no_hp = $request->phone;
                    $guest->save();
                }
            }
            $guestId = $guest->id_guest;
        }

        // Create booking
        $booking = new Booking();
        $booking->idBooking = 'BK' . strtoupper(substr(md5(uniqid()), 0, 8)); 
        $booking->id_guest = $guestId;
        $booking->idPaket = $request->package_id;
        $booking->tanggalAcara = $request->tanggalAcara;
        $booking->waktuAcara = $request->waktuAcara;
        $booking->lokasiAcara = $request->lokasiAcara;
        $booking->status = 'pending'; 
        $booking->totalHarga = $this->calculateTotalPrice($request->package_id, $request->tanggalAcara);
        $booking->save();

        return redirect()->route('booking.success', $booking->idBooking)->with('success', 'Booking created successfully! Waiting for admin verification.');
    }

    /**
     * Show booking success page.
     */
    public function success($id)
    {
        $booking = Booking::findOrFail($id);

        return view('booking.success', compact('booking'));
    }

    /**
     * Check availability for a date.
     */
    public function checkAvailability(Request $request)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'package_id' => 'required|exists:packages,idPaket',
        ]);

        $isAvailable = $this->checkAvailabilityInternal($data['tanggal'], $data['package_id']);

        return response()->json(['available' => $isAvailable]);
    }

    /**
     * Helper method to check availability.
     */
    private function checkAvailabilityInternal($date, $packageId)
    {
        // Check if the date is already booked
        $existingBooking = Booking::where('tanggalAcara', $date)
            ->where('status', '!=', 'cancelled')
            ->first();

        if ($existingBooking) {
            return false; // Date is already booked
        }

        // Check if the date is blocked in the schedule
        $schedule = Schedule::where('tanggal', $date)->first();
        if ($schedule && !$schedule->tersedia) {
            return false; // Date is blocked
        }

        return true; // Date is available
    }

    /**
     * Helper method to calculate total price.
     */
    private function calculateTotalPrice($packageId, $date)
    {
        $package = Package::findOrFail($packageId);

        // For now, return the base price
        // In a real implementation, you might adjust the price based on date, demand, etc.
        return $package->hargaDasar;
    }
    /**
     * Show payment upload form.
     */
    public function payment($id)
    {
        $booking = Booking::findOrFail($id);
        return view('booking.payment', compact('booking'));
    }

    /**
     * Handle payment proof upload.
     */
    public function uploadPayment(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bank_name' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $booking = Booking::findOrFail($id);

        // Store file
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('payments', $filename, 'public');

            // Create Payment record
            $payment = new \App\Models\Payment();
            $payment->idPembayaran = 'PAY' . strtoupper(substr(md5(uniqid()), 0, 8));
            $payment->idBooking = $booking->idBooking;
            $payment->jumlah = $request->amount;
            $payment->metodePembayaran = $request->bank_name;
            $payment->statusPembayaran = 'pending';
            $payment->tanggalBayar = now();
            $payment->buktiPembayaran = $path;
            $payment->save();

            // Update booking status if needed, or just notify admin
            // $booking->status = 'pending_payment_verification'; // Optional if you have this status
            // $booking->save();

            return redirect()->route('booking.success', $booking->idBooking)->with('success', 'Payment proof uploaded successfully! We will verify it shortly.');
        }

        return redirect()->back()->with('error', 'Failed to upload payment proof.');
    }
}
