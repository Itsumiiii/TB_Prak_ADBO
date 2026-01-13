<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Package - Vidiooo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white min-h-screen flex">
    <!-- Include admin sidebar here -->
    @include('admin.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <header class="mb-8">
            <h1 class="text-3xl font-bold">Edit Package</h1>
            <p class="text-gray-400">Update package: {{ $package->namaPaket }}</p>
        </header>
        
        <div class="max-w-4xl mx-auto">
            <form method="POST" action="{{ route('admin.packages.update', $package->idPaket) }}">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="namaPaket" class="block text-gray-300 mb-2">Package Name</label>
                        <input 
                            type="text" 
                            name="namaPaket" 
                            id="namaPaket" 
                            value="{{ old('namaPaket', $package->namaPaket) }}"
                            required
                            class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                    
                    <div>
                        <label for="hargaDasar" class="block text-gray-300 mb-2">Base Price (Rp)</label>
                        <input 
                            type="number" 
                            name="hargaDasar" 
                            id="hargaDasar" 
                            value="{{ old('hargaDasar', $package->hargaDasar) }}"
                            required
                            min="0"
                            step="1000"
                            class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-gray-300 mb-2">Description</label>
                        <textarea 
                            name="deskripsi" 
                            id="deskripsi" 
                            rows="4" 
                            required
                            class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >{{ old('deskripsi', $package->deskripsi) }}</textarea>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-gray-300 mb-2">Inclusions</label>
                        <div id="inclusions-container">
                            @foreach($package->inklusi as $index => $inklusi)
                                <div class="flex items-center mb-3">
                                    <input 
                                        type="text" 
                                        name="inklusi[]" 
                                        value="{{ $inklusi }}"
                                        placeholder="Add inclusion (e.g., Full HD Video)" 
                                        class="flex-1 bg-gray-800 border border-gray-700 rounded-l px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    >
                                    <button type="button" class="bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-r" onclick="removeInclusion(this)">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endforeach
                            <!-- Empty field for adding new inclusions -->
                            <div class="flex items-center mb-3">
                                <input 
                                    type="text" 
                                    name="inklusi[]" 
                                    placeholder="Add inclusion (e.g., Full HD Video)" 
                                    class="flex-1 bg-gray-800 border border-gray-700 rounded-l px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-r" onclick="addInclusion()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <p class="text-gray-400 text-sm mt-2">Press Enter or click the + button to add more inclusions</p>
                    </div>
                    
                    <div class="md:col-span-2">
                        <div class="flex items-start">
                            <input 
                                type="checkbox" 
                                name="aktif" 
                                id="aktif" 
                                value="1"
                                {{ $package->aktif ? 'checked' : '' }}
                                class="mt-1 mr-3"
                            >
                            <label for="aktif" class="text-gray-300">Make this package active</label>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.packages.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded transition">
                        Cancel
                    </a>
                    <button 
                        type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded transition"
                    >
                        Update Package
                    </button>
                </div>
            </form>
        </div>
    </main>
    
    <script>
        function addInclusion() {
            const container = document.getElementById('inclusions-container');
            const newInclusion = document.createElement('div');
            newInclusion.className = 'flex items-center mb-3';
            newInclusion.innerHTML = `
                <input 
                    type="text" 
                    name="inklusi[]" 
                    placeholder="Add inclusion (e.g., Full HD Video)" 
                    class="flex-1 bg-gray-800 border border-gray-700 rounded-l px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button type="button" class="bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-r" onclick="removeInclusion(this)">
                    <i class="fas fa-times"></i>
                </button>
            `;
            container.appendChild(newInclusion);
        }
        
        function removeInclusion(button) {
            button.parentElement.remove();
        }
        
        // Allow adding inclusion by pressing Enter
        document.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && e.target.name === 'inklusi[]') {
                e.preventDefault();
                addInclusion();
            }
        });
    </script>
</body>
</html>