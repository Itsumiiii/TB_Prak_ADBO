<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Management - Vidiooo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white min-h-screen flex">
    <!-- Include admin sidebar here -->
    @include('admin.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <header class="mb-8">
            <h1 class="text-3xl font-bold">Booking Management</h1>
            <p class="text-gray-400">Manage customer bookings</p>
        </header>
        
        <!-- Action Bar -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex space-x-4">
                <select class="bg-gray-800 border border-gray-700 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                
                <input type="date" class="bg-gray-800 border border-gray-700 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="relative">
                <input type="text" placeholder="Search bookings..." class="bg-gray-800 border border-gray-700 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        
        <!-- Bookings Table -->
        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
            <table class="min-w-full divide-y divide-gray-700">
                <thead>
                    <tr>

                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Phone</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Package</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Event Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($bookings as $booking)
                        <tr>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm">{{ $booking->guest ? $booking->guest->name : 'Guest' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-mono">{{ $booking->guest ? $booking->guest->no_hp : '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm">{{ $booking->package ? $booking->package->namaPaket : 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm">{{ \Carbon\Carbon::parse($booking->tanggalAcara)->format('M d, Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @switch($booking->status)
                                        @case('confirmed')
                                            {{ 'bg-green-800 text-green-200' }}
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
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm">Rp {{ number_format($booking->totalHarga, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.bookings.show', $booking->idBooking) }}" class="text-blue-400 hover:text-blue-300">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($booking->status === 'pending' && !$booking->payment)
                                        <form action="{{ route('admin.bookings.confirm', $booking->idBooking) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to confirm this booking?')">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="text-green-400 hover:text-green-300">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    @if($booking->status !== 'cancelled')
                                        <form action="{{ route('admin.bookings.cancel', $booking->idBooking) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="text-red-400 hover:text-red-300">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-400">
                                No bookings found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>