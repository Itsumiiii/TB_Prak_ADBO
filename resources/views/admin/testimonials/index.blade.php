<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonials - Vidiooo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white min-h-screen flex">
    @include('admin.sidebar')
    
    <main class="flex-1 p-6">
        <header class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Testimonials</h1>
                <p class="text-gray-400">Manage client testimonials</p>
            </div>
            <a href="{{ route('admin.testimonials.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                <i class="fas fa-plus mr-2"></i> Add Testimonial
            </a>
        </header>

        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500 text-green-500 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($testimonials as $testimonial)
                <div class="bg-gray-800 rounded-lg p-6 shadow-lg border border-gray-700 relative">
                    <div class="absolute top-4 right-4">
                        <form action="{{ route('admin.testimonials.destroy', $testimonial->idTestimoni) }}" method="POST" onsubmit="return confirm('Delete this testimonial?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-500 hover:text-red-500">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>

                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center mr-3 font-bold flex-shrink-0">
                            {{ substr($testimonial->guest->name ?? 'G', 0, 1) }}
                        </div>
                        <div>
                            <h3 class="font-bold">{{ $testimonial->guest->name ?? 'Unknown' }}</h3>
                            <div class="flex text-yellow-400 text-sm">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $testimonial->rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star text-gray-600"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-gray-300 italic mb-4">"{{ $testimonial->komentar }}"</p>
                    
                    @if($testimonial->gambar)
                        <div class="mb-4 rounded-lg overflow-hidden border border-gray-700">
                            <img src="{{ asset('storage/' . $testimonial->gambar) }}" alt="Chat Proof" class="w-full h-auto object-cover max-h-48">
                        </div>
                    @endif

                    <p class="text-sm text-gray-500">{{ $testimonial->created_at->format('M d, Y') }}</p>
                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-gray-800 rounded-lg">
                    <p class="text-gray-400">No testimonials found.</p>
                </div>
            @endforelse
        </div>
    </main>
</body>
</html>