<footer class="bg-gray-800 py-12 mt-16">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <i class="fas fa-video text-blue-500 text-2xl"></i>
                    <h3 class="text-xl font-bold">Vidiooo</h3>
                </div>
                <p class="text-gray-400">
                    Creative Production House dedicated to bringing your vision to life through stunning visual storytelling.
                </p>
            </div>
            
            <div>
                <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">Home</a></li>
                    <li><a href="{{ route('portfolio.index') }}" class="text-gray-400 hover:text-white transition">Portfolio</a></li>
                    <li><a href="{{ route('packages.index') }}" class="text-gray-400 hover:text-white transition">Packages</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition">About Us</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-lg font-semibold mb-4">Services</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('packages.index') }}" class="text-gray-400 hover:text-white transition">Wedding Videos</a></li>
                    <li><a href="{{ route('packages.index') }}" class="text-gray-400 hover:text-white transition">Corporate Events</a></li>
                    <li><a href="{{ route('packages.index') }}" class="text-gray-400 hover:text-white transition">Product Photography</a></li>
                    <li><a href="{{ route('packages.index') }}" class="text-gray-400 hover:text-white transition">Brand Films</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-lg font-semibold mb-4">Contact Info</h4>
                <ul class="space-y-2 text-gray-400">
                    @if(isset($companyInfo))
                        <li><i class="fas fa-envelope mr-2"></i> {{ $companyInfo->email }}</li>
                        <li><i class="fab fa-whatsapp mr-2"></i> {{ $companyInfo->nomorWhatsApp }}</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i> {{ $companyInfo->alamat }}</li>
                    @endif
                </ul>
                
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </div>
        
        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-500">
            <p>&copy; {{ date('Y') }} Vidiooo Creative Production House. All rights reserved.</p>
        </div>
    </div>
</footer>