<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head dir="rtl">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        
        <script src="https://cdn.tailwindcss.com"></script>
    
        <!-- Configure Tailwind -->
        <script>
            tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'kufi': ['"Noto Kufi Arabic"', 'sans-serif'],
                        'sans': ['"Noto Sans Arabic"', 'sans-serif'],
                    },
                }
            },
            corePlugins: {
                cursor: true // Ensure cursor utilities are enabled
            }
        }
        </script>
        <link rel="stylesheet" href="{{ asset('css/app.css')}}" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&display=swap" rel="stylesheet">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@100..900&display=swap" rel="stylesheet">
        </head>
    <body class=" overflow-x-hidden relative">
        <x-nav />
        <x-cover-img />
        <x-hero />
        <x-services />
    </body>

</html>
