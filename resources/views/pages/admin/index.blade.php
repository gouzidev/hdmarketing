<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المستخدمين</title>
    <script src="https://cdn.tailwindcss.com"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-scripts.tailwind-script />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <x-scripts.fonts-import />
</head>
<body class="font-sans antialiased bg-gray-50">
    <x-layout.nav :isHome='false'/>
    <div class="min-h-screen">
        <!-- Page Heading -->
        <header class="bg-yellow-200 shadow">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight py-6 px-4 sm:px-6 lg:px-8 text-right">
                إدارة المستخدمين
            </h2>
        </header>
        <!-- Delete Confirmation Modal -->
        <x-admin.delete-modal />
        <!-- Page Content -->
        <x-admin.users-data :users="$users" :search="$search"/>
    </div>
    <x-admin.delete-modal-script />
</body>
</html>