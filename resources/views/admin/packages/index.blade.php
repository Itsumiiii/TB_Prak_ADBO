<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Package Management - Vidiooo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white min-h-screen flex">
    <!-- Include admin sidebar here -->
    @include('admin.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <header class="mb-8">
            <h1 class="text-3xl font-bold">Package Management</h1>
            <p class="text-gray-400">Manage your service packages</p>
        </header>
        
        <!-- Action Bar -->
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('admin.packages.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition flex items-center">
                <i class="fas fa-plus mr-2"></i> Add New Package
            </a>
            
            <div class="relative">
                <input type="text" placeholder="Search packages..." class="bg-gray-800 border border-gray-700 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        
        <!-- Packages Table -->
        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
            <table class="min-w-full divide-y divide-gray-700">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Package Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($packages as $package)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium">{{ $package->namaPaket }}</div>
                                <div class="text-sm text-gray-400">{{ Str::limit($package->deskripsi, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm">Rp {{ number_format($package->hargaDasar, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $package->aktif ? 'bg-green-800 text-green-200' : 'bg-red-800 text-red-200' }}">
                                    {{ $package->aktif ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.packages.show', $package->idPaket) }}" class="text-blue-400 hover:text-blue-300">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.packages.edit', $package->idPaket) }}" class="text-yellow-400 hover:text-yellow-300">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form id="delete-form-{{ $package->idPaket }}" action="{{ route('admin.packages.destroy', $package->idPaket) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="deletePackage('{{ $package->idPaket }}')" class="text-red-400 hover:text-red-300">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-400">
                                No packages found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
    
    <script>
        function deletePackage(id) {
            if (confirm('Are you sure you want to delete this package?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
</body>
</html>