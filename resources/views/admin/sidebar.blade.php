<aside class="w-64 bg-gray-800 min-h-screen p-4">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-center py-4">Vidiooo Admin</h1>
    </div>
    
    <nav>
        <ul class="space-y-2">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 p-2 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : 'hover:bg-gray-700' }} rounded">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.portfolio.index') }}" class="flex items-center space-x-2 p-2 {{ request()->routeIs('admin.portfolio.*') ? 'bg-blue-600' : 'hover:bg-gray-700' }} rounded">
                    <i class="fas fa-images"></i>
                    <span>Portfolio</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.packages.index') }}" class="flex items-center space-x-2 p-2 {{ request()->routeIs('admin.packages.*') ? 'bg-blue-600' : 'hover:bg-gray-700' }} rounded">
                    <i class="fas fa-box"></i>
                    <span>Packages</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.bookings.index') }}" class="flex items-center space-x-2 p-2 {{ request()->routeIs('admin.bookings.*') ? 'bg-blue-600' : 'hover:bg-gray-700' }} rounded">
                    <i class="fas fa-calendar-check"></i>
                    <span>Bookings</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.payments.index') }}" class="flex items-center space-x-2 p-2 {{ request()->routeIs('admin.payments.*') ? 'bg-blue-600' : 'hover:bg-gray-700' }} rounded">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Payments</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.testimonials.index') }}" class="flex items-center space-x-2 p-2 {{ request()->routeIs('admin.testimonials.*') ? 'bg-blue-600' : 'hover:bg-gray-700' }} rounded">
                    <i class="fas fa-comments"></i>
                    <span>Testimonials</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.analytics.index') }}" class="flex items-center space-x-2 p-2 {{ request()->routeIs('admin.analytics.*') ? 'bg-blue-600' : 'hover:bg-gray-700' }} rounded">
                    <i class="fas fa-chart-line"></i>
                    <span>Analytics</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center space-x-2 p-2 {{ request()->routeIs('admin.settings.*') ? 'bg-blue-600' : 'hover:bg-gray-700' }} rounded">
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
