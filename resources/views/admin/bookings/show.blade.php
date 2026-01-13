<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking #{{ $booking->idBooking }} - Vidiooo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white min-h-screen flex">
    <!-- Include admin sidebar here -->
    @include('admin.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <header class="mb-8">
            <h1 class="text-3xl font-bold">Booking Details</h1>
            <p class="text-gray-400">Manage booking details</p>
        </header>
        
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <div class="bg-gray-800 rounded-lg p-6 mb-8">
                        <h2 class="text-2xl font-bold mb-6">Booking Information</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-bold mb-3">Customer Details</h3>
                                <div class="space-y-2">
                                    <p><span class="text-gray-400">Name:</span> {{ $booking->guest ? $booking->guest->name : 'Guest' }}</p>
                                    <p><span class="text-gray-400">Email:</span> {{ $booking->guest ? $booking->guest->email : 'N/A' }}</p>
                                    <p><span class="text-gray-400">Phone:</span> {{ $booking->guest ? $booking->guest->no_hp : 'N/A' }}</p>
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="text-lg font-bold mb-3">Package Details</h3>
                                <div class="space-y-2">
                                    <p><span class="text-gray-400">Package:</span> {{ $booking->package ? $booking->package->namaPaket : 'N/A' }}</p>
                                    <p><span class="text-gray-400">Price:</span> Rp {{ number_format($booking->package ? $booking->package->hargaDasar : 0, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="text-lg font-bold mb-3">Event Details</h3>
                                <div class="space-y-2">
                                    <p><span class="text-gray-400">Date:</span> {{ \Carbon\Carbon::parse($booking->tanggalAcara)->format('F j, Y') }}</p>
                                    <p><span class="text-gray-400">Time:</span> {{ \Carbon\Carbon::parse($booking->waktuAcara)->format('g:i A') }}</p>
                                    <p><span class="text-gray-400">Location:</span> {{ $booking->lokasiAcara }}</p>
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="text-lg font-bold mb-3">Booking Details</h3>
                                <div class="space-y-2">
                                    <p><span class="text-gray-400">Status:</span> 
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @switch($booking->status)
                                                @case('confirmed')
                                                    {{ 'bg-green-800 text-green-200' }}
                                                    @break
                                                @case('completed')
                                                    {{ 'bg-blue-800 text-blue-200' }}
                                                    @break
                                                @case('pending')
                                                    {{ 'bg-yellow-800 text-yellow-200' }}
                                                    @break
                                                @case('cancelled')
                                                    {{ 'bg-red-800 text-red-200' }}
                                                    @break
                                                @default
                                                    {{ 'bg-gray-800 text-gray-200' }}
                                            @endswitch">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </p>
                                    <p><span class="text-gray-400">Total Amount:</span> Rp {{ number_format($booking->totalHarga, 0, ',', '.') }}</p>
                                    <p><span class="text-gray-400">Created:</span> {{ $booking->created_at->format('M d, Y g:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payment Information -->
                    <div class="bg-gray-800 rounded-lg p-6 mb-8">
                        <h2 class="text-2xl font-bold mb-6">Payment Information</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-bold mb-3">Payment Status</h3>
                                <div class="space-y-2">
                                    <p><span class="text-gray-400">Status:</span> 
                                        @if($booking->payment)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @switch($booking->payment->statusPembayaran)
                                                    @case('success')
                                                        {{ 'bg-green-800 text-green-200' }}
                                                        @break
                                                    @case('pending')
                                                        {{ 'bg-yellow-800 text-yellow-200' }}
                                                        @break
                                                    @case('failed')
                                                        {{ 'bg-red-800 text-red-200' }}
                                                        @break
                                                    @default
                                                        {{ 'bg-gray-800 text-gray-200' }}
                                                @endswitch">
                                                {{ ucfirst($booking->payment->statusPembayaran) }}
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-800 text-gray-200">
                                                No Payment Record
                                            </span>
                                        @endif
                                    </p>
                                    
                                    @if($booking->payment)
                                        <p><span class="text-gray-400">Amount:</span> Rp {{ number_format($booking->payment->jumlah, 0, ',', '.') }}</p>
                                        <p><span class="text-gray-400">Method:</span> {{ $booking->payment->metodePembayaran }}</p>
                                        <p><span class="text-gray-400">Date:</span> {{ $booking->payment->tanggalBayar ? $booking->payment->tanggalBayar->format('M d, Y g:i A') : 'N/A' }}</p>
                                    @endif
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="text-lg font-bold mb-3">Actions</h3>
                                <div class="space-y-3">
                                    @if($booking->status === 'pending' && !$booking->payment)
                                        <form action="{{ route('admin.bookings.confirm', $booking->idBooking) }}" method="POST" class="w-full" onsubmit="return confirm('Are you sure you want to confirm this booking?')">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="w-full block bg-green-600 hover:bg-green-700 text-white text-center font-semibold py-3 px-4 rounded-lg transition">
                                                <i class="fas fa-check mr-2"></i> Confirm Booking
                                            </button>
                                        </form>
                                    @endif

                                    @if($booking->status === 'confirmed')
                                        <form action="{{ route('admin.bookings.complete', $booking->idBooking) }}" method="POST" class="w-full" onsubmit="return confirm('Are you sure you want to clean this booking as completed?')">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="w-full block bg-blue-600 hover:bg-blue-700 text-white text-center font-semibold py-3 px-4 rounded-lg transition">
                                                <i class="fas fa-check-double mr-2"></i> Complete Booking
                                            </button>
                                        </form>
                                    @endif
                                    
                                    @if($booking->status !== 'cancelled')
                                        <form action="{{ route('admin.bookings.cancel', $booking->idBooking) }}" method="POST" class="w-full" onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="w-full block bg-red-600 hover:bg-red-700 text-white text-center font-semibold py-3 px-4 rounded-lg transition">
                                                <i class="fas fa-times mr-2"></i> Cancel Booking
                                            </button>
                                        </form>
                                    @endif
                                    
                                    @if($booking->payment && $booking->payment->statusPembayaran !== 'success')
                                        <form action="{{ route('admin.payments.verify', $booking->payment->idPembayaran) }}" method="POST" class="w-full" onsubmit="return confirm('Are you sure you want to verify this payment?')">
                                            @csrf
                                            <button type="submit" class="w-full block bg-blue-600 hover:bg-blue-700 text-white text-center font-semibold py-3 px-4 rounded-lg transition">
                                                <i class="fas fa-check-circle mr-2"></i> Verify Payment
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <a 
                                        href="{{ route('whatsapp.chat') }}" 
                                        class="w-full block bg-green-500 hover:bg-green-600 text-white text-center font-semibold py-3 px-4 rounded-lg transition flex items-center justify-center"
                                    >
                                        <i class="fab fa-whatsapp mr-2"></i> Contact Customer
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-800 rounded-lg p-6 mb-6">
                        <h3 class="text-xl font-bold mb-4">Booking Timeline</h3>
                        
                        <div class="space-y-4">
                            <div class="flex">
                                <div class="flex flex-col items-center mr-4">
                                    <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center">
                                        <i class="fas fa-calendar-check text-white text-sm"></i>
                                    </div>
                                    <div class="w-1 h-full bg-gray-600"></div>
                                </div>
                                <div class="pb-4">
                                    <p class="font-medium">Booking Created</p>
                                    <p class="text-sm text-gray-400">{{ $booking->created_at->format('M d, Y g:i A') }}</p>
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="flex flex-col items-center mr-4">
                                    <div class="w-8 h-8 rounded-full bg-yellow-600 flex items-center justify-center">
                                        <i class="fas fa-clock text-white text-sm"></i>
                                    </div>
                                    <div class="w-1 h-full bg-gray-600"></div>
                                </div>
                                <div class="pb-4">
                                    <p class="font-medium">Pending Confirmation</p>
                                    <p class="text-sm text-gray-400">Waiting for payment</p>
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="flex flex-col items-center mr-4">
                                    <div class="w-8 h-8 rounded-full bg-green-600 flex items-center justify-center">
                                        <i class="fas fa-check text-white text-sm"></i>
                                    </div>
                                    <div class="w-1 h-full bg-gray-600"></div>
                                </div>
                                <div class="pb-4">
                                    <p class="font-medium">Confirmed</p>
                                    <p class="text-sm text-gray-400">Booking confirmed</p>
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="flex flex-col items-center mr-4">
                                    <div class="w-8 h-8 rounded-full bg-purple-600 flex items-center justify-center">
                                        <i class="fas fa-calendar-day text-white text-sm"></i>
                                    </div>
                                </div>
                                <div class="pb-4">
                                    <p class="font-medium">Event Date</p>
                                    <p class="text-sm text-gray-400">{{ \Carbon\Carbon::parse($booking->tanggalAcara)->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-800 rounded-lg p-6">
                        <h3 class="text-xl font-bold mb-4">Customer Notes</h3>
                        <div class="bg-gray-700 rounded p-4">
                            <p class="text-gray-300">No special requests or notes from customer.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>