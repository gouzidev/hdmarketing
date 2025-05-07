<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hamburgerButton = document.getElementById('hamburger-button');
        const navMenu = document.getElementById('nav-menu');
        
        hamburgerButton.addEventListener('click', () => {
            navMenu.classList.toggle('translate-x-full');
            navMenu.classList.toggle('translate-x-0');
        });
        
        // Close menu when clicking on a link (for mobile)
        document.querySelectorAll('#nav-menu a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    navMenu.classList.add('translate-x-full');
                    navMenu.classList.remove('translate-x-0');
                }
            });
        });
    });
</script>