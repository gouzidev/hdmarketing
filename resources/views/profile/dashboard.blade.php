<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head dir="rtl">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>hdmarketing</title>
    <script src="https://cdn.tailwindcss.com"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-scripts.tailwind-script />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <x-scripts.fonts-import />
</head>

<body class="overflow-x-hidden relative">
    <x-nav :isHome="false"/>

    {{-- @if (!auth()->user()->is_admin)
        @if ($hasPendingRequest)
            <div class="mb-4 p-4 bg-blue-50 border border-blue-200 text-blue-700 rounded-lg">
                لديك طلب صلاحيات مدير قيد المراجعة
            </div>
        @else
            <form action="{{ route('request-admin', auth()->user()->id) }}" method="POST" class="mb-4">
                @csrf
                <button type="submit"
                    class="py-3 px-6 bg-yellow-500 hover:bg-yellow-700 text-white rounded-lg transition-colors font-medium text-lg">
                    <i class="fas fa-user-shield ml-2"></i> طلب صلاحيات مدير
                </button>
            </form>
        @endif
    @endif --}}
    
    @if (session('error'))
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
    @elseif (session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (auth()->user()->is_admin)
    <a href="{{ route('admin.shipping.index') }}">
        التحكم في خيارات الشحن
    </a>
    @endif

    
    <x-scripts.nav-script />
</body>
</html>