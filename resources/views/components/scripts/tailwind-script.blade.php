<script>
    /** @type {import('tailwindcss').Config} */
    tailwind.config = {
    theme: {
        extend: {
            fontFamily: {
                'kufi': ['"Noto Kufi Arabic"', 'sans-serif'],
                'sans': ['"Noto Sans Arabic"', 'sans-serif'],
                'tajawal': ['"Tajawal"', 'sans-serif'],
            },
            colors: {
                'body-bg': '#eeeeff'
            },
            backgroundImage: {
                'dot-pat': "radial-gradient(circle, #3b83f623 1px, transparent 1px)"
            },
            backgroundSize: {
                'dot-pat': '30px 30px'
            }
        }
    },
    corePlugins: {
        cursor: true // Ensure cursor utilities are enabled
    }
}
</script>