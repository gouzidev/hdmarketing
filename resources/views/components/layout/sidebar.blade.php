<!-- filepath: /home/sgouzi/prj/hdmarketing/resources/views/components/layout/sidebar.blade.php -->
<div id="sidebar" class="fixed top-0 right-0 h-full w-64 bg-white shadow-lg transform transition-transform duration-300 ease-in-out translate-x-full z-50">
    <!-- Header -->
    <div class="border-b border-gray-200 p-4">
        <div class="flex justify-between items-center">
            <button id="close-sidebar-btn" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                <i class="fas fa-times text-xl"></i>
            </button>
            <img class="h-8" src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>
    </div>
    
    @auth
    <!-- User Profile Section -->
    <div class="p-4 border-b border-gray-200 bg-gradient-to-br {{ auth()->user()->is_admin ? 'from-blue-50 to-indigo-100' : 'from-amber-50 to-orange-100' }}">
        <div class="flex flex-col items-center">
            <div class="relative mb-2">
                <img class="h-16 w-16 rounded-full border-4 {{ auth()->user()->is_admin ? 'border-blue-400' : 'border-amber-400' }} object-cover" 
                     src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background={{ Auth::user()->is_admin ? '4f86eb' : 'ed8936' }}&color=fff" alt="Profile">
                <span class="absolute -bottom-1 -right-1 h-4 w-4 bg-green-500 border-2 border-white rounded-full"></span>
            </div>
            <h3 class="text-lg font-bold text-gray-700">{{ auth()->user()->name }}</h3>
            <p class="text-sm {{ auth()->user()->is_admin ? 'text-blue-600' : 'text-orange-600' }} font-medium">
                {{ auth()->user()->is_admin ? 'مدير النظام' : 'مسوق' }}
            </p>
        </div>
    </div>

    <!-- Navigation Links -->
    <div class="flex-1 overflow-y-auto py-4 text-gray-600">
        <div class="px-4 mb-3">
            <span class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">القائمة الرئيسية</span>
        </div>
        <ul class="space-y-1 px-2">
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-lg mx-2 transition-all duration-200
                    {{ request()->routeIs('dashboard') ? 
                        (Auth::user()->is_admin ? 'text-blue-700 bg-blue-50' : 'text-orange-700 bg-orange-50') : 
                        'text-gray-600 hover:bg-gray-100' }}">
                    <i class="fas fa-chart-line w-5 h-5 ml-2"></i>
                    <span class="{{ request()->routeIs('dashboard') ? 'font-medium' : '' }}">لوحة التحكم</span>
                </a>
            </li>
            <li>
                <a href="{{ route('profile') }}" class="flex items-center px-4 py-3 rounded-lg mx-2 transition-all duration-200
                    {{ request()->routeIs('profile') ? 
                        (Auth::user()->is_admin ? 'text-blue-700 bg-blue-50' : 'text-orange-700 bg-orange-50') : 
                        'text-gray-600 hover:bg-gray-100' }}">
                    <i class="fas fa-user w-5 h-5 ml-2"></i>
                    <span>حسابي</span>
                </a>
            </li>
            <li>
                <a href="{{ route('products.index') }}" class="flex items-center px-4 py-3 rounded-lg mx-2 transition-all duration-200
                    {{ request()->routeIs('products.index') ? 
                        (Auth::user()->is_admin ? 'text-blue-700 bg-blue-50' : 'text-orange-700 bg-orange-50') : 
                        'text-gray-600 hover:bg-gray-100' }}">
                    <i class="fas fa-box w-5 h-5 ml-2"></i>
                    <span>منتجات</span>
                </a>
            </li>

            @if(Auth::user()->is_admin)
                <li>
                    <a href="{{ route('orders.index') }}" class="flex items-center px-4 py-3 rounded-lg mx-2 transition-all duration-200
                        {{ request()->routeIs('orders.index') ? 'text-blue-700 bg-blue-50' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fas fa-shopping-cart w-5 h-5 ml-2"></i>
                        <span>طلبات</span>
                    </a>
                </li>
            @endif

            @if(Auth::user()->is_admin)
                <li>
                    <a href="{{ route('shipping.index') }}" class="flex items-center px-4 py-3 rounded-lg mx-2 transition-all duration-200
                        {{ request()->routeIs('shipping.index') ? 'text-orange-700 bg-orange-50' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fas fa-truck w-5 h-5 ml-2"></i>
                        <span>الشحن</span>
                    </a>
                </li>
            @endif


            @if(!Auth::user()->is_admin)
                <li>
                    <a href="{{ route('wallet') }}" class="flex items-center px-4 py-3 rounded-lg mx-2 transition-all duration-200
                        {{ request()->routeIs('wallet') ? 'text-orange-700 bg-orange-50' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fas fa-wallet w-5 h-5 ml-2"></i>
                        <span>محفظة</span>
                    </a>
                </li>
            @endif

            @if (!Auth::user()->is_admin)
                <li>
                    <a href="{{ route('affiliate.orders') }}" class="flex items-center px-4 py-3 rounded-lg mx-2 transition-all duration-200
                        {{ request()->routeIs('affiliate.orders') ? 'text-orange-700 bg-orange-50' : 'text-gray-600 hover:bg-gray-100' }}">
                    <i class="fas fa-hand-holding-usd w-5 h-5 ml-2"></i>
                    <span>
                        طلباتي
                    </span>
                    </a>
                </li>
            @endif
 
        </ul>
    </div>

    <!-- Logout button -->
    <div class="p-4 border-t border-gray-200">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-4 py-3 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition-all duration-200 font-medium">
                <i class="fas fa-sign-out-alt ml-2"></i>
                <span>تسجيل الخروج</span>
            </button>
        </form>
    </div>
    @else
    <!-- Not authenticated -->
    <div class="p-6 text-center">
        <p class="mb-4 text-gray-600">يرجى تسجيل الدخول للوصول إلى القائمة الكاملة</p>
        <div class="space-y-3">
            <a href="{{ route('login') }}" class="block w-full py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">تسجيل الدخول</a>
            <a href="{{ route('register') }}" class="block w-full py-2 px-4 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">إنشاء حساب</a>
        </div>
    </div>
    @endauth
</div>

<!-- Overlay for sidebar -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black opacity-0 pointer-events-none transition-opacity duration-300 z-40"></div>