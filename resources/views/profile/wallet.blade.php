<!DOCTYPE html>
    <html lang="ar" dir="rtl">
    <head dir="rtl">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>hdmarketing</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Configure Tailwind -->
        <x-scripts.tailwind-script />
        <x-scripts.fonts-import />
        <x-imports.fa />
        </head>
    
    <body class=" overflow-x-hidden relative">
        <x-nav :isHome="false"/>
        <x-auth.wallet.statistics />
        <x-auth.wallet.withdrawals />
        <x-scripts.nav-script />
    </body>
</html>
