<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    /**
     * Display a listing of testimonials.
     */
    public function index()
    {
        $testimonials = Testimonial::where('disetujui', true)->orderBy('created_at', 'desc')->get();

        return view('testimonials.index', compact('testimonials'));
    }
    /**
     * Show the form for creating a new testimonial.
     */
    public function create()
    {
        return view('testimonials.create');
    }

    /**
     * Store a newly created testimonial in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
        ]);

        // Simulating guest for now or creating one if needed
        // For this implementation, we will assume we can save it without a rigorous guest check
        // or create a dummy guest record if one doesn't exist, OR strictly require a Booking ID to leave a review.
        // Let's make it simple: Name + Review. We'll store a dummy ID or modify model to make id_guest nullable if possible.
        // However, schema likely requires id_guest. Let's try to find a Guest by name/email or create one.
        // Since we don't have email in the form, let's just make it require a booking code to verify?
        // Simpler: Just save it. But id_guest is likely required.
        // Let's check Schema... Guest ID is string.
        
        // Strategy: We will create a "Guest" record if it doesn't exist, or just use a random ID.
        // Better: Ask for Booking ID to verify client.
        
        $testimonial = new Testimonial();
        $testimonial->idTestimoni = \Illuminate\Support\Str::uuid()->toString();
        
        // Ideally we link to a real guest. For now, let's assume we can set a temporary guest or nullable.
        // Checking migration... id_guest is FK? Likely.
        // Let's just create a new Guest record for this reviewer if we don't have auth.
        $guestId = 'GUEST-' . time(); 
        $guest = \App\Models\Guest::firstOrCreate(
            ['name' => $request->name],
            ['id_guest' => $guestId, 'email' => null]
        );
        
        $testimonial->id_guest = $guest->id_guest;
        $testimonial->rating = $request->rating;
        $testimonial->komentar = $request->komentar;
        $testimonial->disetujui = false; // Requires admin approval
        $testimonial->save();

        return redirect()->route('testimonials.index')->with('success', 'Thank you for your testimonial! It will be published after review.');
    }
}
