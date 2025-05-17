<!-- filepath: /home/sgouzi/prj/hdmarketing/resources/views/components/layout/nav.blade.php -->
@props(['page' => ''])
<nav class="@if ($page != 'home') bg-white @endif shadow-md fixed top-0 left-0 right-0 z-40 mb-16">
     <!-- margin bottom (mb) to account for fixed navbar -->

    <div class="px-4 mx-auto flex items-center justify-between h-16">
        <!-- Left side (RTL: appears on right) -->
        <div class="flex items-center sm:w-1/3  w-full sm:justify-between">
            <!-- Sidebar Toggle Button -->
            <div class="flex sm:w-1/4">
                <button id="sidebar-toggle-btn" type="button" class="text-gray-600 hover:text-blue-600 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                
                <!-- Logo -->
                <a href="{{ route('home') }}" class="mr-4">
                    <img class="h-8" src="{{ asset('images/logo.png') }}" alt="Logo">
                </a>
            </div>

            @if (Auth::check())
            
                @if (Auth::user()->is_admin)
                    <div class="md:flex hidden md:flex-row w-3/4 text-xs sm:text-xs md:text-md lg:text-sm xl:text-xl justify-between items-center transition-all">
                        <a href="{{ route('products.index') }}" class="font-semibold text-white py-1 px-4 bg-yellow-500 rounded-xl hover:bg-yellow-600">
                            منتجات
                        </a>    
                        <a href="{{ route('orders.index') }}" class="font-semibold text-gray-800 hover:text-purple-900">
                            طلبات
                        </a>
                        <a href="{{ route('users.index') }}" class="font-semibold text-gray-800 hover:text-purple-900">
                            المستخدمين
                        </a>
                    </div>
                @else
                    <div class="md:flex hidden md:flex-row w-full text-xs sm:text-xs md:text-md lg:text-sm xl:text-xl justify-around items-center transition-all">
                        <a href="{{ route('products.index') }}" class="font-semibold text-gray-800 hover:text-purple-900">
                            منتجات
                        </a>
                        <a href="{{ route('affiliate.orders') }}" class="font-semibold text-gray-800 hover:text-purple-900">
                            طلباتي
                        </a>
                    </div>
                @endif
            @endif
        </div>
        
        @if ($page != "products" && $page != "home")
            <!-- Center: Search Bar (hidden on small screens) -->
            <div class="hidden md:block flex-1 mx-8 max-w-xl">
                <form action="{{ route('products.search') }}" method="GET" class="relative">
                    <input type="text" name="search" placeholder="ابحث عن منتج..." 
                        class="w-full pr-10 pl-12 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        dir="rtl">
                    <button type="submit" class="absolute left-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-500">
                        <i class="fas fa-search text-2xl"></i>
                    </button>
                </form>
            </div>        

        @endif
        
        <!-- Right side (RTL: appears on left) -->
        <div class="flex items-center space-x-reverse space-x-4">
            <!-- Mobile Search Icon -->
            <button class="md:hidden text-gray-600 hover:text-blue-600" id="mobile-search-toggle">
                <i class="fas fa-search text-2xl"></i>
            </button>
            
            @auth
                <!-- Notifications - Updated with dropdown -->
                <div class="relative" x-data="{ openNotif: false }">
                    <button @click="openNotif = !openNotif" type="button" class="text-gray-600 hover:text-blue-600 focus:outline-none">
                        <i class="fas fa-bell text-2xl"></i>
                        <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-xs text-white">5</span>
                    </button>
                    <!-- Notifications Dropdown -->
                    <div x-show="openNotif" @click.away="openNotif = false" 
                         class="absolute left-0 mt-2 w-80 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1 z-50"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <h3 class="text-sm font-medium text-gray-900">الإشعارات</h3>
                        </div>
                        <div class="max-h-64 overflow-y-auto">
                            <!-- Show this when there are no notifications -->
                            <div class="py-6 text-center">
                                <div class="mx-auto w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                                    <i class="fas fa-bell-slash text-gray-400"></i>
                                </div>
                                <p class="text-gray-500 text-sm">لا توجد إشعارات جديدة</p>
                            </div>

                            <!-- Sample notifications (you can show these conditionally) -->
                            {{-- <!--
                            <a href="#" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fas fa-shopping-cart text-blue-500"></i>
                                        </div>
                                    </div>
                                    <div class="mr-3 flex-1">
                                        <p class="text-sm font-medium text-gray-900">طلب جديد #1234</p>
                                        <p class="text-xs text-gray-500 mt-1">تم استلام طلب جديد بقيمة $50</p>
                                        <p class="text-xs text-gray-400 mt-1">منذ 30 دقيقة</p>
                                    </div>
                                </div>
                            </a>
                            --> --}}
                        </div>
                        <div class="px-4 py-2 border-t border-gray-100 text-center">
                            <a href="#" class="text-xs text-blue-600 hover:text-blue-800 font-medium">عرض كل الإشعارات</a>
                        </div>
                    </div>
                </div>
                
                {{-- <!-- Shopping Cart -->
                <div class="relative" x-data="{ openCart: false }">
                    <button @click="openCart = !openCart" type="button" class="text-gray-600 hover:text-blue-600 focus:outline-none">
                        <i class="fas fa-shopping-cart text-2xl"></i>
                        <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-gray-500 text-xs text-white">0</span>
                    </button>
                    <!-- Cart Dropdown -->
                    <div x-show="openCart" @click.away="openCart = false" 
                         class="absolute left-0 mt-2 w-80 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1 z-50">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <h3 class="text-sm font-medium text-gray-900">سلة التسوق</h3>
                        </div>
                        <div class="py-6 text-center">
                            <div class="mx-auto w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                                <i class="fas fa-shopping-basket text-gray-400"></i>
                            </div>
                            <p class="text-gray-500 text-sm">سلة التسوق فارغة</p>
                        </div>
                    </div>
                </div>
                 --}}
                <!-- User Profile -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="text-gray-600 hover:text-blue-600 focus:outline-none">
                        <i class="fas fa-user-circle text-xl"></i>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1 z-50">
                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">حسابي</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-right block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">تسجيل الخروج</button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Login/Register -->
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600">تسجيل الدخول</a>
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition-colors">
                    إنشاء حساب
                </a>
            @endauth
        </div>
    </div>

    <!-- Mobile Search Bar (hidden by default) -->
    <div id="mobile-search-bar" class="md:hidden px-4 pb-3 hidden">
        <form action="{{ route('products.search') }}" method="GET" class="relative">
            <input type="text" name="search" placeholder="ابحث عن منتج..." 
                   class="w-full pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500"
                   dir="rtl">
            <button type="submit" class="absolute left-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-500">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</nav>