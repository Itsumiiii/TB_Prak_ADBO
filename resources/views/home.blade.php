@extends('layouts.app')

@section('title', 'Home - Vidiooo Creative Production House')

@section('content')
<!-- Hero Section -->
<section class="hero-section h-screen flex items-center relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-black to-transparent z-10"></div>
    <div class="absolute inset-0 bg-[url('https://source.unsplash.com/random/1920x1080/?cinema,film')] bg-cover bg-center opacity-30"></div>
    
    <div class="container mx-auto px-6 relative z-20">
        <div class="max-w-2xl">
            <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-4">
                Creative Excellence Awaits
            </h1>
            <p class="text-xl text-gray-300 mb-8">
                Transform Your Brand Vision Into Stunning Visual Stories
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('packages.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                    Explore Our Packages
                </a>
                <a href="{{ route('portfolio.index') }}" class="bg-transparent border-2 border-white hover:bg-white hover:text-gray-900 text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                    View Our Work
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Portfolio -->
<section class="py-20 bg-gray-900">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-center mb-16">Our Latest Work</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($featuredPortfolios as $portfolio)
                <div class="portfolio-card group overflow-hidden rounded-xl bg-gray-800 transform transition duration-500 hover:-translate-y-2">
                    <div class="relative">
                        <img 
                            src="{{ asset('storage/' . $portfolio->gambarCover) }}" 
                            alt="{{ $portfolio->judul }}" 
                            class="w-full h-64 object-cover transition duration-500 group-hover:scale-110"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <h3 class="text-xl font-bold">{{ $portfolio->judul }}</h3>
                            <span class="inline-block bg-blue-600 text-xs px-2 py-1 rounded mt-2">{{ $portfolio->kategori }}</span>
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
                    <p class="text-gray-400">No featured portfolios available at the moment.</p>
                </div>
            @endforelse
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('portfolio.index') }}" class="inline-block bg-gray-800 hover:bg-gray-700 text-white font-semibold py-3 px-8 rounded-lg transition">
                View All Projects
            </a>
        </div>
    </div>
</section>

<!-- Packages Preview -->
<section class="py-20 bg-gradient-to-br from-gray-800 to-gray-900">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-center mb-16">Our Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($packages as $package)
                <div class="package-card bg-gray-800 rounded-xl p-8 border border-gray-700 transform transition duration-300 hover:scale-105">
                    <h3 class="text-2xl font-bold mb-4">{{ $package->namaPaket }}</h3>
                    <p class="text-gray-400 mb-6">{{ Str::limit($package->deskripsi, 120) }}</p>
                    
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

<!-- Testimonials Slider -->
<section class="py-20 bg-gray-900">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-center mb-16">What Our Clients Say</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($testimonials as $testimonial)
                <div class="testimonial-item bg-gray-800 p-6 rounded-xl">
                    <div class="flex mb-4">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $testimonial->rating)
                                <i class="fas fa-star text-yellow-400"></i>
                            @else
                                <i class="far fa-star text-gray-600"></i>
                            @endif
                        @endfor
                    </div>
                    
                    @if($testimonial->gambar)
                        <div class="mb-4 rounded-lg overflow-hidden border border-gray-700">
                            <img src="{{ asset('storage/' . $testimonial->gambar) }}" alt="Proof" class="w-full h-auto object-cover max-h-48 mx-auto">
                        </div>
                    @endif

                    <p class="text-gray-300 italic mb-4">"{{ $testimonial->komentar }}"</p>
                    <p class="text-blue-400 font-medium">- {{ $testimonial->guest->name ?? 'Client' }}</p>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-400">No testimonials available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Stats Counter -->
<section class="py-20 bg-gradient-to-r from-blue-900 to-purple-900">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <h3 class="text-5xl font-bold text-white mb-2">{{ $stats['totalProjects'] }}</h3>
                <p class="text-gray-300">Projects Completed</p>
            </div>
            <div>
                <h3 class="text-5xl font-bold text-white mb-2">{{ $stats['happyClients'] }}</h3>
                <p class="text-gray-300">Happy Clients</p>
            </div>
            <div>
                <h3 class="text-5xl font-bold text-white mb-2">{{ $stats['yearsExperience'] }}</h3>
                <p class="text-gray-300">Years Experience</p>
            </div>
            <div>
                <h3 class="text-5xl font-bold text-white mb-2">{{ $stats['awards'] }}</h3>
                <p class="text-gray-300">Awards Won</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gray-800">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-6">Ready to Bring Your Vision to Life?</h2>
        <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
            Let's discuss your project and create something amazing together.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('booking.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-10 rounded-lg transition">
                Book a Session
            </a>
            <a href="{{ route('whatsapp.chat') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-4 px-10 rounded-lg transition flex items-center">
                <i class="fab fa-whatsapp mr-2"></i> Chat on WhatsApp
            </a>
        </div>
    </div>
</section>
@endsection