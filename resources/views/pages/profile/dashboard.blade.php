<!-- filepath: /home/sgouzi/prj/hdmarketing/resources/views/profile/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <x-layout.nav :isHome="false" />

    <!-- In your dashboard.blade.php -->
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <x-layout-sidebar />

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation with Toggle Button -->
            <header class="bg-white shadow-sm">
                <div class="px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <!-- Toggle Sidebar Button (visible on mobile) -->
                        <button id="sidebar-toggle-btn" class="md:hidden p-2 rounded-md text-gray-500 hover:text-gray-600 focus:outline-none">
                            <i class="fas fa-bars"></i>
                        </button>
                        
                        <!-- Toggle Sidebar Button (visible on desktop) -->
                        <button id="sidebar-toggle-desktop" class="hidden md:flex p-2 rounded-md text-gray-500 hover:text-gray-600 focus:outline-none">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="mr-4 text-xl font-bold text-gray-900">لوحة التحكم</h1>
                    </div>
                    <!-- Add your header content here -->
                </div>
            </header>
            
            <!-- Content here -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Your dashboard content -->
            </main>
        </div>
    </div>

    <script>
        // Wait for the DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            const profileImg = document.getElementById('profile-img');
            const profileName = document.getElementById('profile-name');
            const profileRole = document.getElementById('profile-role');
            
            const sidebar = document.getElementById('sidebar');
            const sidebarToggleBtn = document.getElementById('sidebar-toggle-btn');
            const sidebarToggleDesktop = document.getElementById('sidebar-toggle-desktop');
            const overlay = document.getElementById('sidebar-overlay');
            
            // Initially hide sidebar on mobile
            if (window.innerWidth < 768) {
                sidebar.classList.add('translate-x-full');
            }

            // Function to toggle sidebar on mobile
            function toggleSidebar() {
                // Toggle sidebar visibility
                sidebar.classList.toggle('translate-x-full');
                
                // Toggle overlay visibility
                if (sidebar.classList.contains('translate-x-full')) {
                    overlay.classList.remove('opacity-50');
                    overlay.classList.add('opacity-0');
                    overlay.classList.add('pointer-events-none');
                } else {
                    overlay.classList.add('opacity-50');
                    overlay.classList.remove('opacity-0');
                    overlay.classList.remove('pointer-events-none');
                }
            }

            // Mobile toggle button click event
            if (sidebarToggleBtn) {
                sidebarToggleBtn.addEventListener('click', toggleSidebar);
            }
            
            // Desktop toggle button click event
            if (sidebarToggleDesktop) {
                sidebarToggleDesktop.addEventListener('click', function() {
                    sidebar.classList.toggle('w-64');
                    sidebar.classList.toggle('w-20');
                    
                    // Hide profile image and name when collapsed
                    profileImg.classList.toggle('hidden');
                    profileName.classList.toggle('hidden');
                    
                    // Make role text smaller when collapsed
                    profileRole.classList.toggle('text-[10px]');
                    profileRole.classList.toggle('whitespace-nowrap');
                    profileRole.classList.toggle('-rotate-90');
                    profileRole.classList.toggle('absolute');
                    profileRole.classList.toggle('bottom-10');
                    
                    // Toggle visibility of text elements in menu items
                    const textElements = sidebar.querySelectorAll('span:not(.flex)');
                    textElements.forEach(el => {
                        el.classList.toggle('hidden');
                    });
                    
                    // Adjust icon alignment when collapsed
                    const iconElements = sidebar.querySelectorAll('i');
                    iconElements.forEach(el => {
                        el.classList.toggle('ml-0');
                        el.classList.toggle('ml-2');
                    });
                });
            }
            
            // Close sidebar when clicking overlay
            if (overlay) {
                overlay.addEventListener('click', function() {
                    if (!sidebar.classList.contains('translate-x-full')) {
                        toggleSidebar();
                    }
                });
            }
            
            // Close sidebar on window resize (if mobile)
            window.addEventListener('resize', function() {
                if (window.innerWidth < 768) {
                    sidebar.classList.add('translate-x-full');
                    overlay.classList.remove('opacity-50');
                    overlay.classList.add('opacity-0');
                    overlay.classList.add('pointer-events-none');
                } else {
                    sidebar.classList.remove('translate-x-full');
                }
            });
        });
    </script>
</body>
</html>