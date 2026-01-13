<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Portfolio - Vidiooo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white min-h-screen flex">
    <!-- Include admin sidebar here -->
    @include('admin.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <header class="mb-8">
            <h1 class="text-3xl font-bold">Add New Portfolio</h1>
            <p class="text-gray-400">Create a new portfolio item</p>
        </header>
        
        <div class="max-w-4xl mx-auto">
            <form method="POST" action="{{ route('admin.portfolio.store') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="judul" class="block text-gray-300 mb-2">Title</label>
                        <input 
                            type="text" 
                            name="judul" 
                            id="judul" 
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
                            <option value="Wedding">Wedding</option>
                            <option value="Event">Event</option>
                            <option value="Corporate">Corporate</option>
                            <option value="Product">Product</option>
                            <option value="Music Video">Music Video</option>
                            <option value="Documentary">Documentary</option>
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
                        ></textarea>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="gambarCover" class="block text-gray-300 mb-2">Cover Image</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="gambarCover" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-700 border-dashed rounded-lg cursor-pointer bg-gray-800 hover:bg-gray-700">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6 w-full h-full">
                                    <div id="upload-placeholder" class="text-center">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-500 mb-4"></i>
                                        <p class="mb-2 text-sm text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                    </div>
                                    <img id="image-preview" class="hidden w-full h-full object-contain rounded-lg bg-gray-900">
                                </div>
                                <input 
                                    type="file" 
                                    name="gambarCover" 
                                    id="gambarCover" 
                                    class="hidden"
                                >
                            </label>
                        </div>
                        <p class="mt-2 text-sm text-gray-400">Recommended size: 1200x630 pixels</p>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-gray-300 mb-2">Additional Images (Optional, max 3)</label>
                        <div class="grid grid-cols-3 gap-4">
                            @for ($i = 0; $i < 3; $i++)
                            <div class="relative">
                                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-700 border-dashed rounded-lg cursor-pointer bg-gray-800 hover:bg-gray-700 transition">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-plus text-gray-500 mb-2"></i>
                                        <p class="text-xs text-gray-500">Image {{ $i + 1 }}</p>
                                    </div>
                                    <input type="file" name="additional_images[]" class="hidden" accept="image/*" onchange="previewAdditionalImage(this, 'preview-{{ $i }}')">
                                    <img id="preview-{{ $i }}" class="hidden absolute inset-0 w-full h-full object-cover rounded-lg">
                                </label>
                            </div>
                            @endfor
                        </div>
                    </div>
                    
                    <div class="md:col-span-2">
                        <div class="flex items-start">
                            <input 
                                type="checkbox" 
                                name="aktif" 
                                id="aktif" 
                                value="1"
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
                        Save Portfolio
                    </button>
                </div>
            </form>
        </div>
    </main>
    
    <script>
        const gambarInput = document.getElementById('gambarCover');
        const imagePreview = document.getElementById('image-preview');
        const uploadPlaceholder = document.getElementById('upload-placeholder');

        gambarInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    uploadPlaceholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        function previewAdditionalImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const parent = input.parentElement;
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    // parent.querySelector('div').classList.add('hidden'); // Hide placeholder content if desired
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>