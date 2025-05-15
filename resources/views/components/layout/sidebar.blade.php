<!-- filepath: /home/sgouzi/prj/hdmarketing/resources/views/components/sidebar.blade.php -->
<div id="sidebar" class="flex flex-col fixed md:static w-64 bg-white shadow-xl border-l border-gray-200 z-40 transition-all duration-300 ease-in-out transform translate-x-full md:translate-x-0 h-full">
    <!-- Logo and profile section -->
    <div class="px-6 pt-6 pb-8 border-b border-gray-200 {{ Auth::user()->is_admin ? 'bg-gradient-to-br from-blue-50 to-indigo-100' : 'bg-gradient-to-br from-amber-50 to-orange-100' }}">
        <div class="flex justify-center">
            <img class="h-12 mb-4" src="{{ asset('images/logo.png') }}" alt="Logo" />
        </div>
        <div class="text-center">
            <div class="relative inline-block transition-all duration-300 ease-in-out">
                <img id="profile-img" class="h-20 w-20 rounded-full mx-auto shadow-md border-4 {{ Auth::user()->is_admin ? 'border-blue-400' : 'border-amber-400' }} object-cover transition-all duration-300 ease-in-out" 
                     src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background={{ Auth::user()->is_admin ? '4f86eb' : 'ed8936' }}&color=fff" alt="Profile" />
                <span class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 border-2 border-white rounded-full"></span>
            </div>
            <h2 id="profile-name" class="mt-3 text-xl font-bold text-gray-700 transition-all duration-300 ease-in-out">{{ Auth::user()->name }}</h2>
            <p id="profile-role" class="text-sm {{ Auth::user()->is_admin ? 'text-blue-600' : 'text-orange-600' }} font-medium transition-all duration-300 ease-in-out">
                {{ Auth::user()->is_admin ? 'مدير النظام' : 'مسوق' }}
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

            @if(!Auth::user()->is_admin)
                <li>
                    <a href="{{ route('wallet') }}" class="flex items-center px-4 py-3 rounded-lg mx-2 transition-all duration-200
                        {{ request()->routeIs('wallet') ? 'text-orange-700 bg-orange-50' : 'text-gray-600 hover:bg-gray-100' }}">
                        <i class="fas fa-wallet w-5 h-5 ml-2"></i>
                        <span>محفظة</span>
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
</div>

<!-- Mobile menu button - visible only on small screens -->
<button id="sidebar-toggle-btn" class="fixed top-4 right-4 z-50 md:hidden p-2 bg-white rounded-md shadow-md text-gray-500 hover:text-gray-600 focus:outline-none">
    <i class="fas fa-bars"></i>
</button>

<!-- Overlay for mobile when sidebar is open -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out z-30 md:hidden"></div>