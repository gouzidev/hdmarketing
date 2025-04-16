<!DOCTYPE html>
    <html lang="ar" dir="rtl">
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
        <x-nav :isHome="false"/>
        <x-profile.edit-form :user='$user' />
        <script src="{{ asset('js/profile/edit.js') }}"></script>
    </body>
</html>
