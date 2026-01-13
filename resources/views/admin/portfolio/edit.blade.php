<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Portfolio - Vidiooo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white min-h-screen flex">
    <!-- Include admin sidebar here -->
    @include('admin.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <header class="mb-8">
            <h1 class="text-3xl font-bold">Edit Portfolio</h1>
            <p class="text-gray-400">Update portfolio item: {{ $portfolio->judul }}</p>
        </header>
        
        <div class="max-w-4xl mx-auto">
            <form method="POST" action="{{ route('admin.portfolio.update', $portfolio->idPortofolio) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="judul" class="block text-gray-300 mb-2">Title</label>
                        <input 
                            type="text" 
                            name="judul" 
                            id="judul" 
                            value="{{ old('judul', $portfolio->judul) }}"
                            required
                            class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                    
                    <div>
                        <label for="kategori" class="block text-gray-300 mb-2">Category</label>
                        <select 
                            name="kategori" 
                            id="kategori" 
                            required
                            class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="">Select Category</option>
                            <option value="Wedding" {{ $portfolio->kategori == 'Wedding' ? 'selected' : '' }}>Wedding</option>
                            <option value="Event" {{ $portfolio->kategori == 'Event' ? 'selected' : '' }}>Event</option>
                            <option value="Corporate" {{ $portfolio->kategori == 'Corporate' ? 'selected' : '' }}>Corporate</option>
                            <option value="Product" {{ $portfolio->kategori == 'Product' ? 'selected' : '' }}>Product</option>
                            <option value="Music Video" {{ $portfolio->kategori == 'Music Video' ? 'selected' : '' }}>Music Video</option>
                            <option value="Documentary" {{ $portfolio->kategori == 'Documentary' ? 'selected' : '' }}>Documentary</option>
                        </select>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-gray-300 mb-2">Description</label>
                        <textarea 
                            name="deskripsi" 
                            id="deskripsi" 
                            rows="5" 
                            required
                            class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >{{ old('deskripsi', $portfolio->deskripsi) }}</textarea>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-gray-300 mb-2">Current Cover Image</label>
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $portfolio->gambarCover) }}" alt="{{ $portfolio->judul }}" class="w-full h-64 object-cover rounded-lg">
                        </div>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="gambarCover" class="block text-gray-300 mb-2">New Cover Image (optional)</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="gambarCover" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-700 border-dashed rounded-lg cursor-pointer bg-gray-800 hover:bg-gray-700">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-cloud-upload-alt text-2xl text-gray-500 mb-2"></i>
                                    <p class="mb-2 text-sm text-gray-400"><span class="font-semibold">Click to upload</span> new image</p>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                </div>
                                <input 
                                    type="file" 
                                    name="gambarCover" 
                                    id="gambarCover" 
                                    class="hidden"
                                >
                            </label>
                        </div>
                    </div>
                    
                    <div class="md:col-span-2">
                        <div class="flex items-start">
                            <input 
                                type="checkbox" 
                                name="aktif" 
                                id="aktif" 
                                value="1"
                                {{ $portfolio->aktif ? 'checked' : '' }}
                                class="mt-1 mr-3"
                            >
                            <label for="aktif" class="text-gray-300">Publish this portfolio item</label>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.portfolio.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded transition">
                        Cancel
                    </a>
                    <button 
                        type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded transition"
                    >
                        Update Portfolio
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>