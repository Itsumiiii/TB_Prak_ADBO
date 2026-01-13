@extends('layouts.app')

@section('title', 'Book a Session - Vidiooo Creative Production House')

@section('content')
<!-- Hero Section -->
<section class="py-20 bg-gradient-to-r from-gray-800 to-gray-900">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Book Your Session</h1>
            <p class="text-xl text-gray-300">
                Fill out the form below to reserve your spot
            </p>
        </div>
    </div>
</section>

<!-- Booking Form -->
<section class="py-20 bg-gray-900">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <form method="POST" action="{{ route('booking.store') }}" class="bg-gray-800 rounded-xl p-8">
                @csrf
                
                <!-- Package Selection -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold mb-6">Select Your Package</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($packages as $package)
                            <div class="package-option border-2 border-gray-700 rounded-lg p-6 cursor-pointer hover:border-blue-500 transition" data-package-id="{{ $package->idPaket }}">
                                <div class="flex items-start">
                                    <input 
                                        type="radio" 
                                        name="package_id" 
                                        id="package_{{ $package->idPaket }}" 
                                        value="{{ $package->idPaket }}" 
                                        class="mt-1 mr-4"
                                        required
                                    >
                                    <label for="package_{{ $package->idPaket }}" class="flex-1">
                                        <h3 class="text-lg font-bold">{{ $package->namaPaket }}</h3>
                                        <p class="text-blue-400 font-bold mt-2">Rp {{ number_format($package->hargaDasar, 0, ',', '.') }}</p>
                                        <p class="text-gray-400 text-sm mt-2">{{ Str::limit($package->deskripsi, 100) }}</p>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Guest Info (if not logged in) -->
                @guest
                <div class="mb-8">
                    <h2 class="text-2xl font-bold mb-6">Personal Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label for="name" class="block text-gray-300 mb-2">Full Name</label>
                            <input type="text" name="name" id="name" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="email" class="block text-gray-300 mb-2">Email Address</label>
                            <input type="email" name="email" id="email" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="phone" class="block text-gray-300 mb-2">Phone Number</label>
                            <input type="tel" name="phone" id="phone" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    </div>
                </div>
                @endguest

                <!-- Booking Details -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold mb-6">Booking Details</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="tanggalAcara" class="block text-gray-300 mb-2">Event Date</label>
                            <input 
                                type="date" 
                                name="tanggalAcara" 
                                id="tanggalAcara" 
                                class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required
                            >
                        </div>
                        
                        <div>
                            <label for="waktuAcara" class="block text-gray-300 mb-2">Event Time</label>
                            <input 
                                type="time" 
                                name="waktuAcara" 
                                id="waktuAcara" 
                                class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required
                            >
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="lokasiAcara" class="block text-gray-300 mb-2">Event Location</label>
                            <input 
                                type="text" 
                                name="lokasiAcara" 
                                id="lokasiAcara" 
                                class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter event location"
                                required
                            >
                        </div>
                    </div>
                </div>
                
                <!-- Availability Check -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold mb-6">Check Availability</h2>
                    <button 
                        type="button" 
                        id="check-availability-btn" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition"
                    >
                        Check Availability
                    </button>
                    <div id="availability-result" class="mt-4"></div>
                </div>
                
                <!-- Terms and Conditions -->
                <div class="mb-8">
                    <div class="flex items-start">
                        <input 
                            type="checkbox" 
                            name="terms" 
                            id="terms" 
                            class="mt-1 mr-4" 
                            required
                        >
                        <label for="terms" class="text-gray-300">
                            I agree to the terms and conditions and privacy policy. I understand that this is a preliminary booking and will be confirmed after payment.
                        </label>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div>
                    <button 
                        type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-lg transition"
                    >
                        Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-gray-800">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-12">Booking FAQ</h2>
        <div class="max-w-3xl mx-auto space-y-6">
            <div class="bg-gray-700 rounded-lg p-6">
                <h3 class="text-xl font-bold mb-3">How far in advance should I book?</h3>
                <p class="text-gray-300">We recommend booking at least 2-4 weeks in advance to secure your preferred date. For peak seasons or special events, booking 1-2 months ahead is advisable.</p>
            </div>
            
            <div class="bg-gray-700 rounded-lg p-6">
                <h3 class="text-xl font-bold mb-3">What happens after I book?</h3>
                <p class="text-gray-300">After booking, you'll receive a confirmation email with details about your session. We'll contact you to finalize arrangements and collect any additional information needed for your event.</p>
            </div>
            
            <div class="bg-gray-700 rounded-lg p-6">
                <h3 class="text-xl font-bold mb-3">Can I reschedule my booking?</h3>
                <p class="text-gray-300">Yes, you can reschedule your booking up to 7 days before the event date. Rescheduling is subject to availability and may incur additional fees depending on the circumstances.</p>
            </div>
            
            <div class="bg-gray-700 rounded-lg p-6">
                <h3 class="text-xl font-bold mb-3">What if I need to cancel?</h3>
                <p class="text-gray-300">Cancellations made more than 14 days before the event date are eligible for a full refund minus administrative fees. Cancellations made within 14 days may be subject to partial or no refund depending on our policy.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-blue-900 to-purple-900">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-6">Have Questions?</h2>
        <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
            Our team is ready to assist you with your booking.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('whatsapp.chat') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-4 px-10 rounded-lg transition flex items-center">
                <i class="fab fa-whatsapp mr-2"></i> Chat on WhatsApp
            </a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Package selection highlighting
    const packageOptions = document.querySelectorAll('.package-option');
    packageOptions.forEach(option => {
        option.addEventListener('click', function() {
            packageOptions.forEach(opt => opt.classList.remove('border-blue-500'));
            this.classList.add('border-blue-500');
            
            // Select the radio button inside this option
            const radio = this.querySelector('input[type="radio"]');
            radio.checked = true;
        });
    });
    
    // Availability check
    const checkBtn = document.getElementById('check-availability-btn');
    const availabilityResult = document.getElementById('availability-result');
    
    checkBtn.addEventListener('click', function() {
        const packageInput = document.querySelector('input[name="package_id"]:checked');
        const tanggalAcara = document.getElementById('tanggalAcara').value;
        
        if (!packageInput || !tanggalAcara) {
            availabilityResult.innerHTML = '<p class="text-yellow-500">Please select a package and date first.</p>';
            return;
        }

        const packageId = packageInput.value;
        
        // Simulate API call to check availability
        fetch('{{ route('booking.check-available') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                tanggal: tanggalAcara,
                package_id: packageId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.available) {
                availabilityResult.innerHTML = '<p class="text-green-500">This date is available for your selected package!</p>';
            } else {
                availabilityResult.innerHTML = '<p class="text-red-500">Sorry, this date is not available for your selected package. Please choose another date.</p>';
            }
        })
        .catch(error => {
            availabilityResult.innerHTML = '<p class="text-red-500">Error checking availability. Please try again.</p>';
        });
    });
});
</script>
@endsection