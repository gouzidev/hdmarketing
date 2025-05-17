<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>
    <x-imports.index />
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Navigation -->
    <x-layout.nav :page="'dashboard'"/>
    
    <!-- Sidebar -->
    <x-layout.sidebar />

    <!-- Main Content -->
    <div>
        <!-- Page Header -->
        <x-layout.header
            :headerText="'لوحة التحكم'"
            :icon="'fas fa-chart-line'"
        />
        
        <!-- Welcome Banner -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="bg-gradient-to-l from-blue-50 to-white rounded-lg shadow-sm p-6 mb-8 border border-blue-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-medium text-gray-900 mb-2">مرحباً بك، {{ auth()->user()->name }}!</h2>
                        <p class="text-gray-600">استعرض أداء حسابك ومتابعة نشاطك التسويقي</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="bg-blue-100 rounded-full p-3">
                            <i class="fas fa-user-chart text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Key Performance Indicators -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
                <!-- Total Earnings Card -->
                <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-100">
                    <div class="flex justify-between items-center mb-3">
                        <div class="text-sm font-medium text-gray-500">إجمالي الأرباح</div>
                        <div class="bg-green-100 rounded-md p-2">
                            <i class="fas fa-coins text-green-600"></i>
                        </div>
                    </div>
                    <div class="flex items-baseline">
                        <span class="text-2xl font-bold text-gray-900">{{ number_format(rand(5000, 20000)) }}</span>
                        <span class="mr-1 text-sm text-gray-500">ر.س</span>
                    </div>
                    <div class="mt-2 flex items-center">
                        <span class="text-xs font-medium text-green-600">+{{ rand(5, 15) }}%</span>
                        <span class="mr-1 text-xs text-gray-500">عن الشهر الماضي</span>
                    </div>
                </div>
                
                <!-- Total Orders Card -->
                <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-100">
                    <div class="flex justify-between items-center mb-3">
                        <div class="text-sm font-medium text-gray-500">إجمالي الطلبات</div>
                        <div class="bg-blue-100 rounded-md p-2">
                            <i class="fas fa-shopping-cart text-blue-600"></i>
                        </div>
                    </div>
                    <div class="flex items-baseline">
                        <span class="text-2xl font-bold text-gray-900">{{ rand(50, 150) }}</span>
                    </div>
                    <div class="mt-2 flex items-center">
                        <span class="text-xs font-medium text-green-600">+{{ rand(3, 10) }}</span>
                        <span class="mr-1 text-xs text-gray-500">طلب هذا الأسبوع</span>
                    </div>
                </div>
                
                <!-- Conversion Rate Card -->
                <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-100">
                    <div class="flex justify-between items-center mb-3">
                        <div class="text-sm font-medium text-gray-500">نسبة التحويل</div>
                        <div class="bg-purple-100 rounded-md p-2">
                            <i class="fas fa-percentage text-purple-600"></i>
                        </div>
                    </div>
                    <div class="flex items-baseline">
                        <span class="text-2xl font-bold text-gray-900">{{ rand(3, 8) }}.{{ rand(0, 9) }}%</span>
                    </div>
                    <div class="mt-2 flex items-center">
                        <span class="text-xs font-medium {{ rand(0, 1) ? 'text-green-600' : 'text-red-600' }}">{{ rand(0, 1) ? '+' : '-' }}{{ rand(1, 2) }}.{{ rand(0, 9) }}%</span>
                        <span class="mr-1 text-xs text-gray-500">عن الشهر الماضي</span>
                    </div>
                </div>
                
                <!-- Current Balance Card -->
                <div class="bg-white rounded-lg shadow-sm p-5 border border-gray-100">
                    <div class="flex justify-between items-center mb-3">
                        <div class="text-sm font-medium text-gray-500">الرصيد الحالي</div>
                        <div class="bg-yellow-100 rounded-md p-2">
                            <i class="fas fa-wallet text-yellow-600"></i>
                        </div>
                    </div>
                    <div class="flex items-baseline">
                        <span class="text-2xl font-bold text-gray-900">{{ number_format(rand(1000, 5000)) }}</span>
                        <span class="mr-1 text-sm text-gray-500">ر.س</span>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('wallet') }}" class="text-xs text-blue-600 font-medium hover:text-blue-800">طلب سحب <i class="fas fa-arrow-left ml-1"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Performance Chart & Recent Orders -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Performance Chart -->
                <div class="lg:col-span-2 bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">أداء المبيعات</h3>
                        <div class="flex space-x-3 space-x-reverse">
                            <button class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition-colors">أسبوعي</button>
                            <button class="px-3 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors">شهري</button>
                            <button class="px-3 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors">سنوي</button>
                        </div>
                    </div>
                    <div class="h-64 flex items-center justify-center">
                        <!-- This would be a chart in production -->
                        <div class="text-center text-gray-500">
                            <i class="fas fa-chart-line text-6xl text-gray-300 mb-3"></i>
                            <p class="mb-1">رسم بياني للأداء</p>
                            <p class="text-xs">يتم توليد هذا الرسم البياني بناءً على بيانات المبيعات الفعلية</p>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Orders -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">آخر الطلبات</h3>
                        <a href="{{ route('affiliate.orders') }}" class="text-blue-600 text-sm hover:text-blue-800">عرض الكل</a>
                    </div>
                    
                    <div class="space-y-4">
                        @for($i = 0; $i < 4; $i++)
                            <div class="flex items-center p-3 bg-gray-50 rounded-md">
                                <div class="bg-{{ ['blue', 'green', 'yellow', 'purple'][$i] }}-100 p-2 rounded-full">
                                    <i class="fas fa-shopping-bag text-{{ ['blue', 'green', 'yellow', 'purple'][$i] }}-600"></i>
                                </div>
                                <div class="flex-grow mr-3">
                                    <div class="text-sm font-medium">طلب #{{ rand(1000, 9999) }}</div>
                                    <div class="text-xs text-gray-500">{{ ['منتج العناية بالبشرة', 'كريم مرطب', 'مجموعة التجميل', 'عطر فاخر', 'كريم واقي شمس'][rand(0, 4)] }}</div>
                                </div>
                                <div class="text-sm font-bold">{{ rand(100, 500) }} ر.س</div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            
            <!-- Top Products & Marketing Tools -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Top Products -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">أفضل المنتجات أداءً</h3>
                        <a href="{{ route('products.index') }}" class="text-blue-600 text-sm hover:text-blue-800">تسويق المنتجات</a>
                    </div>
                    
                    <div class="space-y-4">
                        @for($i = 0; $i < 5; $i++)
                            <div class="flex items-center">
                                <div class="text-center w-8">
                                    <span class="{{ $i < 3 ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }} w-6 h-6 inline-flex items-center justify-center rounded-full text-xs font-bold">{{ $i + 1 }}</span>
                                </div>
                                <div class="flex-grow mr-3">
                                    <div class="text-sm font-medium">{{ ['كريم ترطيب البشرة', 'مجموعة العناية', 'سيروم فيتامين سي', 'مرطب يومي', 'واقي شمس'][rand(0, 4)] }}</div>
                                    <div class="flex items-center text-xs text-gray-500">
                                        <span>{{ rand(10, 50) }} طلب</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ rand(5, 15) }}% نسبة التحويل</span>
                                    </div>
                                </div>
                                <div class="text-sm font-medium">{{ rand(1000, 5000) }} ر.س</div>
                            </div>
                        @endfor
                    </div>
                </div>
                
                <!-- Quick Links & Tools -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">أدوات التسويق</h3>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="#" class="bg-gray-50 hover:bg-gray-100 transition-colors p-3 rounded-lg flex flex-col items-center justify-center text-center">
                                <i class="fas fa-link text-blue-600 mb-2"></i>
                                <span class="text-sm font-medium text-gray-700">إنشاء رابط تسويقي</span>
                            </a>
                            <a href="#" class="bg-gray-50 hover:bg-gray-100 transition-colors p-3 rounded-lg flex flex-col items-center justify-center text-center">
                                <i class="fas fa-image text-purple-600 mb-2"></i>
                                <span class="text-sm font-medium text-gray-700">بانرات إعلانية</span>
                            </a>
                            <a href="#" class="bg-gray-50 hover:bg-gray-100 transition-colors p-3 rounded-lg flex flex-col items-center justify-center text-center">
                                <i class="fas fa-bullhorn text-yellow-600 mb-2"></i>
                                <span class="text-sm font-medium text-gray-700">حملات تسويقية</span>
                            </a>
                            <a href="#" class="bg-gray-50 hover:bg-gray-100 transition-colors p-3 rounded-lg flex flex-col items-center justify-center text-center">
                                <i class="fas fa-lightbulb text-green-600 mb-2"></i>
                                <span class="text-sm font-medium text-gray-700">نصائح تسويقية</span>
                            </a>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">روابط سريعة</h3>
                        <div class="space-y-3">
                            <a href="{{ route('products.index') }}" class="flex items-center p-2 hover:bg-gray-50 rounded-md">
                                <i class="fas fa-box text-blue-600 ml-3"></i>
                                <span class="text-sm text-gray-700">تصفح المنتجات</span>
                            </a>
                            <a href="{{ route('affiliate.orders') }}" class="flex items-center p-2 hover:bg-gray-50 rounded-md">
                                <i class="fas fa-shopping-cart text-green-600 ml-3"></i>
                                <span class="text-sm text-gray-700">طلباتي</span>
                            </a>
                            <a href="{{ route('wallet') }}" class="flex items-center p-2 hover:bg-gray-50 rounded-md">
                                <i class="fas fa-wallet text-yellow-600 ml-3"></i>
                                <span class="text-sm text-gray-700">المحفظة والمدفوعات</span>
                            </a>
                            <a href="{{ route('profile') }}" class="flex items-center p-2 hover:bg-gray-50 rounded-md">
                                <i class="fas fa-user-cog text-purple-600 ml-3"></i>
                                <span class="text-sm text-gray-700">إعدادات الحساب</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Latest News and Announcements -->
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">أخبار وإعلانات</h3>
                        <a href="#" class="text-blue-600 text-sm hover:text-blue-800">عرض الكل</a>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="pb-4 border-b border-gray-100">
                            <div class="text-sm font-medium mb-1">تحديث عمولات المنتجات الموسمية</div>
                            <p class="text-xs text-gray-600 mb-1">زيادة نسبة العمولة على منتجات العناية بالبشرة إلى 15% خلال فترة الصيف</p>
                            <div class="text-xs text-gray-500">منذ 3 أيام</div>
                        </div>
                        
                        <div class="pb-4 border-b border-gray-100">
                            <div class="text-sm font-medium mb-1">إطلاق المنتجات الجديدة</div>
                            <p class="text-xs text-gray-600 mb-1">تم إضافة 25 منتج جديد للتسويق من أفضل العلامات التجارية</p>
                            <div class="text-xs text-gray-500">منذ أسبوع</div>
                        </div>
                        
                        <div class="pb-4 border-b border-gray-100">
                            <div class="text-sm font-medium mb-1">تحديث نظام الدفع</div>
                            <p class="text-xs text-gray-600 mb-1">تم تحسين نظام الدفع ليصبح أسرع وأكثر أمانًا</p>
                            <div class="text-xs text-gray-500">منذ 2 أسبوع</div>
                        </div>
                        
                        <div>
                            <div class="text-sm font-medium mb-1">حملة تسويقية للعودة للمدارس</div>
                            <p class="text-xs text-gray-600 mb-1">استعد للحملة الترويجية الكبرى بخصومات تصل إلى 40%</p>
                            <div class="text-xs text-gray-500">منذ 3 أسبوع</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Affiliate Marketing Performance -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-900">أداء الأفلييت</h3>
                    <div class="flex space-x-3 space-x-reverse">
                        <span class="text-sm text-gray-600">فلترة حسب:</span>
                        <button class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition-colors">آخر 7 أيام</button>
                        <button class="px-3 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors">آخر 30 يوم</button>
                        <button class="px-3 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors">كل الوقت</button>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Clicks Metric -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="mb-2 text-sm text-gray-500">إجمالي النقرات</div>
                        <div class="flex justify-between items-end">
                            <div class="text-2xl font-bold">{{ number_format(rand(1000, 5000)) }}</div>
                            <div class="text-sm {{ rand(0, 1) ? 'text-green-600' : 'text-red-600' }}">
                                {{ rand(0, 1) ? '+' : '-' }}{{ rand(5, 15) }}%
                                <i class="fas {{ rand(0, 1) ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Conversion Metric -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="mb-2 text-sm text-gray-500">إجمالي التحويلات</div>
                        <div class="flex justify-between items-end">
                            <div class="text-2xl font-bold">{{ rand(50, 200) }}</div>
                            <div class="text-sm {{ rand(0, 1) ? 'text-green-600' : 'text-red-600' }}">
                                {{ rand(0, 1) ? '+' : '-' }}{{ rand(5, 15) }}%
                                <i class="fas {{ rand(0, 1) ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- CTR Metric -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="mb-2 text-sm text-gray-500">معدل النقر للتحويل (CTR)</div>
                        <div class="flex justify-between items-end">
                            <div class="text-2xl font-bold">{{ rand(3, 8) }}.{{ rand(0, 9) }}%</div>
                            <div class="text-sm {{ rand(0, 1) ? 'text-green-600' : 'text-red-600' }}">
                                {{ rand(0, 1) ? '+' : '-' }}{{ rand(1, 3) }}.{{ rand(0, 9) }}%
                                <i class="fas {{ rand(0, 1) ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Goal Progress -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-900">تقدم الأهداف الشهرية</h3>
                    <div class="text-sm text-gray-600">{{ date('F Y') }}</div>
                </div>
                
                <div class="space-y-6">
                    <!-- Sales Goal -->
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-700">هدف المبيعات</span>
                            <span class="text-gray-700">{{ rand(50, 90) }}% مكتمل</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ rand(50, 90) }}%"></div>
                        </div>
                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                            <span>المتحقق: {{ number_format(rand(15000, 30000)) }} ر.س</span>
                            <span>الهدف: {{ number_format(rand(30000, 50000)) }} ر.س</span>
                        </div>
                    </div>
                    
                    <!-- Conversions Goal -->
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-700">هدف التحويلات</span>
                            <span class="text-gray-700">{{ rand(40, 80) }}% مكتمل</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ rand(40, 80) }}%"></div>
                        </div>
                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                            <span>المتحقق: {{ rand(80, 150) }} تحويل</span>
                            <span>الهدف: {{ rand(200, 300) }} تحويل</span>
                        </div>
                    </div>
                    
                    <!-- Traffic Goal -->
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-700">هدف الزيارات</span>
                            <span class="text-gray-700">{{ rand(60, 95) }}% مكتمل</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-purple-600 h-2.5 rounded-full" style="width: {{ rand(60, 95) }}%"></div>
                        </div>
                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                            <span>المتحقق: {{ number_format(rand(3000, 8000)) }} زيارة</span>
                            <span>الهدف: {{ number_format(rand(8000, 10000)) }} زيارة</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include the sidebar script -->
    <x-scripts.index />
</body>
</html>