<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Package;

class BookingController extends Controller
{
    /**
     * Display a listing of bookings.
     */
    public function index()
    {
        $bookings = Booking::with(['guest', 'package', 'payment'])->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Display the specified booking.
     */
    public function show($id)
    {
        $booking = Booking::with(['guest', 'package', 'payment'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Confirm the specified booking.
     */
    public function confirm($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'confirmed';
        $booking->save();

        return redirect()->back()->with('success', 'Booking confirmed successfully!');
    }

    /**
     * Complete the specified booking.
     */
    public function complete($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'completed';
        $booking->save();

        return redirect()->back()->with('success', 'Booking completed successfully!');
    }

    /**
     * Cancel the specified booking.
     */
    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'cancelled';
        $booking->save();

        return redirect()->back()->with('success', 'Booking cancelled successfully!');
    }

    /**
     * Show the calendar view for bookings.
     */
    public function calendar()
    {
        $bookings = Booking::where('status', 'confirmed')->get();
        return view('admin.bookings.calendar', compact('bookings'));
    }
}
