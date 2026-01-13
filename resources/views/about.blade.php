@extends('layouts.app')

@section('title', 'About Us - Vidiooo Creative Production House')

@section('content')
<!-- Hero Section -->
<section class="py-20 bg-gradient-to-r from-gray-800 to-gray-900">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">About Vidiooo</h1>
            <p class="text-xl text-gray-300">
                Creating Visual Stories That Captivate and Inspire
            </p>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="py-20 bg-gray-900">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-3xl font-bold mb-6">Our Story</h2>
                <p class="text-gray-300 mb-6">
                    Founded in 2019, Vidiooo began with a simple mission: to transform ideas into compelling visual narratives. 
                    What started as a passion project has evolved into a full-fledged creative production house serving clients 
                    across various industries.
                </p>
                <p class="text-gray-300 mb-6">
                    Our team of talented videographers, editors, and creative professionals bring diverse perspectives and 
                    expertise to every project. We believe that every story deserves to be told in the most captivating way possible.
                </p>
                <p class="text-gray-300">
                    From intimate wedding ceremonies to large corporate events, we approach each project with the same level 
                    of dedication and attention to detail that has made us a trusted partner for countless clients.
                </p>
            </div>
            
            <div class="rounded-xl overflow-hidden shadow-2xl">
                <img 
                    src="https://source.unsplash.com/random/600x400/?cinema,team" 
                    alt="Vidiooo Team" 
                    class="w-full h-auto object-cover"
                >
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-20 bg-gray-800">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-16">Our Core Values</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gray-700 p-8 rounded-xl text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-lightbulb text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-4">Creativity</h3>
                <p class="text-gray-300">
                    We push boundaries to create unique and memorable visual experiences that stand out from the crowd.
                </p>
            </div>
            
            <div class="bg-gray-700 p-8 rounded-xl text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-handshake text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-4">Integrity</h3>
                <p class="text-gray-300">
                    We maintain transparency and honesty in all our client relationships, ensuring trust and reliability.
                </p>
            </div>
            
            <div class="bg-gray-700 p-8 rounded-xl text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-trophy text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-4">Excellence</h3>
                <p class="text-gray-300">
                    We strive for perfection in every frame, delivering high-quality content that exceeds expectations.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-20 bg-gray-900">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-16">Meet Our Team</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-32 h-32 rounded-full overflow-hidden mx-auto mb-4">
                    <img 
                        src="https://source.unsplash.com/random/300x300/?portrait,man" 
                        alt="Team Member" 
                        class="w-full h-full object-cover"
                    >
                </div>
                <h3 class="text-xl font-bold">Alex Johnson</h3>
                <p class="text-blue-400">Creative Director</p>
            </div>
            
            <div class="text-center">
                <div class="w-32 h-32 rounded-full overflow-hidden mx-auto mb-4">
                    <img 
                        src="https://source.unsplash.com/random/300x300/?portrait,woman" 
                        alt="Team Member" 
                        class="w-full h-full object-cover"
                    >
                </div>
                <h3 class="text-xl font-bold">Sarah Williams</h3>
                <p class="text-blue-400">Lead Videographer</p>
            </div>
            
            <div class="text-center">
                <div class="w-32 h-32 rounded-full overflow-hidden mx-auto mb-4">
                    <img 
                        src="https://source.unsplash.com/random/300x300/?portrait,man,beard" 
                        alt="Team Member" 
                        class="w-full h-full object-cover"
                    >
                </div>
                <h3 class="text-xl font-bold">Michael Chen</h3>
                <p class="text-blue-400">Editor</p>
            </div>
            
            <div class="text-center">
                <div class="w-32 h-32 rounded-full overflow-hidden mx-auto mb-4">
                    <img 
                        src="https://source.unsplash.com/random/300x300/?portrait,woman,smile" 
                        alt="Team Member" 
                        class="w-full h-full object-cover"
                    >
                </div>
                <h3 class="text-xl font-bold">Emma Rodriguez</h3>
                <p class="text-blue-400">Producer</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA -->
<section class="py-20 bg-gradient-to-r from-blue-900 to-purple-900">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-6">Ready to Work Together?</h2>
        <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
            Have a project in mind? Let's discuss how we can bring your vision to life.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('contact') }}" class="bg-white text-gray-900 hover:bg-gray-200 font-semibold py-4 px-10 rounded-lg transition">
                Contact Us
            </a>
            <a href="{{ route('whatsapp.chat') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-4 px-10 rounded-lg transition flex items-center">
                <i class="fab fa-whatsapp mr-2"></i> Chat on WhatsApp
            </a>
        </div>
    </div>
</section>
@endsection