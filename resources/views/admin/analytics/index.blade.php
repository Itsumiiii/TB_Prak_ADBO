<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Dashboard - Vidiooo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex">
    <!-- Include admin sidebar here -->
    @include('admin.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <header class="mb-8">
            <h1 class="text-3xl font-bold">Analytics Dashboard</h1>
            <p class="text-gray-400">Track website performance and user engagement</p>
        </header>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gray-800 rounded-lg p-6 shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-500/20 mr-4">
                        <i class="fas fa-eye text-blue-400 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-400">Page Views</p>
                        <p class="text-2xl font-bold">{{ $totalPageViews }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-800 rounded-lg p-6 shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-500/20 mr-4">
                        <i class="fas fa-users text-green-400 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-400">Unique Visitors</p>
                        <p class="text-2xl font-bold">{{ $totalUniqueVisitors }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-800 rounded-lg p-6 shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-500/20 mr-4">
                        <i class="fas fa-percentage text-yellow-400 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-400">Conversion Rate</p>
                        <p class="text-2xl font-bold">{{ number_format($conversionRate, 2) }}%</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-800 rounded-lg p-6 shadow-lg">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-500/20 mr-4">
                        <i class="fas fa-star text-purple-400 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-400">Top Content</p>
                        <p class="text-2xl font-bold">{{ $popularPortfolio ? $popularPortfolio->judul : 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Page Views Chart -->
            <div class="bg-gray-800 rounded-lg p-6 shadow-lg">
                <h3 class="text-xl font-bold mb-4">Page Views (Last 30 Days)</h3>
                <canvas id="pageViewsChart"></canvas>
            </div>
            
            <!-- Top Content Chart -->
            <div class="bg-gray-800 rounded-lg p-6 shadow-lg">
                <h3 class="text-xl font-bold mb-4">Top Content</h3>
                <canvas id="topContentChart"></canvas>
            </div>
        </div>
        
        <!-- Top Content List -->
        <div class="bg-gray-800 rounded-lg p-6 shadow-lg mb-8">
            <h3 class="text-xl font-bold mb-4">Top 5 Content</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Views</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Category</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($topContent as $content)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium">{{ $content->judul }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm">{{ $content->jumlahTayangan }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm">{{ $content->kategori }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-400">
                                    No content data available
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    
    <script>
        // Page Views Chart
        const pageViewsCtx = document.getElementById('pageViewsChart').getContext('2d');
        const pageViewsChart = new Chart(pageViewsCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Page Views',
                    data: {!! json_encode($chartValues) !!},
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        // Top Content Chart
        const topContentCtx = document.getElementById('topContentChart').getContext('2d');
        const topContentChart = new Chart(topContentCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($topContentLabels) !!},
                datasets: [{
                    label: 'Views',
                    data: {!! json_encode($topContentValues) !!},
                    backgroundColor: 'rgba(139, 92, 246, 0.7)',
                    borderColor: 'rgb(139, 92, 246)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>