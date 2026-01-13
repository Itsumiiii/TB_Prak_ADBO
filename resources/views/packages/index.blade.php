@extends('layouts.app')

@section('title', 'Packages - Vidiooo Creative Production House')

@section('content')
<!-- Hero Section -->
<section class="py-20 bg-gradient-to-r from-gray-800 to-gray-900">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Our Packages</h1>
            <p class="text-xl text-gray-300">
                Choose the perfect package for your creative needs
            </p>
        </div>
    </div>
</section>

<!-- Packages Section -->
<section class="py-20 bg-gray-900">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($packages as $package)
                <div class="package-card bg-gray-800 rounded-xl p-8 border border-gray-700 transform transition duration-300 hover:scale-105">
                    <h3 class="text-2xl font-bold mb-4">{{ $package->namaPaket }}</h3>
                    <p class="text-gray-400 mb-6">{{ $package->deskripsi }}</p>
                    
                    <div class="mb-6">
                        <p class="text-3xl font-bold text-blue-400 mb-4">Rp {{ number_format($package->hargaDasar, 0, ',', '.') }}</p>
                        <ul class="space-y-2">
                            @foreach($package->inklusi as $item)
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <a 
                        href="{{ route('booking.create') }}?package={{ $package->idPaket }}" 
                        class="w-full block bg-blue-600 hover:bg-blue-700 text-white text-center font-semibold py-3 px-4 rounded-lg transition"
                    >
                        Book Now
                    </a>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-400">No packages available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Package Features -->
<section class="py-20 bg-gray-800">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-16">Why Choose Our Packages?</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-camera text-white text-xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Professional Equipment</h3>
                <p class="text-gray-400">We use industry-standard cameras and lighting equipment for superior quality.</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-edit text-white text-xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Expert Editing</h3>
                <p class="text-gray-400">Our skilled editors craft your footage into a compelling visual story.</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-clock text-white text-xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">On-Time Delivery</h3>
                <p class="text-gray-400">We respect your timeline and deliver your project as promised.</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-headset text-white text-xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Dedicated Support</h3>
                <p class="text-gray-400">We provide ongoing support throughout the project lifecycle.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-blue-900 to-purple-900">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-6">Ready to Get Started?</h2>
        <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
            Choose a package that fits your needs and let's create something amazing together.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('booking.create') }}" class="bg-white text-gray-900 hover:bg-gray-200 font-semibold py-4 px-10 rounded-lg transition">
                Browse Packages
            </a>
            <a href="{{ route('whatsapp.chat') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-4 px-10 rounded-lg transition flex items-center">
                <i class="fab fa-whatsapp mr-2"></i> Chat on WhatsApp
            </a>
        </div>
    </div>
</section>
@endsection