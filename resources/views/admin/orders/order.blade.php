<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل الطلب</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">
    <!-- Navigation -->
    <x-nav :isHome="false" />

    <!-- Page Heading -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center space-y-3 md:space-y-0">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-shopping-bag text-indigo-600 ml-2"></i>
                        تفاصيل الطلب #{{ $order->id }}
                    </h1>
                    <div class="flex items-center mt-2 space-x-2 space-x-reverse">
                        <i class="far fa-clock text-gray-500"></i>
                        <span class="text-sm text-gray-500">
                            {{ $order->created_at->format('d M Y - h:i A') }}
                        </span>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            @if($order->status == 'completed') bg-green-100 text-green-800
                            @elseif($order->status == 'shipped') bg-blue-100 text-blue-800
                            @elseif($order->status == 'processing') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ __($order->status) }}
                        </span>
                    </div>
                </div>
                <div class="flex space-x-3 space-x-reverse">
                    <button class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-150 flex items-center shadow-sm">
                        <i class="fas fa-print ml-2 text-gray-600"></i> طباعة
                    </button>
                    <button class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-md text-sm font-medium hover:from-indigo-700 hover:to-indigo-800 transition duration-150 flex items-center shadow-sm">
                        <i class="fas fa-pen ml-2"></i> تعديل الطلب
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Breadcrumbs -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
        <nav class="flex items-center text-sm text-gray-500">
            <a href="#" class="hover:text-indigo-600">الرئيسية</a>
            <i class="fas fa-chevron-left mx-2 text-xs"></i>
            <a href="#" class="hover:text-indigo-600">الطلبات</a>
            <i class="fas fa-chevron-left mx-2 text-xs"></i>
            <span class="text-gray-900">تفاصيل الطلب #{{ $order->id }}</span>
        </nav>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Order Summary -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Order Items -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 bg-gradient-to-l from-indigo-50 to-white">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                            <i class="fas fa-box-open text-indigo-600 ml-2"></i>
                            المنتجات
                        </h3>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <div class="px-4 py-5 sm:px-6 flex justify-between items-start hover:bg-gray-50 transition duration-150">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-20 w-20 rounded-md overflow-hidden border border-gray-200">
                                    <img src="{{ route('products.thumbnail', $order->product) }}" alt="{{ $order->product->name }}" class="h-full w-full object-cover">
                                </div>
                                <div class="mr-4">
                                    <a href="{{ route( 'products.product', $order->product )}}">
                                        <h4 class="text-md font-medium text-gray-900 hover:text-indigo-600 cursor-pointer transition duration-150">{{ $order->product->name }}</h4>
                                    </a>
                                    <p class="text-sm text-gray-500 mt-1 flex items-center">
                                        {{ $order->product->category_name }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right gap-5 justify-center items-center flex flex-row">
                                    <i class="fas fa-cubes text-indigo-400"></i>
                                    الكمية: {{ $order->quantity }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping & Payment -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Shipping Info -->
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200 bg-gradient-to-l from-blue-50 to-white">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                <i class="fas fa-shipping-fast text-blue-600 ml-2"></i>
                                معلومات الشحن
                            </h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <h4 class="text-sm font-medium text-gray-500">
                                        <i class="fas fa-spinner text-blue-500 ml-1"></i>
                                        حالة الشحن
                                    </h4>
                                    <p class="mt-1 text-sm text-gray-900 pr-5">
                                        @if($order->shipping_status == 'delivered')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full  bg-green-100 text-green-800">
                                                وصل
                                            </span>
                                        @elseif($order->shipping_status == 'shipped')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full  bg-blue-100 text-blue-800">
                                                تم الشحن
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full  bg-yellow-100 text-yellow-800">
                                                قيد الشحن	
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                <div class="flex flex-col gap-5">
                                    <h4 class="text-sm font-medium text-gray-500 flex items-center">
                                        <i class="fas fa-map-marker-alt text-blue-500 ml-1"></i>
                                        عنوان الشحن
                                    </h4>
                                    <div class=" flex flex-col gap-2 mt-1 text-sm text-gray-900 space-y-1">
                                        <div class="flex flex-row justify-between">
                                            <span class="">
                                                الدولة
                                            </span>
                                            <p>{{ $order->shipping->country }}</p>
                                        </div>
                                        <div class="flex flex-row justify-between">
                                            <span class="">
                                                المدينة
                                            </span>
                                            <p>{{ $order->shipping->city }}</p>
                                        </div>
                                        <div class="flex flex-row justify-between">
                                            <span class="">
                                                الشارع
                                            </span>
                                            <p>{{ $order->shipping->street }}</p>
                                        </div>
                                        <div class="flex justify-between p-2 bg-purple-50 rounded-md">
                                            <span class="text-base font-medium text-gray-900 flex items-center">
                                                <i class="fas fa-money-bill-wave text-purple-600 ml-2"></i>
                                                سعر
                                            </span>
                                            <span class="text-base font-bold text-purple-700">${{ $order->shipping->price }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Info -->
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200 bg-gradient-to-l from-green-50 to-white">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                <i class="fas fa-credit-card text-green-600 ml-2"></i>
                                معلومات الدفع
                            </h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <div class="space-y-4">
                                <div class="flex flex-row gap-5">
                                    <h4 class="text-sm font-medium text-gray-500 flex items-center">
                                        <i class="fas fa-receipt text-green-500 ml-1"></i>
                                        حالة الدفع
                                    </h4>
                                    <p class="mt-1 text-sm text-gray-900">
                                        @if($order->payment_status == 'paid')
                                            <div class="flex flex-col">
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full  bg-green-100 text-green-800">
                                                    تم الدفع
                                                </span>
                                                <i class="fas fa-calendar-check text-green-500 ml-1"></i>
                                                    تاريخ الدفع 
                                                <span class="">
                                                    {{ $order->payment_date->format('d M Y - h:i A') }}
                                                </span>
                                            </div>
                                       @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full  bg-yellow-100 text-yellow-800">
                                                قيد الدفع	
                                            </span>
                                        @endif


                                    </p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 flex items-center">
                                        <i class="fas fa-envelope text-green-500 ml-1"></i>
                                        البريد الإلكتروني
                                    </h4>
                                    <p class="mt-1 text-sm text-gray-900 pr-5">{{ $order->email }}</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 flex items-center">
                                        <i class="fas fa-phone-alt text-green-500 ml-1"></i>
                                        رقم الهاتف
                                    </h4>
                                    <p class="mt-1 text-sm text-gray-900 pr-5 flex items-center">
                                        <span class="inline-block px-2 py-1 bg-green-50 rounded-full mr-2">
                                            <i class="fas fa-phone-alt text-green-500"></i>
                                        </span>
                                        {{ $order->phone }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Totals -->
            <div class="space-y-6">
                <!-- Order Summary -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 bg-gradient-to-l from-purple-50 to-white">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                            <i class="fas fa-file-invoice-dollar text-purple-600 ml-2"></i>
                            ملخص الطلب
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="space-y-3">
                            <div class="flex justify-between items-center p-2 hover:bg-gray-50 rounded-md transition duration-150">
                                <span class="text-sm text-gray-500 flex items-center">
                                    <i class="fas fa-shopping-cart text-purple-400 ml-2"></i>
                                    ثمن المنتج
                                </span>
                                <span class="text-sm font-medium">${{ number_format($order->product->price, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center p-2 hover:bg-gray-50 rounded-md transition duration-150">
                                <span class="text-sm text-gray-500 flex items-center">
                                    <i class="fas fa-shopping-cart text-purple-400 ml-2"></i>
                                    ثمن المسوق
                                </span>
                                <span class="text-sm font-medium">${{ number_format($order->affiliate_price, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center p-2 hover:bg-gray-50 rounded-md transition duration-150">
                                <span class="text-sm text-gray-500 flex items-center">
                                    <i class="fas fa-truck text-purple-400 ml-2"></i>
                                    ثمن الشحن
                                </span>
                                <span class="text-sm font-medium">${{ number_format($order->shipping->price, 2) }}</span>
                            </div>
                            <div class="border-t border-gray-200 pt-3 mt-3">
                                <div class="flex justify-between p-2 bg-purple-50 rounded-md">
                                    <span class="text-base font-medium text-gray-900 flex items-center">
                                        <i class="fas fa-money-bill-wave text-purple-600 ml-2"></i>
                                        المجموع
                                    </span>
                                    <span class="text-base font-bold text-purple-700">${{ $order->total() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer Notes -->
                @if($order->notes)
                <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 bg-gradient-to-l from-yellow-50 to-white">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                            <i class="fas fa-sticky-note text-yellow-600 ml-2"></i>
                            ملاحظات العميل
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6 bg-yellow-50 bg-opacity-30">
                        <div class="flex">
                            <i class="fas fa-quote-right text-yellow-400 ml-2 mt-1"></i>
                            <p class="text-sm text-gray-700">{{ $order->notes }}</p>
                            <i class="fas fa-quote-left text-yellow-400 mr-2 mt-auto"></i>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Order Actions -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 bg-gradient-to-l from-indigo-50 to-white">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                            <i class="fas fa-tasks text-indigo-600 ml-2"></i>
                            إجراءات الطلب
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6 space-y-4">
                        @if($order->status != 'completed')
                        <button class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 transition duration-150">
                            <i class="fas fa-check-circle ml-2"></i> تم الإكمال
                        </button>
                        @endif
                        
                        @if($order->shipping_status != 'shipped' && $order->shipping_status != 'delivered')
                        <button class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 transition duration-150">
                            <i class="fas fa-truck ml-2"></i> تم الشحن
                        </button>
                        @endif
                        
                        @if($order->payment_status != 'paid')
                        <button class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 transition duration-150">
                            <i class="fas fa-credit-card ml-2"></i> تم الدفع
                        </button>
                        @endif
                        
                        <button class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-150">
                            <i class="fas fa-envelope ml-2"></i> إرسال بريد
                        </button>
                    </div>
                </div>

                <!-- Customer Info -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 bg-gradient-to-l from-teal-50 to-white">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                            <i class="fas fa-user-circle text-teal-600 ml-2"></i>
                            معلومات العميل
                        </h3>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center p-2 hover:bg-gray-50 rounded-md transition duration-150 mb-2">
                            <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center mr-3">
                                <i class="fas fa-user text-teal-600"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">{{ $order->name }}</h4>
                                <p class="text-xs text-gray-500">عميل</p>
                            </div>
                        </div>
                        <div class="space-y-2 mt-3">
                            <a href="mailto:{{ $order->email }}" class="flex items-center p-2 hover:bg-gray-50 rounded-md transition duration-150 text-sm text-gray-700">
                                <i class="fas fa-envelope text-teal-500 ml-2 w-5 text-center"></i>
                                {{ $order->email }}
                            </a>
                            <a href="tel:{{ $order->phone }}" class="flex items-center p-2 hover:bg-gray-50 rounded-md transition duration-150 text-sm text-gray-700">
                                <i class="fas fa-phone-alt text-teal-500 ml-2 w-5 text-center"></i>
                                {{ $order->phone }}
                            </a>
                            <div class="flex items-center p-2 hover:bg-gray-50 rounded-md transition duration-150 text-sm text-gray-700">
                                <i class="fas fa-map-marker-alt text-teal-500 ml-2 w-5 text-center"></i>
                                {{ $order->city }}، {{ $order->country }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Order Timeline -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 mb-10">
        <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200 bg-gradient-to-l from-gray-50 to-white">
                <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                    <i class="fas fa-history text-gray-600 ml-2"></i>
                    سجل الطلب
                </h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <div class="flow-root">
                    <ul class="-mb-8">
                        <li>
                            <div class="relative pb-8">
                                <span class="absolute top-4 right-4 -mr-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                <div class="relative flex space-x-3 space-x-reverse">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                            <i class="fas fa-shopping-cart text-white"></i>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4 space-x-reverse">
                                        <div>
                                            <p class="text-sm text-gray-900">تم إنشاء الطلب</p>
                                        </div>
                                        <div class="text-left text-sm whitespace-nowrap text-gray-500">
                                            <time datetime="{{ $order->created_at->format('Y-m-d') }}">{{ $order->created_at->format('d M Y') }}</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="relative pb-8">
                                <span class="absolute top-4 right-4 -mr-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                <div class="relative flex space-x-3 space-x-reverse">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                            <i class="fas fa-check text-white"></i>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4 space-x-reverse">
                                        <div>
                                            <p class="text-sm text-gray-900">تم قبول الطلب</p>
                                        </div>
                                        <div class="text-left text-sm whitespace-nowrap text-gray-500">
                                            <time datetime="{{ $order->created_at->addMinutes(30)->format('Y-m-d') }}">{{ $order->created_at->addMinutes(30)->format('d M Y') }}</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="relative">
                                <div class="relative flex space-x-3 space-x-reverse">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                                            <i class="fas fa-truck text-white"></i>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4 space-x-reverse">
                                        <div>
                                            <p class="text-sm text-gray-500">في انتظار الشحن</p>
                                        </div>
                                        <div class="text-left text-sm whitespace-nowrap text-gray-500">
                                            قريباً
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>