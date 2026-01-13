@extends('layouts.app')

@section('title', 'Submit Testimonial - Vidiooo Creative Production House')

@section('content')
<section class="py-20 bg-gray-900 min-h-screen">
    <div class="container mx-auto px-6">
        <div class="max-w-md mx-auto bg-gray-800 rounded-xl p-8 shadow-lg">
            <h1 class="text-3xl font-bold text-center mb-8">Share Your Experience</h1>
            
            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500 text-green-500 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('testimonials.store') }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-gray-300 mb-2">Your Name</label>
                    <input type="text" name="name" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="John Doe">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-300 mb-2">Rating</label>
                    <div class="flex space-x-4">
                        @for($i = 1; $i <= 5; $i++)
                            <label class="cursor-pointer">
                                <input type="radio" name="rating" value="{{ $i }}" class="hidden peer" required>
                                <i class="fas fa-star text-2xl text-gray-600 peer-checked:text-yellow-400 hover:text-yellow-300 transition"></i>
                            </label>
                        @endfor
                    </div>
                    <p class="text-sm text-gray-500 mt-2">Click star to rate</p>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-300 mb-2">Your Review</label>
                    <textarea name="komentar" rows="4" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="Tell us about your experience..."></textarea>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                    Submit Review
                </button>
            </form>
            
             <div class="mt-6 text-center">
                <a href="{{ route('testimonials.index') }}" class="text-gray-400 hover:text-white">Back to Testimonials</a>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
    // Simple script to handle star rating visual feedback if needed, 
    // though CSS peer-checked works for basic state. 
    // We can add hover effects here if CSS isn't enough.
    const stars = document.querySelectorAll('input[name="rating"]');
    const icons = document.querySelectorAll('.fa-star');

    stars.forEach((star, index) => {
        star.addEventListener('change', () => {
            icons.forEach((icon, i) => {
                if (i <= index) {
                    icon.classList.remove('text-gray-600');
                    icon.classList.add('text-yellow-400');
                } else {
                    icon.classList.add('text-gray-600');
                    icon.classList.remove('text-yellow-400');
                }
            });
        });
    });
</script>
@endpush
