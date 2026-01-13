<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Vidiooo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white min-h-screen flex">
    <!-- Include admin sidebar here -->
    @include('admin.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <header class="mb-8">
            <h1 class="text-3xl font-bold">Settings</h1>
            <p class="text-gray-400">Manage your company settings</p>
        </header>
        
        <!-- Tabs -->
        <div class="border-b border-gray-700 mb-8">
            <nav class="flex space-x-8">
                <button class="tab-button active px-1 pb-4 border-b-2 border-blue-500 text-blue-400 font-medium">Company Info</button>
                <button class="tab-button px-1 pb-4 text-gray-400 hover:text-gray-300 font-medium">WhatsApp</button>
                <button class="tab-button px-1 pb-4 text-gray-400 hover:text-gray-300 font-medium">Social Media</button>
                <button class="tab-button px-1 pb-4 text-gray-400 hover:text-gray-300 font-medium">System</button>
            </nav>
        </div>
        
        <!-- Company Info Tab -->
        <div class="tab-content active" id="company-info-tab">
            <form method="POST" action="{{ route('admin.settings.company.update') }}">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="namaPerusahaan" class="block text-gray-300 mb-2">Company Name</label>
                        <input 
                            type="text" 
                            name="namaPerusahaan" 
                            id="namaPerusahaan" 
                            value="{{ $companyInfo->namaPerusahaan ?? '' }}"
                            class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                    
                    <div>
                        <label for="email" class="block text-gray-300 mb-2">Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="{{ $companyInfo->email ?? '' }}"
                            class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                    
                    <div>
                        <label for="nomorWhatsApp" class="block text-gray-300 mb-2">WhatsApp Number</label>
                        <input 
                            type="text" 
                            name="nomorWhatsApp" 
                            id="nomorWhatsApp" 
                            value="{{ $companyInfo->nomorWhatsApp ?? '' }}"
                            class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                    
                    <div>
                        <label for="alamat" class="block text-gray-300 mb-2">Address</label>
                        <textarea 
                            name="alamat" 
                            id="alamat" 
                            rows="3"
                            class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >{{ $companyInfo->alamat ?? '' }}</textarea>
                    </div>
                </div>
                
                <button 
                    type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded transition"
                >
                    Update Company Info
                </button>
            </form>
        </div>
        
        <!-- WhatsApp Tab -->
        <div class="tab-content hidden" id="whatsapp-tab">
            <form method="POST" action="{{ route('admin.settings.whatsapp.update') }}">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="whatsapp_token" class="block text-gray-300 mb-2">WhatsApp API Token</label>
                        <input 
                            type="password" 
                            name="whatsapp_token" 
                            id="whatsapp_token" 
                            class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                        <p class="text-gray-400 text-sm mt-2">Enter your WhatsApp Business API token</p>
                    </div>
                    
                    <div>
                        <label for="business_number" class="block text-gray-300 mb-2">Business Number</label>
                        <input 
                            type="text" 
                            name="business_number" 
                            id="business_number" 
                            class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                        <p class="text-gray-400 text-sm mt-2">Your WhatsApp business number</p>
                    </div>
                </div>
                
                <button 
                    type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded transition"
                >
                    Update WhatsApp Settings
                </button>
            </form>
        </div>
        
        <!-- Social Media Tab -->
        <div class="tab-content hidden" id="social-tab">
            <form method="POST" action="{{ route('admin.settings.social.update') }}">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="instagram_url" class="block text-gray-300 mb-2">Instagram URL</label>
                        <input 
                            type="url" 
                            name="instagram_url" 
                            id="instagram_url" 
                            value="{{ $companyInfo->instagram ?? '' }}"
                            class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                    
                    <div>
                        <label for="facebook_url" class="block text-gray-300 mb-2">Facebook URL</label>
                        <input 
                            type="url" 
                            name="facebook_url" 
                            id="facebook_url" 
                            value="{{ $companyInfo->facebook ?? '' }}"
                            class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                    
                    <div>
                        <label for="youtube_url" class="block text-gray-300 mb-2">YouTube URL</label>
                        <input 
                            type="url" 
                            name="youtube_url" 
                            id="youtube_url" 
                            value="{{ $companyInfo->youtube ?? '' }}"
                            class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                    
                    <div>
                        <label for="tiktok_url" class="block text-gray-300 mb-2">TikTok URL</label>
                        <input 
                            type="url" 
                            name="tiktok_url" 
                            id="tiktok_url" 
                            value="{{ $companyInfo->tiktok ?? '' }}"
                            class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                </div>
                
                <button 
                    type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded transition"
                >
                    Update Social Media
                </button>
            </form>
        </div>
        
        <!-- System Tab -->
        <div class="tab-content hidden" id="system-tab">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-gray-300 mb-2">Timezone</label>
                    <select class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="UTC">UTC</option>
                        <option value="Asia/Jakarta" selected>Asia/Jakarta (GMT+7)</option>
                        <option value="Asia/Makassar">Asia/Makassar (GMT+8)</option>
                        <option value="Asia/Jayapura">Asia/Jayapura (GMT+9)</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-300 mb-2">Currency</label>
                    <select class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="IDR" selected>Indonesian Rupiah (IDR)</option>
                        <option value="USD">US Dollar (USD)</option>
                        <option value="EUR">Euro (EUR)</option>
                        <option value="GBP">British Pound (GBP)</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-300 mb-2">Language</label>
                    <select class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="en" selected>English</option>
                        <option value="id">Indonesian</option>
                        <option value="es">Spanish</option>
                        <option value="fr">French</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-300 mb-2">Date Format</label>
                    <select class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="d-m-Y">DD-MM-YYYY</option>
                        <option value="m/d/Y" selected>MM/DD/YYYY</option>
                        <option value="Y-m-d">YYYY-MM-DD</option>
                    </select>
                </div>
            </div>
            
            <button 
                type="button" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded transition"
            >
                Update System Settings
            </button>
        </div>
    </main>
    
    <script>
        // Tab functionality
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons and content
                document.querySelectorAll('.tab-button').forEach(btn => {
                    btn.classList.remove('active');
                    btn.classList.remove('text-blue-400');
                    btn.classList.remove('border-b-2');
                    btn.classList.remove('border-blue-500');
                    btn.classList.add('text-gray-400');
                });
                
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.add('hidden');
                });
                
                // Add active class to clicked button
                button.classList.add('active');
                button.classList.remove('text-gray-400');
                button.classList.add('text-blue-400');
                button.classList.add('border-b-2');
                button.classList.add('border-blue-500');
                
                // Show corresponding content
                const tabId = button.textContent.trim().toLowerCase().replace(/\s+/g, '-');
                document.getElementById(tabId + '-tab').classList.remove('hidden');
            });
        });
    </script>
</body>
</html>