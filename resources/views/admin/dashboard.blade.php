<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Vidiooo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 min-h-screen p-4">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-center py-4">Vidiooo Admin</h1>
        </div>
        
        <nav>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 p-2 bg-blue-600 rounded">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.portfolio.index') }}" class="flex items-center space-x-2 p-2 hover:bg-gray-700 rounded">
                        <i class="fas fa-images"></i>
                        <span>Portfolio</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.packages.index') }}" class="flex items-center space-x-2 p-2 hover:bg-gray-700 rounded">
                        <i class="fas fa-box"></i>
                        <span>Packages</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.bookings.index') }}" class="flex items-center space-x-2 p-2 hover:bg-gray-700 rounded">
                        <i class="fas fa-calendar-check"></i>
                        <span>Bookings</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.payments.index') }}" class="flex items-center space-x-2 p-2 hover:bg-gray-700 rounded">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>Payments</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.testimonials.index') }}" class="flex items-center space-x-2 p-2 hover:bg-gray-700 rounded">
                        <i class="fas fa-comments"></i>
                        <span>Testimonials</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.analytics.index') }}" class="flex items-center space-x-2 p-2 hover:bg-gray-700 rounded">
                        <i class="fas fa-chart-line"></i>
                        <span>Analytics</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.settings.index') }}" class="flex items-center space-x-2 p-2 hover:bg-gray-700 rounded">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <div class="absolute bottom-4 left-4">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="flex items-center space-x-2 text-red-400 hover:text-red-300">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>
    
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <header class="mb-8">
            <h1 class="text-3xl font-bold">Dashboard</h1>
            <p class="text-gray-400">Welcome back, Admin!</p>
        </header>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gray-800 rounded-lg p-6 shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-500/20 mr-4">
                        <i class="fas fa-images text-blue-400 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-400">Total Portfolios</p>
                        <p class="text-2xl font-bold">{{ $totalPortfolios }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-800 rounded-lg p-6 shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-500/20 mr-4">
                        <i class="fas fa-box text-green-400 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-400">Total Packages</p>
                        <p class="text-2xl font-bold">{{ $totalPackages }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-800 rounded-lg p-6 shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-500/20 mr-4">
                        <i class="fas fa-calendar-check text-yellow-400 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-400">Pending Bookings</p>
                        <p class="text-2xl font-bold">{{ $pendingBookings }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-800 rounded-lg p-6 shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-500/20 mr-4">
                        <i class="fas fa-comments text-purple-400 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-400">Pending Reviews</p>
                        <p class="text-2xl font-bold">{{ $pendingTestimonials }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Bookings -->
            <div class="bg-gray-800 rounded-lg p-6 shadow-lg">
                <h2 class="text-xl font-bold mb-4">Recent Bookings</h2>
                <div class="space-y-4">
                    @forelse($recentBookings as $booking)
                        <div class="border-b border-gray-700 pb-3 last:border-0 last:pb-0">
                            <div class="flex justify-between">
                                <span class="font-medium">#{{ $booking->idBooking }}</span>
                                <span class="text-sm text-gray-400">{{ $booking->created_at->format('M d, Y') }}</span>
                            </div>
                            <p class="text-gray-400 text-sm">Status: <span class="capitalize">{{ $booking->status }}</span></p>
                            <p class="text-gray-400 text-sm">Total: Rp {{ number_format($booking->totalHarga, 0, ',', '.') }}</p>
                        </div>
                    @empty
                        <p class="text-gray-400">No recent bookings</p>
                    @endforelse
                </div>
            </div>
            
            <!-- Recent Payments -->
            <div class="bg-gray-800 rounded-lg p-6 shadow-lg">
                <h2 class="text-xl font-bold mb-4">Recent Payments</h2>
                <div class="space-y-4">
                    @if(!empty($recentPayments))
                        @foreach($recentPayments as $payment)
                            <div class="border-b border-gray-700 pb-3 last:border-0 last:pb-0">
                                <div class="flex justify-between">
                                    <span class="font-medium">#{{ $payment->idPembayaran }}</span>
                                    <span class="text-sm text-gray-400">{{ $payment->tanggalBayar ? $payment->tanggalBayar->format('M d, Y') : 'N/A' }}</span>
                                </div>
                                <p class="text-gray-400 text-sm">Amount: Rp {{ number_format($payment->jumlah, 0, ',', '.') }}</p>
                                <p class="text-gray-400 text-sm">Status: <span class="capitalize">{{ $payment->statusPembayaran }}</span></p>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-400">No recent payments</p>
                    @endif
                </div>
            </div>
        </div>
    </main>
</body>
</html>