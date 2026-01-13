<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonial - Vidiooo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white min-h-screen flex">
    <!-- Include admin sidebar here -->
    @include('admin.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <header class="mb-8">
            <h1 class="text-3xl font-bold">Testimonial Management</h1>
            <p class="text-gray-400">Review and manage customer testimonials</p>
        </header>
        
        <div class="max-w-4xl mx-auto">
            <div class="bg-gray-800 rounded-lg p-6 mb-8">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold">Testimonial Review</h2>
                        <p class="text-gray-400">Manage customer feedback</p>
                    </div>
                    
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.testimonials.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded transition">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </a>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-gray-700 rounded-lg p-6 text-center">
                        <div class="text-4xl font-bold text-blue-400 mb-2">4.8</div>
                        <div class="flex justify-center mb-2">
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star-half-alt text-yellow-400"></i>
                        </div>
                        <p class="text-gray-400">Average Rating</p>
                    </div>
                    
                    <div class="bg-gray-700 rounded-lg p-6 text-center">
                        <div class="text-4xl font-bold text-green-400 mb-2">128</div>
                        <p class="text-gray-400">Total Reviews</p>
                    </div>
                    
                    <div class="bg-gray-700 rounded-lg p-6 text-center">
                        <div class="text-4xl font-bold text-purple-400 mb-2">92%</div>
                        <p class="text-gray-400">Approval Rate</p>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <!-- Testimonial 1 -->
                    <div class="bg-gray-700 rounded-lg p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-bold">John Doe</h3>
                                <p class="text-gray-400">CEO, Tech Solutions Inc.</p>
                            </div>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400 mr-4">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="bg-green-800 text-green-200 text-xs px-2 py-1 rounded">Approved</span>
                            </div>
                        </div>
                        <p class="text-gray-300 mb-4">"Working with Vidiooo was an absolute pleasure. Their team captured our company culture perfectly and delivered a video that exceeded our expectations. The attention to detail and professionalism was outstanding."</p>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 text-sm">Posted on Jan 15, 2024</span>
                            <div class="flex space-x-2">
                                <button class="text-red-400 hover:text-red-300">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Testimonial 2 -->
                    <div class="bg-gray-700 rounded-lg p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-bold">Sarah Johnson</h3>
                                <p class="text-gray-400">Wedding Client</p>
                            </div>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400 mr-4">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="bg-yellow-800 text-yellow-200 text-xs px-2 py-1 rounded">Pending</span>
                            </div>
                        </div>
                        <p class="text-gray-300 mb-4">"The team did an incredible job capturing our special day. Every moment was beautifully preserved, and the final video was everything we dreamed of. Highly recommend their services!"</p>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 text-sm">Posted on Jan 10, 2024</span>
                            <div class="flex space-x-2">
                                <button class="text-green-400 hover:text-green-300">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="text-red-400 hover:text-red-300">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button class="text-red-400 hover:text-red-300">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Testimonial 3 -->
                    <div class="bg-gray-700 rounded-lg p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-bold">Michael Chen</h3>
                                <p class="text-gray-400">Marketing Director, Brand Co.</p>
                            </div>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400 mr-4">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="bg-red-800 text-red-200 text-xs px-2 py-1 rounded">Rejected</span>
                            </div>
                        </div>
                        <p class="text-gray-300 mb-4">"The video production was top-notch, but the delivery was delayed by two weeks past our agreed deadline. Communication could have been better, but the final product was worth the wait."</p>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 text-sm">Posted on Jan 5, 2024</span>
                            <div class="flex space-x-2">
                                <button class="text-green-400 hover:text-green-300">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="text-red-400 hover:text-red-300">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>