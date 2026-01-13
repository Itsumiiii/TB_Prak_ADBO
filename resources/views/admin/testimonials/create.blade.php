<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Testimonial - Vidiooo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white min-h-screen flex">
    @include('admin.sidebar')
    
    <main class="flex-1 p-6">
        <header class="mb-8">
            <a href="{{ route('admin.testimonials.index') }}" class="text-gray-400 hover:text-white mb-4 inline-block">
                <i class="fas fa-arrow-left mr-2"></i> Back to Testimonials
            </a>
            <h1 class="text-3xl font-bold">Add New Testimonial</h1>
        </header>

        <div class="max-w-xl mx-auto bg-gray-800 rounded-lg p-8 shadow-lg">
            <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-gray-300 mb-2">Client Name</label>
                    <input type="text" name="name" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="e.g. Sarah Connor">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-300 mb-2">Rating</label>
                    <div class="flex space-x-4">
                        @for($i = 1; $i <= 5; $i++)
                            <label class="cursor-pointer">
                                <input type="radio" name="rating" value="{{ $i }}" class="hidden peer" required>
                                <i class="fas fa-star text-2xl text-gray-600 peer-checked:text-yellow-400 hover:text-yellow-300 transition"></i>
                            </label>
                        @endfor
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-300 mb-2">Testimonial Content</label>
                    <textarea name="komentar" rows="4" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="Client's feedback..."></textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-300 mb-2">Proof/Chat Screenshot (Optional)</label>
                    <input type="file" name="gambar" class="w-full text-gray-300 bg-gray-700 border border-gray-600 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                    Save Testimonial
                </button>
            </form>
        </div>
    </main>
    <script>
        const stars = document.querySelectorAll('input[name="rating"]');
        const icons = document.querySelectorAll('.fa-star');

        stars.forEach((star, index) => {
            star.addEventListener('change', () => {
                icons.forEach((icon, i) => {
                    if (i <= index) {
                        icon.classList.remove('text-gray-600');
                        icon.classList.add('text-yellow-400');
                    } else {
                        icon.classList.add('text-gray-600');
                        icon.classList.remove('text-yellow-400');
                    }
                });
            });
        });
    </script>
</body>
</html>
