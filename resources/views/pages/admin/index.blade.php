<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المستخدمين</title>
    <x-scripts.fonts-import />
    <x-scripts.index />

</head>
<body class="font-sans antialiased bg-gray-50">
    <x-layout.nav :isHome='false'/>
    <div class="min-h-screen">
        <!-- Page Heading -->
        <x-layout.header :headerText="'إدارة المستخدمين'" :icon="'fas fa-users'" />
        <!-- Delete Confirmation Modal -->
        <x-admin.delete-modal />
        <!-- Page Content -->
        <x-admin.users-data :users="$users" :search="$search"/>
    </div>
    <x-admin.delete-modal-script />
</body>
</html>