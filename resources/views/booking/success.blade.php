@extends('layouts.app')

@section('title', 'Booking Successful - Vidiooo Creative Production House')

@section('content')
<!-- Hero Section -->
<section class="py-20 bg-gradient-to-r from-gray-800 to-gray-900">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center">
            <i class="fas fa-check-circle text-green-500 text-6xl mb-6"></i>
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Booking Confirmed!</h1>
            <p class="text-xl text-gray-300">
                Thank you for your booking. We'll contact you shortly to confirm details.
            </p>
        </div>
    </div>
</section>

<!-- Booking Details -->
<section class="py-20 bg-gray-900">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto">
            <div class="bg-gray-800 rounded-xl p-8">
                <h2 class="text-2xl font-bold mb-6">Booking Details</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <p class="text-gray-400">Booking ID</p>
                        <p class="font-bold text-lg">#{{ $booking->idBooking }}</p>
                    </div>
                    
                    <div>
                        <p class="text-gray-400">Status</p>
                        <p class="font-bold text-lg text-yellow-500 capitalize">{{ $booking->status }}</p>
                    </div>
                    
                    <div>
                        <p class="text-gray-400">Package</p>
                        <p class="font-bold">{{ $booking->package->namaPaket ?? 'N/A' }}</p>
                    </div>
                    
                    <div>
                        <p class="text-gray-400">Total Amount</p>
                        <p class="font-bold text-blue-400">Rp {{ number_format($booking->totalHarga, 0, ',', '.') }}</p>
                    </div>
                    
                    <div>
                        <p class="text-gray-400">Event Date</p>
                        <p class="font-bold">{{ \Carbon\Carbon::parse($booking->tanggalAcara)->format('F j, Y') }}</p>
                    </div>
                    
                    <div>
                        <p class="text-gray-400">Event Time</p>
                        <p class="font-bold">{{ \Carbon\Carbon::parse($booking->waktuAcara)->format('g:i A') }}</p>
                    </div>
                    
                    <div class="md:col-span-2">
                        <p class="text-gray-400">Event Location</p>
                        <p class="font-bold">{{ $booking->lokasiAcara }}</p>
                    </div>
                </div>
                
                <div class="bg-blue-900/30 border border-blue-700 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-bold mb-3 flex items-center">
                        <i class="fas fa-info-circle text-blue-400 mr-2"></i> Next Steps
                    </h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span>You will receive a confirmation email with booking details</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span>Our team will contact you within 24 hours to confirm your booking</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span>Prepare for your event and have all necessary details ready</span>
                        </li>
                    </ul>
                </div>
                
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('home') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-3 px-8 rounded-lg transition">
                        Back to Home
                    </a>
                    <a href="{{ route('whatsapp.chat') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg transition flex items-center">
                        <i class="fab fa-whatsapp mr-2"></i> Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Payment Instructions -->
<section class="py-20 bg-gray-800">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold mb-6">Payment Instructions</h2>
            
            <div class="bg-gray-700 rounded-lg p-6">
                <p class="mb-4">To complete your booking, please make payment using one of the following methods:</p>
                
                <div class="space-y-4">
                    <div class="border-b border-gray-600 pb-4">
                        <h3 class="font-bold text-lg mb-2">Bank Transfer</h3>
                        <p class="text-gray-300 mb-2">Account Number: 1234567890</p>
                        <p class="text-gray-300">Bank: Bank Central Asia (BCA)</p>
                    </div>
                    
                    <div class="border-b border-gray-600 pb-4">
                        <h3 class="font-bold text-lg mb-2">Digital Wallet</h3>
                        <p class="text-gray-300 mb-2">OVO: 081234567890</p>
                        <p class="text-gray-300">DANA: 081234567890</p>
                    </div>
                    
                    <div>
                        <h3 class="font-bold text-lg mb-2">Payment Deadline</h3>
                        <p class="text-gray-300">Please complete your payment within 48 hours of booking to secure your slot.</p>
                    </div>
                </div>
                
                <div class="mt-6">
                    <a href="{{ route('booking.payment', $booking->idBooking) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                        Upload Payment Proof
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-blue-900 to-purple-900">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-6">Questions About Your Booking?</h2>
        <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
            Our support team is here to assist you with any concerns.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('whatsapp.chat') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-4 px-10 rounded-lg transition flex items-center">
                <i class="fab fa-whatsapp mr-2"></i> Chat on WhatsApp
            </a>
        </div>
    </div>
</section>
@endsection