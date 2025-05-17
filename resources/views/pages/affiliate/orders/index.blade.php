<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>طلباتي</title>
    <x-imports.index />
    <x-scripts.index />
</head>

<body class="font-sans antialiased bg-dot-pat bg-gray-50">
    <!-- Notifications -->
    <x-notif />
    
    <!-- Navigation -->
    <x-layout.nav :page="''"/>
    
    <!-- Sidebar -->
    <x-layout.sidebar />
    
    <!-- Page Header -->
    <x-layout.header 
        :headerText="'إدارة الطلبات'" 
        :icon="'fas fa-shopping-cart'"
        :btnLink="route('products.index')"
        :btnText="'إضافة طلب جديد'"
        :btnIcon="'fas fa-plus'"
        :btnClass="'inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150'"
    />
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <!-- Total Orders Card -->
            <div class="bg-white rounded-lg shadow p-4 border-t-4 border-blue-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                        <i class="fas fa-shopping-cart text-blue-600 text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-500">إجمالي الطلبات</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $orders->count() }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Pending Orders Card -->
            <div class="bg-white rounded-lg shadow p-4 border-t-4 border-yellow-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-100 rounded-md p-3">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-500">بانتظار الموافقة</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $orders->where('status', 'pending')->count() }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Accepted Orders Card -->
            <div class="bg-white rounded-lg shadow p-4 border-t-4 border-green-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                        <i class="fas fa-check text-green-600 text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-500">طلبات مقبولة</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $orders->where('status', 'accepted')->count() }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Rejected Orders Card -->
            <div class="bg-white rounded-lg shadow p-4 border-t-4 border-red-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-red-100 rounded-md p-3">
                        <i class="fas fa-times text-red-600 text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-500">طلبات مرفوضة</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $orders->where('status', 'rejected')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Filtering Options (commented as requested) --}}
        
        <!-- Orders List -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
            <div class="p-4 border-b border-gray-200 bg-gradient-to-l from-blue-50 to-white flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-clipboard-list text-blue-600 ml-3"></i>
                    قائمة الطلبات
                </h2>
                <span class="text-sm text-gray-500">
                    <i class="fas fa-info-circle ml-1"></i>
                    اضغط على الطلب لعرض التفاصيل
                </span>
            </div>
            
            <!-- Order Items -->
            <div class="overflow-hidden">
                @forelse($orders as $order)
                    <div class="border-b border-gray-200 hover:bg-gray-50 transition-colors" x-data="{ open: false }">
                        <!-- Order Summary Row -->
                        <div class="p-4 cursor-pointer" @click="open = !open">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <!-- Order ID and Date -->
                                <div>
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-shopping-bag text-blue-500"></i>
                                        <span class="font-bold text-gray-900">#{{ $order->id }}</span>
                                        <span class="text-sm text-gray-500">{{ $order->created_at->format('Y/m/d') }}</span>
                                    </div>
                                    <div class="text-sm text-gray-700 mt-2 flex items-center">
                                        <i class="fas fa-user text-gray-400 ml-2"></i>
                                        <span>{{ $order->name }}</span>
                                    </div>
                                </div>
                                
                                <!-- Product Info -->
                                <div class="flex-grow flex items-center">
                                    <i class="fas fa-box-open text-blue-500 ml-2"></i>
                                    <div>
                                        <div class="font-medium text-gray-900">
                                            {{ App\Models\Product::find($order->product_id)->name ?? 'منتج غير معروف' }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $order->quantity }} × {{ $order->affiliate_price }} ر.س
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Primary Status Badge -->
                                <div>
                                    @if($order->status === 'rejected')
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle ml-1.5"></i>
                                            مرفوض
                                        </span>
                                    @elseif($order->status === 'accepted')
                                        @if($order->shipping_status === 'delivered')
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle ml-1.5"></i>
                                                تم التسليم
                                            </span>
                                        @elseif($order->shipping_status === 'shipped')
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                                <i class="fas fa-shipping-fast ml-1.5"></i>
                                                تم الشحن
                                            </span>
                                        @elseif($order->payment_status === 'paid')
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-money-bill-wave ml-1.5"></i>
                                                تم الدفع
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check ml-1.5"></i>
                                                مقبول
                                            </span>
                                        @endif
                                    @else
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-hourglass-half ml-1.5"></i>
                                            قيد الانتظار
                                        </span>
                                    @endif
                                </div>
                                
                                <!-- Expand Button -->
                                <div class="text-gray-400">
                                    <span class="text-sm ml-1 hidden md:inline">التفاصيل</span>
                                    <i class="fas" :class="open ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Order Details (Expandable) -->
                        <div x-show="open" x-collapse x-cloak class="p-5 bg-gray-50 border-t border-gray-200">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                                <!-- Order Details Card -->
                                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                                    <div class="flex items-center border-b border-gray-100 pb-3 mb-3">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-info-circle text-blue-500"></i>
                                        </div>
                                        <h3 class="font-bold text-gray-800">تفاصيل الطلب</h3>
                                    </div>
                                    
                                    <div class="space-y-3 text-sm">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">رقم الطلب:</span>
                                            <span class="font-medium text-gray-900">#{{ $order->id }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">تاريخ الطلب:</span>
                                            <span class="font-medium">{{ $order->created_at->format('Y/m/d - H:i') }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">الكمية:</span>
                                            <span class="font-medium">{{ $order->quantity }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">سعر الوحدة:</span>
                                            <span class="font-medium">{{ $order->affiliate_price }} ر.س</span>
                                        </div>
                                        <div class="flex justify-between pt-2 border-t border-gray-100 font-bold">
                                            <span>الإجمالي:</span>
                                            <span>{{ number_format($order->affiliate_price * $order->quantity) }} ر.س</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Customer Information Card -->
                                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                                    <div class="flex items-center border-b border-gray-100 pb-3 mb-3">
                                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-user text-green-500"></i>
                                        </div>
                                        <h3 class="font-bold text-gray-800">معلومات العميل</h3>
                                    </div>
                                    
                                    <div class="space-y-3 text-sm">
                                        <div class="flex items-start">
                                            <i class="fas fa-user-circle text-gray-400 w-5 mt-0.5"></i>
                                            <div class="mr-2">
                                                <div class="font-medium text-gray-900">{{ $order->name }}</div>
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <i class="fas fa-envelope text-gray-400 w-5 mt-0.5"></i>
                                            <div class="mr-2">
                                                <div>{{ $order->email }}</div>
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <i class="fas fa-phone text-gray-400 w-5 mt-0.5"></i>
                                            <div class="mr-2">
                                                <div dir="ltr" class="text-left">{{ $order->phone }}</div>
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <i class="fas fa-map-marker-alt text-gray-400 w-5 mt-0.5"></i>
                                            <div class="mr-2">
                                                <div>{{ $order->address }}</div>
                                                @if($order->zip)
                                                    <div class="text-xs text-gray-500">رمز بريدي: {{ $order->zip }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Status & Actions Card -->
                                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                                    <div class="flex items-center border-b border-gray-100 pb-3 mb-3">
                                        <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-tasks text-indigo-500"></i>
                                        </div>
                                        <h3 class="font-bold text-gray-800">الحالة والإجراءات</h3>
                                    </div>
                                    
                                    <!-- Status Indicators -->
                                    <div class="space-y-3 mb-4">
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 rounded-full mr-1.5
                                                {{ $order->status === 'pending' ? 'bg-yellow-400' : 
                                                   ($order->status === 'accepted' ? 'bg-green-400' : 'bg-red-400') }}"></div>
                                            <span class="text-sm">حالة الطلب:</span>
                                            <span class="text-sm font-medium mr-1
                                                {{ $order->status === 'pending' ? 'text-yellow-600' : 
                                                   ($order->status === 'accepted' ? 'text-green-600' : 'text-red-600') }}">
                                                {{ $order->status === 'pending' ? 'قيد الانتظار' : 
                                                   ($order->status === 'accepted' ? 'مقبول' : 'مرفوض') }}
                                            </span>
                                        </div>
                                        
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 rounded-full mr-1.5
                                                {{ $order->shipping_status === 'pending' ? 'bg-blue-400' : 
                                                   ($order->shipping_status === 'shipped' ? 'bg-indigo-400' : 'bg-green-400') }}"></div>
                                            <span class="text-sm">حالة الشحن:</span>
                                            <span class="text-sm font-medium mr-1
                                                {{ $order->shipping_status === 'pending' ? 'text-blue-600' : 
                                                   ($order->shipping_status === 'shipped' ? 'text-indigo-600' : 'text-green-600') }}">
                                                {{ $order->shipping_status === 'pending' ? 'بانتظار الشحن' : 
                                                   ($order->shipping_status === 'shipped' ? 'تم الشحن' : 'تم التسليم') }}
                                            </span>
                                        </div>
                                        
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 rounded-full mr-1.5
                                                {{ $order->payment_status === 'pending' ? 'bg-orange-400' : 'bg-green-400' }}"></div>
                                            <span class="text-sm">حالة الدفع:</span>
                                            <span class="text-sm font-medium mr-1
                                                {{ $order->payment_status === 'pending' ? 'text-orange-600' : 'text-green-600' }}">
                                                {{ $order->payment_status === 'pending' ? 'بانتظار الدفع' : 'تم الدفع' }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="space-y-2 mt-4">
                                        @if($order->status === 'pending')
                                            <a href="{{ route('affiliate.orders', $order->id) }}" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-md transition-colors border border-blue-200">
                                                <i class="fas fa-edit"></i>
                                                <span>تعديل الطلب</span>
                                            </a>
                                            <button 
                                                onclick="openDeleteModal('{{ route('affiliate.orders.destroy', $order->id) }}', '{{ $order->id }}', 'الطلب رقم')"
                                                class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-50 hover:bg-red-100 text-red-700 rounded-md transition-colors border border-red-200">
                                                <i class="fas fa-trash"></i>
                                                <span>إلغاء الطلب</span>
                                            </button>
                                        @endif
                                        
                                        <a href="{{ route('orders.show', $order->id) }}" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-gray-50 hover:bg-gray-100 text-gray-700 rounded-md transition-colors border border-gray-200">
                                            <i class="fas fa-eye"></i>
                                            <span>عرض التفاصيل</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Order Timeline -->
                            @if($order->handling_date || $order->shipping_date || $order->delivery_date)
                            <div class="mt-5 bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                                <div class="flex items-center border-b border-gray-100 pb-3 mb-4">
                                    <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                        <i class="fas fa-history text-purple-500"></i>
                                    </div>
                                    <h3 class="font-bold text-gray-800">مسار الطلب</h3>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="flex flex-col items-center">
                                        <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center">
                                            <i class="fas fa-plus text-xs"></i>
                                        </div>
                                        <div class="w-1 flex-grow bg-gray-300 my-2" style="height: 40px"></div>
                                        
                                        @if($order->handling_date)
                                        <div class="w-8 h-8 rounded-full {{ $order->status === 'accepted' ? 'bg-green-500' : 'bg-red-500' }} text-white flex items-center justify-center">
                                            <i class="fas {{ $order->status === 'accepted' ? 'fa-check' : 'fa-times' }} text-xs"></i>
                                        </div>
                                        @if($order->shipping_date || $order->delivery_date)
                                        <div class="w-1 flex-grow bg-gray-300 my-2" style="height: 40px"></div>
                                        @endif
                                        @endif
                                        
                                        @if($order->shipping_date)
                                        <div class="w-8 h-8 rounded-full bg-indigo-500 text-white flex items-center justify-center">
                                            <i class="fas fa-truck text-xs"></i>
                                        </div>
                                        @if($order->delivery_date)
                                        <div class="w-1 flex-grow bg-gray-300 my-2" style="height: 40px"></div>
                                        @endif
                                        @endif
                                        
                                        @if($order->delivery_date)
                                        <div class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center">
                                            <i class="fas fa-home text-xs"></i>
                                        </div>
                                        @endif
                                    </div>
                                    
                                    <div class="flex-grow mr-4">
                                        <div class="mb-6">
                                            <p class="font-medium text-gray-900">تم إنشاء الطلب</p>
                                            <p class="text-sm text-gray-500">{{ $order->created_at->format('Y/m/d - H:i') }}</p>
                                        </div>
                                        
                                        @if($order->handling_date)
                                        <div class="mb-6">
                                            <p class="font-medium text-gray-900">
                                                {{ $order->status === 'accepted' ? 'تمت الموافقة على الطلب' : 'تم رفض الطلب' }}
                                            </p>
                                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($order->handling_date)->format('Y/m/d - H:i') }}</p>
                                        </div>
                                        @endif
                                        
                                        @if($order->shipping_date)
                                        <div class="mb-6">
                                            <p class="font-medium text-gray-900">تم شحن الطلب</p>
                                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($order->shipping_date)->format('Y/m/d - H:i') }}</p>
                                        </div>
                                        @endif
                                        
                                        @if($order->delivery_date)
                                        <div>
                                            <p class="font-medium text-gray-900">تم تسليم الطلب</p>
                                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($order->delivery_date)->format('Y/m/d - H:i') }}</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 text-blue-500 mb-4">
                            <i class="fas fa-shopping-cart text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">لا توجد طلبات</h3>
                        <p class="text-gray-500 mb-4">لم تقم بإنشاء أي طلبات بعد</p>
                        <a href="{{ route('orders.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="fas fa-plus ml-2"></i> إضافة طلب جديد
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    
    <!-- Modal Component -->
    <x-modal id="appModal" />
    
    <!-- Modal Script -->
    <x-scripts.modal />
</body>
</html>