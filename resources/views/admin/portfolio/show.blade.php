<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $portfolio->judul }} - Vidiooo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white min-h-screen flex">
    <!-- Include admin sidebar here -->
    @include('admin.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <header class="mb-8">
            <h1 class="text-3xl font-bold">{{ $portfolio->judul }}</h1>
            <p class="text-gray-400">Portfolio details and management</p>
        </header>
        
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <div class="bg-gray-800 rounded-lg p-6 mb-8">
                        <div class="mb-6">
                            <img src="{{ asset('storage/' . $portfolio->gambarCover) }}" alt="{{ $portfolio->judul }}" class="w-full h-96 object-cover rounded-lg">
                        </div>
                        
                        <div class="prose prose-invert max-w-none">
                            <h2 class="text-2xl font-bold mb-4">Description</h2>
                            <p class="text-gray-300">{{ $portfolio->deskripsi }}</p>
                        </div>
                    </div>
                    
                    <!-- Additional Media -->
                    <div class="bg-gray-800 rounded-lg p-6">
                        <h2 class="text-2xl font-bold mb-4">Additional Media</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @forelse($portfolio->images as $image)
                                <div class="aspect-square bg-gray-700 rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Additional Image" class="w-full h-full object-cover cursor-pointer hover:opacity-75 transition" onclick="window.open(this.src, '_blank')">
                                </div>
                            @empty
                                <div class="col-span-full text-gray-500 text-center py-8">
                                    No additional media uploaded
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-800 rounded-lg p-6 mb-6">
                        <h3 class="text-xl font-bold mb-4">Portfolio Details</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-gray-400">ID</p>
                                <p class="font-medium">{{ $portfolio->idPortofolio }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400">Category</p>
                                <p class="font-medium">{{ $portfolio->kategori }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400">Views</p>
                                <p class="font-medium">{{ $portfolio->jumlahTayangan }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400">Status</p>
                                <p class="font-medium">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $portfolio->aktif ? 'bg-green-800 text-green-200' : 'bg-red-800 text-red-200' }}">
                                        {{ $portfolio->aktif ? 'Active' : 'Inactive' }}
                                    </span>
                                </p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400">Created</p>
                                <p class="font-medium">{{ $portfolio->created_at->format('M d, Y') }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400">Last Updated</p>
                                <p class="font-medium">{{ $portfolio->updated_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-800 rounded-lg p-6">
                        <h3 class="text-xl font-bold mb-4">Actions</h3>
                        
                        <div class="space-y-3">
                            <a 
                                href="{{ route('admin.portfolio.edit', $portfolio->idPortofolio) }}" 
                                class="w-full block bg-yellow-600 hover:bg-yellow-700 text-white text-center font-semibold py-3 px-4 rounded-lg transition"
                            >
                                <i class="fas fa-edit mr-2"></i> Edit Portfolio
                            </a>
                            
                            <button 
                                onclick="toggleStatus('{{ $portfolio->idPortofolio }}')" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition"
                            >
                                <i class="fas {{ $portfolio->aktif ? 'fa-eye-slash' : 'fa-eye' }} mr-2"></i>
                                {{ $portfolio->aktif ? 'Unpublish' : 'Publish' }}
                            </button>
                            
                            <a 
                                href="{{ route('portfolio.show', $portfolio->idPortofolio) }}" 
                                target="_blank"
                                class="w-full block bg-green-600 hover:bg-green-700 text-white text-center font-semibold py-3 px-4 rounded-lg transition"
                            >
                                <i class="fas fa-external-link-alt mr-2"></i> View on Website
                            </a>
                            
                            <button 
                                onclick="deletePortfolio('{{ $portfolio->idPortofolio }}')" 
                                class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg transition"
                            >
                                <i class="fas fa-trash mr-2"></i> Delete Portfolio
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <script>
        function toggleStatus(id) {
            // In a real implementation, you would make an AJAX call to toggle the status
            fetch(`/admin/portfolio/${id}/publish`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Refresh the page or update the UI accordingly
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        }
        
        function deletePortfolio(id) {
            if (confirm('Are you sure you want to delete this portfolio? This action cannot be undone.')) {
                // In a real implementation, you would make an AJAX call to delete the portfolio
                fetch(`/admin/portfolio/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (response.ok) {
                        window.location.href = '{{ route('admin.portfolio.index') }}';
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }
    </script>
</body>
</html>