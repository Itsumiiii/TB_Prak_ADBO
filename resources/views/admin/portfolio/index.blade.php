<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Portfolio Management - Vidiooo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white min-h-screen flex">
    <!-- Include admin sidebar here -->
    @include('admin.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <header class="mb-8">
            <h1 class="text-3xl font-bold">Portfolio Management</h1>
            <p class="text-gray-400">Manage your portfolio items</p>
        </header>
        
        <!-- Action Bar -->
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('admin.portfolio.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition flex items-center">
                <i class="fas fa-plus mr-2"></i> Add New Portfolio
            </a>
            
            <div class="relative">
                <input type="text" placeholder="Search portfolios..." class="bg-gray-800 border border-gray-700 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        
        <!-- Portfolio Table -->
        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
            <table class="min-w-full divide-y divide-gray-700">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Cover</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Views</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($portfolios as $portfolio)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="{{ asset('storage/' . $portfolio->gambarCover) }}" alt="{{ $portfolio->judul }}" class="w-16 h-16 object-cover rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium">{{ $portfolio->judul }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-400">{{ $portfolio->kategori }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-400">{{ $portfolio->jumlahTayangan }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $portfolio->aktif ? 'bg-green-800 text-green-200' : 'bg-red-800 text-red-200' }}">
                                    {{ $portfolio->aktif ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.portfolio.show', $portfolio->idPortofolio) }}" class="text-blue-400 hover:text-blue-300">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.portfolio.edit', $portfolio->idPortofolio) }}" class="text-yellow-400 hover:text-yellow-300">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form id="delete-form-{{ $portfolio->idPortofolio }}" action="{{ route('admin.portfolio.destroy', $portfolio->idPortofolio) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="deletePortfolio('{{ $portfolio->idPortofolio }}')" class="text-red-400 hover:text-red-300">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <button 
                                        onclick="toggleStatus('{{ $portfolio->idPortofolio }}')" 
                                        class="ml-2 {{ $portfolio->aktif ? 'text-red-400 hover:text-red-300' : 'text-green-400 hover:text-green-300' }}"
                                    >
                                        <i class="fas {{ $portfolio->aktif ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-400">
                                No portfolios found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
    
    <script>
        function deletePortfolio(id) {
            if (confirm('Are you sure you want to delete this portfolio?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
        
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
    </script>
</body>
</html>