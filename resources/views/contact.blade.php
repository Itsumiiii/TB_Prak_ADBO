@extends('layouts.app')

@section('title', 'Contact Us - Vidiooo Creative Production House')

@section('content')
<!-- Hero Section -->
<section class="py-20 bg-gradient-to-r from-gray-800 to-gray-900">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Get In Touch</h1>
            <p class="text-xl text-gray-300">
                Have a project in mind? Let's discuss how we can bring your vision to life.
            </p>
        </div>
    </div>
</section>

<!-- Contact Content -->
<section class="py-20 bg-gray-900">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <!-- Contact Info -->
            <div>
                <h2 class="text-3xl font-bold mb-8">Contact Information</h2>
                
                <div class="space-y-8">
                    @if(isset($companyInfo))
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mr-6 flex-shrink-0">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">Email</h3>
                                <p class="text-gray-300">{{ $companyInfo->email }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mr-6 flex-shrink-0">
                                <i class="fab fa-whatsapp text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">WhatsApp</h3>
                                <p class="text-gray-300">{{ $companyInfo->nomorWhatsApp }}</p>
                                <a href="{{ route('whatsapp.chat') }}" class="text-blue-400 hover:text-blue-300 mt-2 inline-block">
                                    Chat with us <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mr-6 flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">Address</h3>
                                <p class="text-gray-300">{{ $companyInfo->alamat }}</p>
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Social Media -->
                <div class="mt-12">
                    <h3 class="text-xl font-bold mb-6">Follow Us</h3>
                    <div class="flex space-x-4">
                    @if($companyInfo->instagram)
                        <a href="{{ $companyInfo->instagram }}" target="_blank" class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif
                    @if($companyInfo->facebook)
                        <a href="{{ $companyInfo->facebook }}" target="_blank" class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition">
                            <i class="fab fa-facebook"></i>
                        </a>
                    @endif
                    @if($companyInfo->youtube)
                        <a href="{{ $companyInfo->youtube }}" target="_blank" class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition">
                            <i class="fab fa-youtube"></i>
                        </a>
                    @endif
                    @if($companyInfo->tiktok)
                        <a href="{{ $companyInfo->tiktok }}" target="_blank" class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    @endif
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="bg-gray-800 rounded-xl p-8">
                <h2 class="text-3xl font-bold mb-8">Send Us a Message</h2>
                
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block text-gray-300 mb-2">Name</label>
                        <input 
                            type="text" 
                            name="name"
                            id="name" 
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Your Name"
                            required
                        >
                    </div>
                    
                    <div class="mb-6">
                        <label for="email" class="block text-gray-300 mb-2">Email</label>
                        <input 
                            type="email" 
                            name="email"
                            id="email" 
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="your.email@example.com"
                            required
                        >
                    </div>
                    
                    <div class="mb-6">
                        <label for="subject" class="block text-gray-300 mb-2">Subject</label>
                        <input 
                            type="text" 
                            name="subject"
                            id="subject" 
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="How can we help you?"
                            required
                        >
                    </div>
                    
                    <div class="mb-6">
                        <label for="message" class="block text-gray-300 mb-2">Message</label>
                        <textarea 
                            name="message"
                            id="message" 
                            rows="5" 
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Tell us about your project..."
                            required
                        ></textarea>
                    </div>
                    
                    <button 
                        type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-lg transition"
                    >
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-20 bg-gray-800">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-12">Find Us</h2>
        <div class="bg-gray-700 rounded-xl overflow-hidden h-96">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.123456789012!2d106.81234567890123!3d-6.123456789012345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMDcnMjIuNCJTIDEwNsKwNDgnNDQuNSJF!5e0!3m2!1sen!2sid!4v1234567890123!5m2!1sen!2sid" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy"
            ></iframe>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-blue-900 to-purple-900">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-6">Ready to Start Your Project?</h2>
        <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
            Let's discuss your creative vision and turn it into reality.
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