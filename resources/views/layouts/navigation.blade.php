<nav class="bg-gray-800/90 backdrop-blur-md py-4 px-6 sticky top-0 z-50 border-b border-gray-700">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <i class="fas fa-video text-blue-400 text-2xl"></i>
            <a href="{{ route('home') }}" class="text-xl font-bold bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text text-transparent">Vidiooo</a>
        </div>

        <div class="hidden md:flex space-x-8">
            <a href="{{ route('home') }}" class="hover:text-blue-300 transition font-medium">Home</a>
            <a href="{{ route('portfolio.index') }}" class="hover:text-blue-300 transition font-medium">Portfolio</a>
            <a href="{{ route('packages.index') }}" class="hover:text-blue-300 transition font-medium">Packages</a>
            <a href="{{ route('about') }}" class="hover:text-blue-300 transition font-medium">About</a>
            <a href="{{ route('contact') }}" class="hover:text-blue-300 transition font-medium">Contact</a>
        </div>

        <div class="hidden md:block">
            <a href="{{ route('booking.create') }}" class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-2.5 rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                <i class="fas fa-calendar-plus mr-2"></i>Book Now
            </a>
        </div>

        <!-- Mobile menu button -->
        <div class="md:hidden">
            <button id="mobile-menu-button" class="text-white focus:outline-none p-2 rounded-lg hover:bg-gray-700 transition">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden md:hidden mt-4 py-4 border-t border-gray-700 bg-gray-800/95 backdrop-blur-sm rounded-lg">
        <div class="flex flex-col space-y-4 px-4">
            <a href="{{ route('home') }}" class="hover:text-blue-300 transition font-medium py-2">Home</a>
            <a href="{{ route('portfolio.index') }}" class="hover:text-blue-300 transition font-medium py-2">Portfolio</a>
            <a href="{{ route('packages.index') }}" class="hover:text-blue-300 transition font-medium py-2">Packages</a>
            <a href="{{ route('about') }}" class="hover:text-blue-300 transition font-medium py-2">About</a>
            <a href="{{ route('contact') }}" class="hover:text-blue-300 transition font-medium py-2">Contact</a>
            <a href="{{ route('booking.create') }}" class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-full transition-all duration-300 text-center font-medium mt-2">
                Book Now
            </a>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
        // Change icon when menu is open
        const icon = mobileMenuButton.querySelector('i');
        if (mobileMenu.classList.contains('hidden')) {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        } else {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        }
    });
});
</script>