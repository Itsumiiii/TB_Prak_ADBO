@extends('layouts.app')

@section('title', $package->namaPaket . ' - Vidiooo Creative Production House')

@section('content')
<!-- Hero Section -->
<section class="py-20 bg-gradient-to-r from-gray-800 to-gray-900">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">{{ $package->namaPaket }}</h1>
            <p class="text-xl text-gray-300">Rp {{ number_format($package->hargaDasar, 0, ',', '.') }}</p>
        </div>
    </div>
</section>

<!-- Package Detail -->
<section class="py-20 bg-gray-900">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="prose prose-invert max-w-none">
                    <h2 class="text-2xl font-bold mb-4">Package Overview</h2>
                    <p class="text-gray-300 mb-8">{{ $package->deskripsi }}</p>
                    
                    <h3 class="text-xl font-bold mb-4">What's Included</h3>
                    <ul class="space-y-3 mb-8">
                        @foreach($package->inklusi as $item)
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                <span class="text-gray-300">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                    
                    <h3 class="text-xl font-bold mb-4">Package Benefits</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-800 p-6 rounded-lg">
                            <h4 class="font-bold mb-2 flex items-center">
                                <i class="fas fa-star text-yellow-400 mr-2"></i> Professional Quality
                            </h4>
                            <p class="text-gray-400 text-sm">Industry-standard equipment and techniques for superior results.</p>
                        </div>
                        
                        <div class="bg-gray-800 p-6 rounded-lg">
                            <h4 class="font-bold mb-2 flex items-center">
                                <i class="fas fa-user-check text-blue-400 mr-2"></i> Expert Team
                            </h4>
                            <p class="text-gray-400 text-sm">Skilled professionals with years of experience in creative production.</p>
                        </div>
                        
                        <div class="bg-gray-800 p-6 rounded-lg">
                            <h4 class="font-bold mb-2 flex items-center">
                                <i class="fas fa-sync-alt text-green-400 mr-2"></i> Revisions Included
                            </h4>
                            <p class="text-gray-400 text-sm">Multiple revision rounds to ensure your satisfaction.</p>
                        </div>
                        
                        <div class="bg-gray-800 p-6 rounded-lg">
                            <h4 class="font-bold mb-2 flex items-center">
                                <i class="fas fa-headset text-purple-400 mr-2"></i> Dedicated Support
                            </h4>
                            <p class="text-gray-400 text-sm">Ongoing support throughout the project lifecycle.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Booking Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-gray-800 rounded-xl p-8 sticky top-24">
                    <h3 class="text-xl font-bold mb-6">Book This Package</h3>
                    
                    <div class="bg-gray-700 rounded-lg p-6 mb-6">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-400">Package:</span>
                            <span class="font-medium">{{ $package->namaPaket }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-400">Price:</span>
                            <span class="font-medium">Rp {{ number_format($package->hargaDasar, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Duration:</span>
                            <span class="font-medium">Flexible</span>
                        </div>
                    </div>
                    
                    <a 
                        href="{{ route('booking.create') }}?package={{ $package->idPaket }}" 
                        class="w-full block bg-blue-600 hover:bg-blue-700 text-white text-center font-semibold py-4 px-6 rounded-lg transition mb-4"
                    >
                        Proceed to Booking
                    </a>
                    
                    <p class="text-gray-400 text-sm text-center">
                        Have questions? <a href="{{ route('whatsapp.chat') }}" class="text-blue-400 hover:text-blue-300">Chat with us</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Packages -->
<section class="py-20 bg-gray-800">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-12">Other Packages</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Placeholder for related packages -->
            <div class="bg-gray-700 rounded-xl p-6">
                <h3 class="text-lg font-bold mb-3">Basic Package</h3>
                <p class="text-gray-400 text-sm mb-4">Essential services for small projects</p>
                <p class="text-xl font-bold text-blue-400 mb-4">Rp 5,000,000</p>
                <a href="#" class="text-blue-400 hover:text-blue-300 text-sm font-medium">View Details</a>
            </div>
            
            <div class="bg-gray-700 rounded-xl p-6">
                <h3 class="text-lg font-bold mb-3">Premium Package</h3>
                <p class="text-gray-400 text-sm mb-4">Comprehensive services for medium projects</p>
                <p class="text-xl font-bold text-blue-400 mb-4">Rp 10,000,000</p>
                <a href="#" class="text-blue-400 hover:text-blue-300 text-sm font-medium">View Details</a>
            </div>
            
            <div class="bg-gray-700 rounded-xl p-6">
                <h3 class="text-lg font-bold mb-3">Enterprise Package</h3>
                <p class="text-gray-400 text-sm mb-4">Complete solution for large projects</p>
                <p class="text-xl font-bold text-blue-400 mb-4">Rp 20,000,000</p>
                <a href="#" class="text-blue-400 hover:text-blue-300 text-sm font-medium">View Details</a>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-blue-900 to-purple-900">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-6">Ready to Start Your Project?</h2>
        <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
            Let's discuss how we can create something amazing for you.
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