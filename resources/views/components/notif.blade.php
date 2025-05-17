@props([
    'duration' => 3000,
    'containerClass' => 'fixed top-0 inset-x-0 z-50'
])

<div>
    @if(session('success'))
    <div id="notification-success" class="{{ $containerClass }} py-4 px-6 bg-green-100 text-green-800 border-b-1 border-green-500 shadow-md overflow-hidden">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 text-xl ml-3"></i>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
            <button onclick="closeNotification('success')" class="text-green-500 hover:text-green-700 focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <!-- Loading Line Animation -->
        <div class="absolute bottom-0 right-0 left-0 h-2 bg-green-200">
            <div class="h-full bg-green-500 animation-countdown"></div>
        </div>
    </div>
    @endif

    @if(session('error') || $errors->any())
    <div id="notification-error" class="{{ $containerClass }} py-4 px-6 bg-red-100 text-red-800 border-b-2 border-red-500 shadow-md overflow-hidden">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-red-500 text-xl ml-3"></i>
                <p class="font-medium">
                    {{ session('error') ?? $errors->first() ?? 'حدث خطأ ما' }}
                </p>
            </div>
            <button onclick="closeNotification('error')" class="text-red-500 hover:text-red-700 focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <!-- Loading Line Animation -->
        <div class="absolute bottom-0 right-0 left-0 h-1 bg-red-200">
            <div class="h-full bg-red-500 animation-countdown"></div>
        </div>
    </div>
    @endif

    <style>
        .animation-countdown {
            width: 100%;
            transform-origin: right;
            animation: countdown {{ $duration / 1000 }}s linear forwards;
        }
        
        @keyframes countdown {
            from {
                transform: scaleX(1);
            }
            to {
                transform: scaleX(0);
            }
        }
        
        .fade-out {
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 300ms, transform 300ms;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set notification timers
            if (document.getElementById('notification-success')) {
                setTimeout(function() {
                    closeNotification('success');
                }, {{ $duration }});
            }
            
            if (document.getElementById('notification-error')) {
                setTimeout(function() {
                    closeNotification('error');
                }, {{ $duration }});
            }
        });
        
        function closeNotification(type) {
            const notif = document.getElementById('notification-' + type);
            if (notif) {
                notif.classList.add('fade-out');
                setTimeout(() => {
                    notif.style.display = 'none';
                }, 300);
            }
        }
    </script>
</div>

<script>
    // Global notification function
    window.showNotification = function(message, type = 'success', duration = {{ $duration }}) {
        // Remove existing notification of same type if present
        let existingNotif = document.getElementById('notification-' + type);
        if (existingNotif) {
            existingNotif.remove();
        }
        
        // Create new notification
        const notif = document.createElement('div');
        notif.id = 'notification-' + type;
        notif.className = '{{ $containerClass }} py-4 px-6 shadow-md overflow-hidden';
        
        if (type === 'success') {
            notif.classList.add('bg-green-100', 'text-green-800', 'border-b-4', 'border-green-500');
        } else {
            notif.classList.add('bg-red-100', 'text-red-800', 'border-b-4', 'border-red-500');
        }
        
        // Build notification content
        notif.innerHTML = `
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle text-${type === 'success' ? 'green' : 'red'}-500 text-xl ml-3"></i>
                    <p class="font-medium">${message}</p>
                </div>
                <button onclick="closeNotification('${type}')" class="text-${type === 'success' ? 'green' : 'red'}-500 hover:text-${type === 'success' ? 'green' : 'red'}-700 focus:outline-none">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="absolute bottom-0 right-0 left-0 h-1 bg-${type === 'success' ? 'green' : 'red'}-200">
                <div class="h-full bg-${type === 'success' ? 'green' : 'red'}-500 animation-countdown"></div>
            </div>
        `;
        
        // Add to document
        document.body.appendChild(notif);
        
        // Set auto-close timeout
        setTimeout(function() {
            closeNotification(type);
        }, duration);
    };
</script>