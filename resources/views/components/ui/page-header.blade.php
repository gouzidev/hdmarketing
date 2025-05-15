<!-- filepath: /home/sgouzi/prj/hdmarketing/resources/views/components/ui/page-header.blade.php -->
<div class="flex flex-col overflow-hidden">
    <!-- Top Navigation with Toggle Button -->
    <header class="bg-gradient-to-l">
        <div class="px-6 py-4 flex items-center justify-between">
            <div class="flex items-center">
                <!-- Toggle Sidebar Button (visible ONLY on desktop) -->
                <button id="sidebar-toggle-desktop" class="hidden md:flex p-2 rounded-md text-gray-500 hover:text-gray-600 focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="mr-4 text-xl font-bold text-gray-900">
                    {{ $headerText }}
                </h1>
            </div>
            <!-- Add your header content here -->
        </div>
    </header>
</div>