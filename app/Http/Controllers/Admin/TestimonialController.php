<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Guest;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::with('guest')->orderBy('created_at', 'desc')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        // Create or find guest
        $guest = Guest::firstOrCreate(
            ['name' => $request->name],
            [
                'id_guest' => 'GUEST-' . Str::upper(Str::random(8)),
                'email' => null
            ]
        );

        $testimonial = new Testimonial();
        $testimonial->idTestimoni = Str::uuid()->toString();
        $testimonial->id_guest = $guest->id_guest;
        $testimonial->rating = $request->rating;
        $testimonial->komentar = $request->komentar;
        
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('testimonials', 'public');
            $testimonial->gambar = $path;
        }

        $testimonial->disetujui = true; // Admin created, so auto-approved
        $testimonial->save();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
