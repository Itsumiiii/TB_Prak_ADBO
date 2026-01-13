@extends('layouts.app')

@section('title', $portfolio->judul . ' - Vidiooo Creative Production House')

@section('content')
<!-- Hero Section -->
<section class="py-20 bg-gradient-to-r from-gray-800 to-gray-900">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">{{ $portfolio->judul }}</h1>
            <p class="text-xl text-gray-300">{{ $portfolio->kategori }}</p>
        </div>
    </div>
</section>

<!-- Portfolio Detail -->
<section class="py-20 bg-gray-900">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="rounded-xl overflow-hidden mb-8">
                    <img 
                        src="{{ asset('storage/' . $portfolio->gambarCover) }}" 
                        alt="{{ $portfolio->judul }}" 
                        class="w-full h-auto object-cover"
                    >
                </div>
                
                <div class="prose prose-invert max-w-none">
                    <h2 class="text-2xl font-bold mb-4">Project Description</h2>
                    <p class="text-gray-300 mb-8">{{ $portfolio->deskripsi }}</p>
                    
                    <!-- Additional Images/Videos -->
                    <h3 class="text-xl font-bold mb-4">Additional Media</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @forelse($portfolio->images as $image)
                            <div class="aspect-square bg-gray-800 rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Additional Image" class="w-full h-full object-cover cursor-pointer hover:opacity-75 transition" onclick="window.open(this.src, '_blank')">
                            </div>
                        @empty
                            <div class="col-span-full text-gray-500 text-center py-8">
                                No additional media available
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-gray-800 rounded-xl p-8 sticky top-24">
                    <h3 class="text-xl font-bold mb-6">Project Details</h3>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Category:</span>
                            <span class="font-medium">{{ $portfolio->kategori }}</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-400">Views:</span>
                            <span class="font-medium">{{ $portfolio->jumlahTayangan }}</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-400">Status:</span>
                            <span class="font-medium text-green-500">Completed</span>
                        </div>
                    </div>
                    
                    <div class="mb-8">
                        <h4 class="font-bold mb-3">Share this project</h4>
                        <div class="flex space-x-3">
                            <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-blue-600 transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-blue-400 transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-pink-600 transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                    
                    <a 
                        href="{{ route('booking.create') }}" 
                        class="w-full block bg-blue-600 hover:bg-blue-700 text-white text-center font-semibold py-4 px-6 rounded-lg transition"
                    >
                        Book Similar Service
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Projects -->
<section class="py-20 bg-gray-800">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-12">Related Projects</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Placeholder for related projects -->
            <div class="bg-gray-700 rounded-xl overflow-hidden">
                <div class="h-48 bg-gray-600 flex items-center justify-center">
                    <i class="fas fa-image text-4xl text-gray-500"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-2">Related Project 1</h3>
                    <p class="text-gray-400 text-sm">Category</p>
                </div>
            </div>
            
            <div class="bg-gray-700 rounded-xl overflow-hidden">
                <div class="h-48 bg-gray-600 flex items-center justify-center">
                    <i class="fas fa-image text-4xl text-gray-500"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-2">Related Project 2</h3>
                    <p class="text-gray-400 text-sm">Category</p>
                </div>
            </div>
            
            <div class="bg-gray-700 rounded-xl overflow-hidden">
                <div class="h-48 bg-gray-600 flex items-center justify-center">
                    <i class="fas fa-image text-4xl text-gray-500"></i>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-2">Related Project 3</h3>
                    <p class="text-gray-400 text-sm">Category</p>
                </div>
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