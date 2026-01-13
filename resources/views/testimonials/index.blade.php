@extends('layouts.app')

@section('title', 'Testimonials - Vidiooo Creative Production House')

@section('content')
<!-- Hero Section -->
<section class="py-20 bg-gradient-to-r from-gray-800 to-gray-900">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">What Our Clients Say</h1>
            <p class="text-xl text-gray-300 mb-8">
                Read testimonials from our satisfied clients
            </p>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-20 bg-gray-900">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($testimonials as $testimonial)
                <div class="testimonial-card bg-gray-800 rounded-xl p-8 border border-gray-700">
                    <div class="flex mb-4">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $testimonial->rating)
                                <i class="fas fa-star text-yellow-400"></i>
                            @else
                                <i class="far fa-star text-gray-600"></i>
                            @endif
                        @endfor
                    </div>
                    <p class="text-gray-300 italic mb-6">"{{ $testimonial->komentar }}"</p>
                    
                    @if($testimonial->gambar)
                        <div class="mb-6 rounded-lg overflow-hidden border border-gray-700">
                            <!-- Debug info: {{ asset('storage/' . $testimonial->gambar) }} -->
                            <img src="{{ asset('storage/' . $testimonial->gambar) }}" alt="Proof" class="w-full h-auto object-cover max-h-60 mx-auto">
                        </div>
                    @endif

                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-700 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <div>
                            <p class="font-bold">{{ $testimonial->guest->name ?? 'Client' }}</p>
                            <p class="text-gray-400 text-sm">{{ $testimonial->created_at->format('F j, Y') }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-400">No testimonials available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-blue-900 to-purple-900">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-6">Ready to Work With Us?</h2>
        <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
            Join our satisfied clients and create something amazing together.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('booking.create') }}" class="bg-white text-gray-900 hover:bg-gray-200 font-semibold py-4 px-10 rounded-lg transition">
                Book a Session
            </a>
            <a href="{{ route('whatsapp.chat') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-4 px-10 rounded-lg transition flex items-center">
                <i class="fab fa-whatsapp mr-2"></i> Chat on WhatsApp
            </a>
        </div>
    </div>
</section>
@endsection