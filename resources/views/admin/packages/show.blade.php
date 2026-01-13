<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $package->namaPaket }} - Vidiooo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white min-h-screen flex">
    <!-- Include admin sidebar here -->
    @include('admin.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <header class="mb-8">
            <h1 class="text-3xl font-bold">{{ $package->namaPaket }}</h1>
            <p class="text-gray-400">Package details and management</p>
        </header>
        
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <div class="bg-gray-800 rounded-lg p-6 mb-8">
                        <div class="prose prose-invert max-w-none">
                            <h2 class="text-2xl font-bold mb-4">Description</h2>
                            <p class="text-gray-300">{{ $package->deskripsi }}</p>
                        </div>
                    </div>
                    
                    <!-- Inclusions -->
                    <div class="bg-gray-800 rounded-lg p-6">
                        <h2 class="text-2xl font-bold mb-4">What's Included</h2>
                        <ul class="space-y-3">
                            @foreach($package->inklusi as $item)
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                    <span class="text-gray-300">{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-800 rounded-lg p-6 mb-6">
                        <h3 class="text-xl font-bold mb-4">Package Details</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-gray-400">ID</p>
                                <p class="font-medium">{{ $package->idPaket }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400">Price</p>
                                <p class="font-medium text-2xl text-blue-400">Rp {{ number_format($package->hargaDasar, 0, ',', '.') }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400">Status</p>
                                <p class="font-medium">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $package->aktif ? 'bg-green-800 text-green-200' : 'bg-red-800 text-red-200' }}">
                                        {{ $package->aktif ? 'Active' : 'Inactive' }}
                                    </span>
                                </p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400">Created</p>
                                <p class="font-medium">{{ $package->created_at->format('M d, Y') }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400">Last Updated</p>
                                <p class="font-medium">{{ $package->updated_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-800 rounded-lg p-6">
                        <h3 class="text-xl font-bold mb-4">Actions</h3>
                        
                        <div class="space-y-3">
                            <a 
                                href="{{ route('admin.packages.edit', $package->idPaket) }}" 
                                class="w-full block bg-yellow-600 hover:bg-yellow-700 text-white text-center font-semibold py-3 px-4 rounded-lg transition"
                            >
                                <i class="fas fa-edit mr-2"></i> Edit Package
                            </a>
                            
                            <a 
                                href="{{ route('packages.show', $package->idPaket) }}" 
                                target="_blank"
                                class="w-full block bg-green-600 hover:bg-green-700 text-white text-center font-semibold py-3 px-4 rounded-lg transition"
                            >
                                <i class="fas fa-external-link-alt mr-2"></i> View on Website
                            </a>
                            
                            <button 
                                onclick="deletePackage('{{ $package->idPaket }}')" 
                                class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg transition"
                            >
                                <i class="fas fa-trash mr-2"></i> Delete Package
                            </button>
                        </div>
                    </div>
                    
                    <!-- Price Calculator -->
                    <div class="bg-gray-800 rounded-lg p-6 mt-6">
                        <h3 class="text-xl font-bold mb-4">Price Calculator</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="additional_services" class="block text-gray-300 mb-2">Additional Services</label>
                                <select id="additional_services" class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="0">No additional services</option>
                                    <option value="500000">Drone Footage (+Rp 500,000)</option>
                                    <option value="1000000">Extra Camera (+Rp 1,000,000)</option>
                                    <option value="1500000">Professional Editing (+Rp 1,500,000)</option>
                                </select>
                            </div>
                            
                            <div class="pt-4 border-t border-gray-700">
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-400">Base Price:</span>
                                    <span class="font-medium">Rp {{ number_format($package->hargaDasar, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-400">Additional:</span>
                                    <span class="font-medium" id="additional-price">Rp 0</span>
                                </div>
                                <div class="flex justify-between text-lg font-bold pt-2 border-t border-gray-700">
                                    <span>Total:</span>
                                    <span id="total-price">Rp {{ number_format($package->hargaDasar, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <script>
        function deletePackage(id) {
            if (confirm('Are you sure you want to delete this package? This action cannot be undone.')) {
                // In a real implementation, you would make an AJAX call to delete the package
                fetch(`/admin/packages/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (response.ok) {
                        window.location.href = '{{ route('admin.packages.index') }}';
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }
        
        // Price calculator functionality
        document.getElementById('additional_services').addEventListener('change', function() {
            const basePrice = {{ $package->hargaDasar }};
            const additionalPrice = parseInt(this.value);
            const totalPrice = basePrice + additionalPrice;
            
            document.getElementById('additional-price').textContent = 'Rp ' + additionalPrice.toLocaleString('id-ID');
            document.getElementById('total-price').textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
        });
    </script>
</body>
</html>