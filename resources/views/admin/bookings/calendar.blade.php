<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Calendar - Vidiooo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex">
    <!-- Include admin sidebar here -->
    @include('admin.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <header class="mb-8">
            <h1 class="text-3xl font-bold">Booking Calendar</h1>
            <p class="text-gray-400">Manage your schedule and bookings</p>
        </header>
        
        <div class="max-w-6xl mx-auto">
            <div class="bg-gray-800 rounded-lg p-6 mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Schedule Overview</h2>
                    
                    <button 
                        type="button" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition flex items-center"
                        onclick="openBlockDateModal()"
                    >
                        <i class="fas fa-calendar-plus mr-2"></i> Block Date
                    </button>
                </div>
                
                <div id="calendar"></div>
            </div>
            
            <!-- Blocked Dates -->
            <div class="bg-gray-800 rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6">Blocked Dates</h2>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Reason</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm">January 15, 2024</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm">Maintenance Day</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-800 text-red-200">
                                        Blocked
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <button class="text-red-400 hover:text-red-300">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm">February 14, 2024</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm">Valentine's Day - Fully Booked</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-800 text-red-200">
                                        Blocked
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <button class="text-red-400 hover:text-red-300">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Block Date Modal -->
    <div id="blockDateModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-gray-800 rounded-lg p-6 w-full max-w-md mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Block Date</h3>
                <button onclick="closeBlockDateModal()" class="text-gray-400 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="blockDateForm">
                <div class="mb-4">
                    <label for="blockDate" class="block text-gray-300 mb-2">Select Date</label>
                    <input 
                        type="date" 
                        id="blockDate" 
                        class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>
                
                <div class="mb-6">
                    <label for="blockReason" class="block text-gray-300 mb-2">Reason for Blocking</label>
                    <input 
                        type="text" 
                        id="blockReason" 
                        placeholder="Enter reason for blocking this date"
                        class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button 
                        type="button" 
                        onclick="closeBlockDateModal()" 
                        class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded transition"
                    >
                        Cancel
                    </button>
                    <button 
                        type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition"
                    >
                        Block Date
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    // Sample booking events
                    {
                        title: 'Wedding Event',
                        start: '2024-01-20',
                        end: '2024-01-20',
                        backgroundColor: '#3B82F6', // Blue
                        extendedProps: {
                            status: 'confirmed'
                        }
                    },
                    {
                        title: 'Corporate Event',
                        start: '2024-01-25',
                        end: '2024-01-25',
                        backgroundColor: '#10B981', // Green
                        extendedProps: {
                            status: 'confirmed'
                        }
                    },
                    {
                        title: 'Product Launch',
                        start: '2024-02-05',
                        end: '2024-02-05',
                        backgroundColor: '#8B5CF6', // Purple
                        extendedProps: {
                            status: 'pending'
                        }
                    }
                ],
                eventClick: function(info) {
                    alert('Event: ' + info.event.title + '\nDate: ' + info.event.start.toLocaleDateString());
                },
                dateClick: function(info) {
                    document.getElementById('blockDate').value = info.dateStr;
                    openBlockDateModal();
                }
            });
            
            calendar.render();
        });
        
        function openBlockDateModal() {
            document.getElementById('blockDateModal').classList.remove('hidden');
        }
        
        function closeBlockDateModal() {
            document.getElementById('blockDateModal').classList.add('hidden');
        }
        
        document.getElementById('blockDateForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const date = document.getElementById('blockDate').value;
            const reason = document.getElementById('blockReason').value;
            
            // In a real implementation, you would make an AJAX call to block the date
            console.log('Blocking date:', date, 'Reason:', reason);
            
            // Close modal and refresh calendar
            closeBlockDateModal();
            // calendar.refetchEvents(); // Uncomment when calendar variable is accessible
            
            // Show success message
            alert('Date blocked successfully!');
        });
    </script>
</body>
</html>