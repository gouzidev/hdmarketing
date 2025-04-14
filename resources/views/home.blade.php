<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head dir="rtl">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>hdmarketing</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Configure Tailwind -->
        <x-tailwind-script />
        <x-fonts-import />
        </head>
    
    <body class=" overflow-x-hidden relative">
        <x-nav :isHome="true"/>
        <x-cover-img />
        <x-hero />
        <x-services />
    </body>

</html>
