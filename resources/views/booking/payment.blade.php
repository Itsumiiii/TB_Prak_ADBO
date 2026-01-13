@extends('layouts.app')

@section('title', 'Upload Payment Proof - Vidiooo Creative Production House')

@section('content')
<section class="py-20 bg-gray-900 min-h-screen">
    <div class="container mx-auto px-6">
        <div class="max-w-md mx-auto bg-gray-800 rounded-xl p-8 shadow-lg">
            <div class="text-center mb-8">
                <i class="fas fa-receipt text-blue-500 text-5xl mb-4"></i>
                <h1 class="text-2xl font-bold">Upload Payment Proof</h1>
                <p class="text-gray-400 mt-2">Booking ID: #{{ $booking->idBooking }}</p>
                <p class="text-xl font-bold text-white mt-2">Total: Rp {{ number_format($booking->totalHarga, 0, ',', '.') }}</p>
            </div>

            @if(session('error'))
                <div class="bg-red-500/10 border border-red-500 text-red-500 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('booking.payment.upload', $booking->idBooking) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-gray-300 mb-2">Payment Method</label>
                    <select name="bank_name" id="paymentMethod" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Select Payment Method</option>
                        <option value="BCA Transfer">BCA Transfer</option>
                        <option value="Mandiri Transfer">Mandiri Transfer</option>
                        <option value="OVO">OVO</option>
                        <option value="DANA">DANA</option>
                    </select>
                </div>

                <div id="paymentInfo" class="hidden mb-6 bg-gray-700/50 p-4 rounded-lg border border-gray-600">
                    <p class="text-sm text-gray-400 mb-1">Transfer Destination:</p>
                    <p id="accountName" class="font-bold text-white"></p>
                    <p id="accountNumber" class="font-mono text-xl text-blue-400 my-1"></p>
                    <p id="accountHolder" class="text-sm text-gray-300"></p>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-300 mb-2">Amount Transferred</label>
                    <input type="number" name="amount" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required value="{{ $booking->totalHarga }}">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-300 mb-2">Proof of Payment (Image)</label>
                    <input type="file" name="payment_proof" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" required>
                    <p class="text-xs text-gray-500 mt-2">Supported formats: JPG, PNG, GIF. Max size: 2MB</p>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                    Submit Payment
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('booking.success', $booking->idBooking) }}" class="text-gray-400 hover:text-white">Cancel</a>
            </div>
        </div>
    </div>
</section>
@push('scripts')
<script>
    const paymentMethods = {
        'BCA Transfer': {
            name: 'Bank Central Asia (BCA)',
            number: '1234567890',
            holder: 'PT Vidiooo Creative'
        },
        'Mandiri Transfer': {
            name: 'Bank Mandiri',
            number: '0987654321000',
            holder: 'PT Vidiooo Creative'
        },
        'OVO': {
            name: 'OVO',
            number: '081234567890',
            holder: 'Vidiooo Admin'
        },
        'DANA': {
            name: 'DANA',
            number: '081234567890',
            holder: 'Vidiooo Admin'
        }
    };

    document.getElementById('paymentMethod').addEventListener('change', function() {
        const method = this.value;
        const infoDiv = document.getElementById('paymentInfo');
        
        if (method && paymentMethods[method]) {
            infoDiv.classList.remove('hidden');
            document.getElementById('accountName').textContent = paymentMethods[method].name;
            document.getElementById('accountNumber').textContent = paymentMethods[method].number;
            document.getElementById('accountHolder').textContent = 'a.n. ' + paymentMethods[method].holder;
        } else {
            infoDiv.classList.add('hidden');
        }
    });
</script>
@endpush
@endsection
