<!DOCTYPE html>
    <html lang="ar" dir="rtl">
    <head dir="rtl">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>hdmarketing</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Configure Tailwind -->
        <x-scripts.fonts-import />
        <x-scripts.tailwind-script />
        </head>
    
    <body class=" overflow-x-hidden relative">
        <x-layout.nav :isHome="true"/>
        <x-home.cover-img />
        <x-home.hero />
        <x-home.services />
        <x-home.hero2 />
        <x-home.hero3 />
        <x-home.faq />
        <x-home.statistics />
        <x-scripts.nav-script />
        <x-scripts.fqa-script />
    </body>

</html>
