<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details #{{ $payment->idPembayaran }} - Vidiooo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white min-h-screen flex">
    <!-- Include admin sidebar here -->
    @include('admin.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <header class="mb-8">
            <a href="{{ route('admin.payments.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">
                <i class="fas fa-arrow-left mr-2"></i> Back to Payments
            </a>
            <h1 class="text-3xl font-bold">Payment Details</h1>
        </header>

        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Details -->
                <div class="bg-gray-800 rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-6 border-b border-gray-700 pb-2">Transaction Info</h2>
                    
                    <div class="space-y-4">
                        {{-- Booking ID removed --}}
                        <div>
                            <p class="text-gray-400 text-sm">Customer</p>
                            <p class="font-medium">{{ $payment->booking->guest->name ?? 'Guest' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Amount</p>
                            <p class="font-bold text-xl text-green-400">Rp {{ number_format($payment->jumlah, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Payment Method</p>
                            <p class="font-medium">{{ $payment->metodePembayaran }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Date</p>
                            <p class="font-medium">{{ $payment->tanggalBayar ? $payment->tanggalBayar->format('F d, Y H:i') : 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Status</p>
                            <span class="inline-block mt-1 px-3 py-1 rounded-full text-sm font-semibold 
                                @if($payment->statusPembayaran == 'success') bg-green-900 text-green-200
                                @elseif($payment->statusPembayaran == 'pending') bg-yellow-900 text-yellow-200
                                @else bg-red-900 text-red-200 @endif">
                                {{ ucfirst($payment->statusPembayaran) }}
                            </span>
                        </div>
                    </div>

                    @if($payment->statusPembayaran === 'pending')
                        <div class="mt-8 pt-6 border-t border-gray-700">
                            <form action="{{ route('admin.payments.verify', $payment->idPembayaran) }}" method="POST" onsubmit="return confirm('Are you sure you want to verify this payment?')">
                                @csrf
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition">
                                    <i class="fas fa-check-circle mr-2"></i> Verify Payment
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <!-- Proof Image -->
                <div class="bg-gray-800 rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-6 border-b border-gray-700 pb-2">Payment Proof</h2>
                    
                    @if($payment->buktiPembayaran)
                        <div class="rounded-lg overflow-hidden border border-gray-700">
                            <img src="{{ asset('storage/' . $payment->buktiPembayaran) }}" alt="Payment Proof" class="w-full h-auto">
                        </div>
                        <div class="mt-4 text-center">
                            <a href="{{ asset('storage/' . $payment->buktiPembayaran) }}" target="_blank" class="text-blue-400 hover:text-blue-300 text-sm">
                                <i class="fas fa-external-link-alt mr-1"></i> View Full Size
                            </a>
                        </div>
                    @else
                        <div class="bg-gray-700/30 rounded-lg p-8 text-center border-2 border-dashed border-gray-600">
                            <i class="fas fa-image text-gray-500 text-4xl mb-3"></i>
                            <p class="text-gray-400">No proof uploaded</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</body>
</html>