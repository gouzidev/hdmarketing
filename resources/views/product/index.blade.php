<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المستخدمين</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <x-tailwind-script />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <x-fonts-import />
</head>
<body class="font-sans antialiased bg-gray-50">
    <x-nav :isHome='false'/>
    <div class="min-h-screen">
        <!-- Page Heading -->
        <header class="bg-yellow-200 shadow">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight py-6 px-4 sm:px-6 lg:px-8 text-right">
                المنتجات
            </h2>
            @if (auth()->user()->is_admin)
                <a href="{{ route('admin.products.create') }}" ><button class="" >إضافة منتج جديد</button></a>
            @endif
        </header>

        <!-- Delete Confirmation Modal -->
            @foreach ($products as $product)
                {{ $product }}
            @endforeach
    </div>

    
</body>
</html>