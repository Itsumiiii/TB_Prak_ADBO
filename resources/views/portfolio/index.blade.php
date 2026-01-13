@extends('layouts.app')

@section('title', 'Portfolio - Vidiooo Creative Production House')

@section('content')
<!-- Hero Section -->
<section class="py-20 bg-gradient-to-r from-gray-800 to-gray-900">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Our Portfolio</h1>
            <p class="text-xl text-gray-300">
                Explore our collection of creative projects and visual stories
            </p>
        </div>
    </div>
</section>

<!-- Portfolio Gallery -->
<section class="py-20 bg-gray-900">
    <div class="container mx-auto px-6">
        <!-- Categories Filter -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <a href="{{ route('portfolio.index') }}" class="px-4 py-2 rounded-full bg-gray-800 hover:bg-blue-600 transition">All</a>
            @foreach($categories as $category)
                <a href="{{ route('portfolio.category', $category) }}" class="px-4 py-2 rounded-full bg-gray-800 hover:bg-blue-600 transition">{{ $category }}</a>
            @endforeach
        </div>
        
        <!-- Portfolio Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($portfolios as $portfolio)
                <div class="portfolio-item group overflow-hidden rounded-xl bg-gray-800 transform transition duration-500 hover:-translate-y-2">
                    <div class="relative">
                        <img 
                            src="{{ asset('storage/' . $portfolio->gambarCover) }}" 
                            alt="{{ $portfolio->judul }}" 
                            class="w-full h-64 object-cover transition duration-500 group-hover:scale-110"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <h3 class="text-xl font-bold">{{ $portfolio->judul }}</h3>
                            <div class="flex justify-between items-center mt-2">
                                <span class="inline-block bg-blue-600 text-xs px-2 py-1 rounded">{{ $portfolio->kategori }}</span>
                                <span class="text-xs text-gray-300">{{ $portfolio->jumlahTayangan }} views</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-400 text-sm mb-4">{{ Str::limit($portfolio->deskripsi, 100) }}</p>
                        <a 
                            href="{{ route('portfolio.show', $portfolio->idPortofolio) }}" 
                            class="text-blue-400 hover:text-blue-300 text-sm font-medium inline-flex items-center"
                        >
                            View Details <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-400">No portfolios available in this category.</p>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="mt-12">
            {{ $portfolios->links() }}
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-blue-900 to-purple-900">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-6">Interested in Our Work?</h2>
        <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
            Let's discuss how we can create something amazing for your project.
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