<!-- filepath: /home/sgouzi/prj/hdmarketing/resources/views/components/scripts/sidebar-script.blade.php -->
<script>
    // This script should be included once in your layout
    (function() {
        // Wait for DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Function to toggle sidebar
            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                
                if (!sidebar) return;
                
                const isHidden = sidebar.classList.contains('translate-x-full');
                
                if (isHidden) {
                    // Open sidebar
                    sidebar.classList.remove('translate-x-full');
                    if (overlay) {
                        overlay.classList.add('opacity-50');
                        overlay.classList.remove('pointer-events-none');
                    }
                    document.body.style.overflow = 'hidden';
                } else {
                    // Close sidebar
                    sidebar.classList.add('translate-x-full');
                    if (overlay) {
                        overlay.classList.remove('opacity-50');
                        overlay.classList.add('pointer-events-none');
                    }
                    document.body.style.overflow = '';
                }
            }
            
            // Add click event to document to handle all possible sidebar toggle elements
            document.addEventListener('click', function(event) {
                // Open sidebar when clicking the toggle button
                if (event.target.closest('#sidebar-toggle-btn')) {
                    toggleSidebar();
                }
                
                // Close sidebar when clicking the close button
                if (event.target.closest('#close-sidebar-btn')) {
                    toggleSidebar();
                }
                
                // Close sidebar when clicking the overlay
                if (event.target.id === 'sidebar-overlay') {
                    toggleSidebar();
                }
            });
            
            // Handle mobile search toggle
            const searchToggle = document.getElementById('mobile-search-toggle');
            const searchBar = document.getElementById('mobile-search-bar');
            
            if (searchToggle && searchBar) {
                searchToggle.addEventListener('click', function() {
                    searchBar.classList.toggle('hidden');
                });
            }
            
            // Close sidebar on window resize (if it's a small screen and sidebar is open)
            window.addEventListener('resize', function() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                
                if (window.innerWidth >= 768 && sidebar && !sidebar.classList.contains('translate-x-full')) {
                    sidebar.classList.add('translate-x-full');
                    if (overlay) {
                        overlay.classList.remove('opacity-50');
                        overlay.classList.add('pointer-events-none');
                    }
                    document.body.style.overflow = '';
                }
            });
        });
    })();
</script>