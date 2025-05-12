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
                            @if($order->status == 'completed') مكتمل
                            @elseif($order->status == 'shipped') تم الشحن
                            @elseif($order->status == 'processing') قيد المعالجة
                            @else قيد الانتظار @endif
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
    <div class="sm:max-w-[90%] w-full mx-auto px-4 sm:px-0 lg:px-0 py-2">
        <nav class="flex items-center text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-indigo-600">الرئيسية</a>
            <i class="fas fa-chevron-left mx-2 text-xs"></i>
            <a href="{{ route('orders') }}" class="hover:text-indigo-600">الطلبات</a>
            <i class="fas fa-chevron-left mx-2 text-xs"></i>
            <span class="text-gray-900">تفاصيل الطلب #{{ $order->id }}</span>
        </nav>
    </div>

    {{-- bg-purple-100 sm:bg-red-100 md:bg-orange-100 lg:bg-yellow-100 xl:bg-green-100 --}}
    <!-- Main Content -->
    <main class=" sm:max-w-[90%] w-full mx-auto py-6 sm:px-0 lg:px-0">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Left Column - Order Items and Info Cards -->
            <div class="lg:col-span-3 space-y-6">
                <!-- Order Items -->
                <div class="col-span-1  bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
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
                
                {{-- errors --}}
                @if($errors->any())
                <div class="w-full mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <h3 class="text-red-700 font-medium mb-2">يوجد أخطاء :</h3>
                    <ul class="text-red-600 list-disc pr-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @elseif (session('success'))
                    <div class="w-full mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Info Cards Grid -->
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
                                        <div class="flex flex-row justify-between mx-2">
                                            <span class="">
                                                الدولة
                                            </span>
                                            <p>{{ $order->shipping->getCountryCode() }}</p>
                                        </div>
                                        <div class="flex flex-row justify-between mx-2">
                                            <span class="">
                                                المدينة
                                            </span>
                                            <p>{{ $order->shipping->city }}</p>
                                        </div>
                                        <div class="flex flex-row justify-between mx-2">
                                            <span class="">
                                                الشارع
                                            </span>
                                            <p>{{ $order->shipping->street }}</p>
                                        </div>
                                        <div class="flex justify-between p-2 bg-blue-50 rounded-md">
                                            <span class="text-base font-medium text-gray-900 flex items-center">
                                                <i class="fas fa-money-bill-wave text-blue-600 ml-2"></i>
                                                <span class="text-blue-950">سعر</span>
                                            </span>
                                            <span class="text-base font-bold text-blue-700">${{ $order->shipping->price }}</span>
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
                                <div class="flex flex-row gap-5 mx-2">
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
                                <div class="flex flex-row justify-between items-center mx-2">
                                    <h4 class="text-sm font-medium text-gray-500 flex items-center">
                                        <i class="fas fa-envelope text-green-500 ml-1"></i>
                                        البريد الإلكتروني
                                    </h4>
                                    <p class="mt-1 text-sm text-gray-900 pr-5">{{ $order->email }}</p>
                                </div>
                                <div class="flex flex-row justify-between items-center py-1 bg-green-50 rounded-full p-2">
                                    <h4 class="text-sm font-medium text-gray-500 flex items-center">
                                        <i class="fas fa-phone-alt text-green-500 ml-1"></i>
                                        رقم الهاتف
                                    </h4>
                                    <p class="mt-1 text-sm text-gray-900 pr-5 flex items-center">
                                        <span class="">
                                            {{ $order->phone }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Info -->
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200 bg-gradient-to-l from-green-50 to-white">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                <i class="fas fa-user-circle text-green-600 ml-2"></i>
                                معلومات الزبون
                            </h3>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center p-2 hover:bg-gray-50 rounded-md transition duration-150 mb-2 gap-2">
                                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-1">
                                    <i class="fas fa-user text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">{{ $order->name }}</h4>
                                    <p class="text-xs text-gray-500">زبون</p>
                                </div>
                            </div>
                            <div class="space-y-2 mt-3">
                                <a href="mailto:{{ $order->email }}" class="flex items-center p-2 hover:bg-gray-50 rounded-md transition duration-150 text-sm text-gray-700">
                                    <i class="fas fa-envelope text-green-500 ml-2 w-5 text-center"></i>
                                    {{ $order->email }}
                                </a>
                                <a href="tel:{{ $order->phone }}" class="flex items-center p-2 hover:bg-gray-50 rounded-md transition duration-150 text-sm text-gray-700">
                                    <i class="fas fa-phone-alt text-green-500 ml-2 w-5 text-center"></i>
                                    {{ $order->phone }}
                                </a>
                                <div class="flex items-center p-2 hover:bg-gray-50 rounded-md transition duration-150 text-sm text-gray-700">
                                    <i class="fas fa-map-marker-alt text-green-500 ml-2 w-5 text-center"></i>
                                    {{ $order->shipping->getCountryCode() }}، {{ $order->shipping->city }}
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Affiliate Info -->
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200 bg-gradient-to-l from-teal-50 to-white">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center gap-5">
                                <i class="fa-solid fa-user-tie text-teal-800"></i>
                                معلومات العميل
                            </h3>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center p-2 hover:bg-gray-50 rounded-md transition duration-150 mb-2 gap-2">
                                <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center mr-1">
                                    <i class="fa-solid fa-user-tie text-teal-800"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">{{ $order->affiliate->name }}</h4>
                                    <p class="text-xs text-gray-500">عميل</p>
                                </div>
                            </div>
                            <div class="space-y-2 mt-3">
                                <a href="mailto:{{ $order->affiliate->email }}" class="flex items-center p-2 hover:bg-gray-50 rounded-md transition duration-150 text-sm text-gray-700">
                                    <i class="fas fa-envelope text-teal-500 ml-2 w-5 text-center"></i>
                                    {{ $order->affiliate->email }}
                                </a>
                                <a href="tel:{{ $order->phone }}" class="flex items-center p-2 hover:bg-gray-50 rounded-md transition duration-150 text-sm text-gray-700">
                                    <i class="fas fa-phone-alt text-teal-500 ml-2 w-5 text-center"></i>
                                    {{ $order->affiliate->phone }}
                                </a>
                                <div class="flex items-center p-2 hover:bg-gray-50 rounded-md transition duration-150 text-sm text-gray-700">
                                    <i class="fas fa-map-marker-alt text-teal-500 ml-2 w-5 text-center"></i>
                                    {{ $order->affiliate->getCountryCode() }}، {{ $order->affiliate->city }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Totals -->
            <div class="col-span-3     grid grid-cols-1 lg:grid-cols-6 gap-6">
                <!-- Order Summary -->
                <div class="col-span-4 bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
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
                                        <span class="text-purple-950">المجموع</span>
                                    </span>
                                    <span class="text-base font-bold text-purple-700">${{ $order->total() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Actions -->
                <div class="col-span-2 bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 bg-gradient-to-l from-indigo-50 to-white">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                            <i class="fas fa-tasks text-indigo-600 ml-2"></i>
                            إجراءات الطلب
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6 space-y-4">
                        <div class="flex flex-row justify-between ">
                            @if($order->status == 'pending')
                                <label for="">الطلب</label>
                                <div class="flex flex-row w-1/2 gap-5">
                                    <form action="{{ route('order.accept', $order) }}" method="POST" class="w-1/2">
                                        @csrf
                                        @method('PUT')
                                        <button class="w-full flex items-center justify-center gap-2 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 transition duration-150">
                                            <i class="fas fa-check-circle "></i> تأكيد الطلب                       
                                        </button>
                                    </form>
                                    <form action="{{ route('order.reject', $order) }}"  method="POST"  class="w-1/2">
                                        @csrf
                                        @method('PUT')
                                        <button class="w-full flex items-center justify-center gap-2 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 transition duration-150">
                                            <i class="fas fa-check-circle "></i> رفض الطلب                       
                                        </button>
                                    </form>
                                </div>
                            @else
                                <label for="">الطلب</label>
                                <div class="flex flex-row-reverse w-1/2 gap-5">
                                    <form action="{{ route('order.destroy', $order) }}" method="post" class="w-full cursor-pointer">
                                        @csrf
                                        @method('DELETE')
                                        <button class="w-full cursor-pointer flex items-center justify-center gap-2 py-2 rounded-md text-sm font-medium  border-4 shadow-sm text-red-800 border-red-800 bg-gradient-to-r bg-red-50 hover:to-red-200 transition duration-150">
                                            <i class="fas fa-x "></i>حذف الطلب 
                                        </button>
                                    </form>

                                    <button class="w-full flex items-center justify-center gap-2 py-2 cursor-default rounded-md text-sm font-medium  border-4 shadow-sm text-green-800 border-green-800 bg-gradient-to-r bg-green-50  hover:to-green-200 transition duration-150 disabled opacity-50">
                                        <i class="fas fa-check-circle "></i> مؤكد
                                    </button>  
                                </div>
                            @endif
                        </div>

                        <div class="flex flex-row justify-between">

                            @if ($order->status == 'accepted')
                                @if($order->shipping_status == 'pending')
                                <label for="">الشحن</label>
                                <div class="flex flex-row w-1/2 gap-5">
                                    <form action="{{ route('order.shipping.shipped', $order) }}" method="post"  class="w-full">
                                        @csrf
                                        @method('PUT')
                                        @if ($order->status == 'accepted')
                                            <button class="w-full flex items-center justify-center gap-2 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 transition duration-150">
                                                <i class="fas fa-truck ml-2"></i> تأكيد الشحن                       
                                            </button>
                                        @else
                                            <button type="button" class="w-full flex items-center justify-center gap-2 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 transition duration-150 opacity-50 cursor-not-allowed disabled">
                                                <i class="fas fa-truck ml-2"></i> تأكيد الشحن                       
                                            </button>
                                        @endif
                                    </form>
                                </div>
                                @elseif ($order->shipping_status == 'shipped')
                                    <label for="">الشحن</label>
                                    <div class="flex flex-row-reverse w-1/2 gap-5">
                                        <form action="{{ route('order.shipping.cancel', $order) }}" method="post"  class="w-full">
                                            @csrf
                                            @method('PUT')
                                            <button class="w-full flex items-center justify-center gap-2 py-2 rounded-md text-sm font-medium  border-4 shadow-sm text-red-800 border-red-800 bg-gradient-to-r bg-red-50 hover:to-red-200 transition duration-150 cursor-pointer">
                                                <i class="fas fa-check-circle "></i> إلغاء
                                            </button>  
                                        </form>
                                        <form action="{{ route('order.shipping.delivered', $order) }}" method="post"  class="w-full">
                                            @csrf
                                            @method('PUT')
                                            <button class="w-full flex items-center justify-center gap-2 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 transition duration-150">
                                                <i class="fas fa-truck ml-2"></i> تأكيد التوصيل
                                            </button>
                                        </form>

                                    </div>
                                @else {{-- delivered --}}
                                    <label for="">الشحن</label>
                                    <div class="flex flex-row-reverse w-1/2 gap-5">
                                        <form action="{{ route('order.shipping.cancel', $order) }}" method="post"  class="w-full">
                                            @csrf
                                            @method('PUT')
                                            <button class="w-full flex items-center justify-center gap-2 py-2 rounded-md text-sm font-medium  border-4 shadow-sm text-red-800 border-red-800 bg-gradient-to-r bg-red-50 hover:to-red-200 transition duration-150 cursor-pointer">
                                                <i class="fas fa-check-circle "></i> إلغاء
                                            </button>  
                                        </form>
                                        <button class="w-full flex items-center justify-center gap-2 py-2 cursor-default rounded-md text-sm font-medium  border-4 shadow-sm text-blue-800 border-blue-800 bg-gradient-to-r bg-blue-50  hover:to-blue-200 transition duration-150  disabled opacity-50">
                                            <i class="fas fa-truck ml-2"></i> مؤكد
                                        </button>  
                                    </div>
                                @endif
                            @else
                                <label for="">الشحن</label>
                                <button type="button" class="w-1/2 flex items-center justify-center gap-2 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 transition duration-150 opacity-50 cursor-not-allowed disabled">
                                    <i class="fas fa-truck ml-2"></i> تأكيد الشحن                       
                                </button>
                            @endif

                        </div>

                        <div class="flex flex-row justify-between">
                            @if($order->payment_status == 'pending')
                                @if ($order->shipping_status == 'delivered')
                                    <label for="">الدفع</label>
                                    <div class="flex flex-row w-1/2 gap-5">
                                        <form action="{{ route('order.payment.paid', $order) }}" method="post" class="w-full">
                                            @method('PUT')
                                            @csrf
                                            <button class="w-full flex items-center justify-center gap-2 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 transition duration-150">
                                                <i class="fas fa-truck ml-2"></i> تأكيد الدفع                       
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <label for="">الدفع</label>
                                    <div class="flex flex-row w-1/2 gap-5">
                                        <button class="w-full flex items-center justify-center gap-2 py-2 border cursor-not-allowed border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 transition duration-150 opacity-50 disabled">
                                            <i class="fas fa-truck ml-2"></i> تأكيد الدفع                       
                                        </button>
                                    </div>
                                @endif
                            @else
                                <label for="">الدفع</label>
                                <div class="flex flex-row-reverse w-1/2 gap-5">
                                    <form action="{{ route('order.payment.unpaid', $order) }}" method="post" class="w-full">
                                        @method('PUT')
                                        @csrf
                                        <button class="w-full flex items-center justify-center gap-2 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 transition duration-150">
                                            <i class="fas fa-check-circle "></i> إلغاء
                                        </button>
                                    </form>
                                    <button class="w-full flex items-center justify-center gap-2 py-2 cursor-default rounded-md text-sm font-medium  border-4 shadow-sm text-purple-800 border-purple-800 bg-gradient-to-r bg-purple-50  hover:to-purple-200 transition duration-150 disabled">
                                        <i class="fas fa-truck ml-2"></i> مؤكد
                                    </button>  
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>



            <!-- Right Column - Order Timeline -->
            <div class="lg:col-span-3">
                <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200 sticky top-6">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 bg-gradient-to-l from-gray-50 to-white">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                            <i class="fas fa-history text-indigo-600 ml-2"></i>
                            سجل الطلب
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6 overflow-y-hidden">
                        <ul>
                            <!-- 1. Order Creation -->
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
                                                <p class="text-sm font-medium text-gray-900">تم إنشاء الطلب</p>
                                                <p class="text-xs text-gray-500 mt-1">تم إنشاء طلب جديد وهو الآن في انتظار المراجعة</p>
                                            </div>
                                            <div class="text-left text-sm whitespace-nowrap text-gray-500">
                                                <time datetime="{{ $order->created_at->format('Y-m-d') }}">{{ $order->created_at->format('d M Y - h:i A') }}</time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <!-- 2. Order Handling -->
                            <li>
                                <div class="relative pb-8">
                                    <span class="absolute top-4 right-4 -mr-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    <div class="relative flex space-x-3 space-x-reverse">
                                        <div>
                                            @if($order->status == 'accepted')
                                                <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                    <i class="fas fa-check text-white"></i>
                                                </span>
                                            @elseif($order->status == 'rejected')
                                                <span class="h-8 w-8 rounded-full bg-red-500 flex items-center justify-center ring-8 ring-white">
                                                    <i class="fas fa-times text-white"></i>
                                                </span>
                                            @else
                                                <span class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center ring-8 ring-white">
                                                    <i class="fas fa-hourglass-half text-white"></i>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4 space-x-reverse">
                                            <div>
                                                @if($order->status == 'accepted')
                                                    <p class="text-sm font-medium text-gray-900">تم قبول الطلب</p>
                                                    <p class="text-xs text-gray-500 mt-1">تمت مراجعة الطلب والموافقة عليه</p>
                                                @elseif($order->status == 'rejected')
                                                    <p class="text-sm font-medium text-gray-900">تم رفض الطلب</p>
                                                    <p class="text-xs text-gray-500 mt-1">تم رفض الطلب لسبب ما</p>
                                                @else
                                                    <p class="text-sm font-medium text-gray-500">في انتظار المراجعة</p>
                                                    <p class="text-xs text-gray-500 mt-1">لم تتم معالجة الطلب بعد</p>
                                                @endif
                                            </div>
                                            <div class="text-left text-sm whitespace-nowrap text-gray-500">
                                                @if($order->handling_date)
                                                    <time datetime="{{ $order->handling_date->format('Y-m-d') }}">{{ $order->handling_date->format('d M Y - h:i A') }}</time>
                                                @else
                                                    <span>قيد الانتظار</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <!-- 3. Shipping Process -->
                            <li>
                                <div class="relative pb-8">
                                    <span class="absolute top-4 right-4 -mr-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    <div class="relative flex space-x-3 space-x-reverse">
                                        <div>
                                            @if($order->shipping_status == 'shipped' || $order->shipping_status == 'delivered')
                                                <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                    <i class="fas fa-truck text-white"></i>
                                                </span>
                                            @else
                                                <span class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center ring-8 ring-white {{ $order->status != 'accepted' ? 'opacity-50' : '' }}">
                                                    <i class="fas fa-truck text-white"></i>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4 space-x-reverse">
                                            <div>
                                                @if($order->shipping_status == 'shipped')
                                                    <p class="text-sm font-medium text-gray-900">تم شحن الطلب</p>
                                                    <p class="text-xs text-gray-500 mt-1">تم إرسال الطلب وهو في الطريق إليك</p>
                                                @elseif($order->shipping_status == 'delivered')
                                                    <p class="text-sm font-medium text-gray-900">تم شحن الطلب</p>
                                                    <p class="text-xs text-gray-500 mt-1">تم إرسال الطلب وتم توصيله لاحقاً</p>
                                                @else
                                                    <p class="text-sm font-medium text-gray-500 {{ $order->status != 'accepted' ? 'opacity-50' : '' }}">في انتظار الشحن</p>
                                                    <p class="text-xs text-gray-500 mt-1 {{ $order->status != 'accepted' ? 'opacity-50' : '' }}">سيتم شحن الطلب قريباً</p>
                                                @endif
                                            </div>
                                            <div class="text-left text-sm whitespace-nowrap text-gray-500">
                                                @if($order->shipping_date)
                                                    <time datetime="{{ $order->shipping_date->format('Y-m-d') }}">{{ $order->shipping_date->format('d M Y - h:i A') }}</time>
                                                @else
                                                    <span class="{{ $order->status != 'accepted' ? 'opacity-50' : '' }}">قيد الانتظار</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <!-- 4. Delivery Confirmation -->
                            <li>
                                <div class="relative pb-8">
                                    <span class="absolute top-4 right-4 -mr-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    <div class="relative flex space-x-3 space-x-reverse">
                                        <div>
                                            @if($order->shipping_status == 'delivered')
                                                <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                                    <i class="fas fa-box-open text-white"></i>
                                                </span>
                                            @else
                                                <span class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center ring-8 ring-white {{ $order->shipping_status != 'shipped' ? 'opacity-50' : '' }}">
                                                    <i class="fas fa-box-open text-white"></i>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4 space-x-reverse">
                                            <div>
                                                @if($order->shipping_status == 'delivered')
                                                    <p class="text-sm font-medium text-gray-900">تم توصيل الطلب</p>
                                                    <p class="text-xs text-gray-500 mt-1">تم تسليم الطلب بنجاح</p>
                                                @else
                                                    <p class="text-sm font-medium text-gray-500 {{ $order->shipping_status != 'shipped' ? 'opacity-50' : '' }}">في انتظار التوصيل</p>
                                                    <p class="text-xs text-gray-500 mt-1 {{ $order->shipping_status != 'shipped' ? 'opacity-50' : '' }}">سيتم توصيل الطلب قريباً</p>
                                                @endif
                                            </div>
                                            <div class="text-left text-sm whitespace-nowrap text-gray-500">
                                                @if($order->delivery_date)
                                                    <time datetime="{{ $order->delivery_date->format('Y-m-d') }}">{{ $order->delivery_date->format('d M Y - h:i A') }}</time>
                                                @else
                                                    <span class="{{ $order->shipping_status != 'shipped' ? 'opacity-50' : '' }}">قيد الانتظار</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <!-- 5. Payment Confirmation -->
                            <li>
                                <div class="relative">
                                    <div class="relative flex space-x-3 space-x-reverse">
                                        <div>
                                            @if($order->payment_status == 'paid')
                                                <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                                    <i class="fas fa-money-bill-wave text-white"></i>
                                                </span>
                                            @else
                                                <span class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center ring-8 ring-white {{ $order->shipping_status != 'delivered' ? 'opacity-50' : '' }}">
                                                    <i class="fas fa-money-bill-wave text-white"></i>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4 space-x-reverse">
                                            <div>
                                                @if($order->payment_status == 'paid')
                                                    <p class="text-sm font-medium text-gray-900">تم الدفع</p>
                                                    <p class="text-xs text-gray-500 mt-1">تم استلام المبلغ بنجاح</p>
                                                @else
                                                    <p class="text-sm font-medium text-gray-500 {{ $order->shipping_status != 'delivered' ? 'opacity-50' : '' }}">في انتظار الدفع</p>
                                                    <p class="text-xs text-gray-500 mt-1 {{ $order->shipping_status != 'delivered' ? 'opacity-50' : '' }}">الدفع عند الاستلام</p>
                                                @endif
                                            </div>
                                            <div class="text-left text-sm whitespace-nowrap text-gray-500">
                                                @if($order->payment_date)
                                                    <time datetime="{{ $order->payment_date->format('Y-m-d') }}">{{ $order->payment_date->format('d M Y - h:i A') }}</time>
                                                @else
                                                    <span class="{{ $order->shipping_status != 'delivered' ? 'opacity-50' : '' }}">قيد الانتظار</span>
                                                @endif
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
    </main>
</body>
</html>
