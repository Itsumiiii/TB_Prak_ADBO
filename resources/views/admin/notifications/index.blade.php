<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Vidiooo Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-900 text-white min-h-screen flex">
    <!-- Include admin sidebar here -->
    @include('admin.sidebar')
    
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <header class="mb-8">
            <h1 class="text-3xl font-bold">Notifications</h1>
            <p class="text-gray-400">Manage system notifications</p>
        </header>
        
        <!-- Action Bar -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex space-x-4">
                <select class="bg-gray-800 border border-gray-700 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Types</option>
                    <option value="booking">Booking</option>
                    <option value="payment">Payment</option>
                    <option value="testimonial">Testimonial</option>
                </select>
                
                <select class="bg-gray-800 border border-gray-700 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Recipients</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            
            <button 
                type="button" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition flex items-center"
                onclick="openSendNotificationModal()"
            >
                <i class="fas fa-paper-plane mr-2"></i> Send Notification
            </button>
        </div>
        
        <!-- Notifications Table -->
        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
            <table class="min-w-full divide-y divide-gray-700">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Message</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Recipient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($notifications as $notification)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium">{{ $notification->judul }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm max-w-xs truncate" title="{{ $notification->pesan }}">{{ $notification->pesan }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm">{{ ucfirst($notification->recipient_type) }}: {{ $notification->recipient_id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm">{{ $notification->created_at->format('M d, Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $notification->sudahDibaca ? 'bg-green-800 text-green-200' : 'bg-yellow-800 text-yellow-200' }}">
                                    {{ $notification->sudahDibaca ? 'Read' : 'Unread' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex space-x-2">
                                    <a href="#" class="text-blue-400 hover:text-blue-300">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="text-red-400 hover:text-red-300" onclick="deleteNotification('{{ $notification->idNotifikasi }}')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-400">
                                No notifications found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
    
    <!-- Send Notification Modal -->
    <div id="sendNotificationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-gray-800 rounded-lg p-6 w-full max-w-md mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Send Notification</h3>
                <button onclick="closeSendNotificationModal()" class="text-gray-400 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="sendNotificationForm">
                <div class="mb-4">
                    <label for="notificationTitle" class="block text-gray-300 mb-2">Title</label>
                    <input 
                        type="text" 
                        id="notificationTitle" 
                        placeholder="Enter notification title"
                        class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>
                
                <div class="mb-4">
                    <label for="notificationMessage" class="block text-gray-300 mb-2">Message</label>
                    <textarea 
                        id="notificationMessage" 
                        rows="3"
                        placeholder="Enter notification message"
                        class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    ></textarea>
                </div>
                
                <div class="mb-4">
                    <label for="recipientType" class="block text-gray-300 mb-2">Recipient Type</label>
                    <select 
                        id="recipientType" 
                        class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                
                <div class="mb-6">
                    <label for="recipientId" class="block text-gray-300 mb-2">Recipient ID</label>
                    <input 
                        type="text" 
                        id="recipientId" 
                        placeholder="Enter recipient ID"
                        class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button 
                        type="button" 
                        onclick="closeSendNotificationModal()" 
                        class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded transition"
                    >
                        Cancel
                    </button>
                    <button 
                        type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition"
                    >
                        Send Notification
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function openSendNotificationModal() {
            document.getElementById('sendNotificationModal').classList.remove('hidden');
        }
        
        function closeSendNotificationModal() {
            document.getElementById('sendNotificationModal').classList.add('hidden');
        }
        
        document.getElementById('sendNotificationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const title = document.getElementById('notificationTitle').value;
            const message = document.getElementById('notificationMessage').value;
            const recipientType = document.getElementById('recipientType').value;
            const recipientId = document.getElementById('recipientId').value;
            
            // In a real implementation, you would make an AJAX call to send the notification
            console.log('Sending notification:', { title, message, recipientType, recipientId });
            
            // Close modal and refresh
            closeSendNotificationModal();
            alert('Notification sent successfully!');
        });
        
        function deleteNotification(id) {
            if (confirm('Are you sure you want to delete this notification?')) {
                // In a real implementation, you would make an AJAX call to delete the notification
                console.log('Deleting notification with ID: ' + id);
            }
        }
    </script>
</body>
</html>