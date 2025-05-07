<nav class="{{ $isHome ? 'absolute' : 'bg-gray-800' }} w-full lg:h-20">
    @if ($isHome)
        <div class="bg-black absolute w-full h-full lg:h-20 opacity-5 z-20"></div>
    @endif
    
    <div dir="ltr" class="px-4 lg:px-10 flex justify-between items-center relative h-16 lg:h-20">
        <a href="{{ route('home') }}" class="block z-30">
            <img class="h-12 lg:h-16 invert" src="{{asset('images/logo.png')}}" alt="Logo" />
        </a>
        
        <!-- Hamburger Icon (visible on mobile) -->
        <button id="hamburger-button" class="lg:hidden z-30 focus:outline-none">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        
        <!-- Navigation Menu -->
        <div id="nav-menu" class="
            fixed lg:static top-0 right-0
            h-[100vh] lg:h-auto w-full 
            lg:w-auto bg-gray-800 lg:bg-transparent 
            transform lg:transform-none transition-transform 
            duration-300 ease-in-out translate-x-full 
            lg:translate-x-0 z-20 text-white text-sm flex
            flex-col lg:flex-row-reverse items-center 
            lg:items-stretch pt-10 lg:pt-0 gap-6 lg:gap-10 overflow-hidden">
            @guest
                <a href="{{route('register')}}" class="mt-4 lg:mt-0">
                    <button class="cursor-pointer rounded-xl bg-blue-500 px-3 py-2 hover:bg-blue-600 transition">انشاء حساب جديد</button>
                </a>
                <a href="{{route('login')}}" class="lg:mr-4">
                    <button class="cursor-pointer hover:text-gray-300 py-2 transition">تسجيل الدخول</button>
                </a>
            @elseif (auth()->user()->is_admin)
                <form action="{{ route('logout') }}" method="POST" class="lg:mr-4">
                    @csrf
                    <button type="submit" class="cursor-pointer rounded-xl bg-red-500 px-3 py-2 hover:bg-red-600 transition">تسجيل الخروج</button>
                </form>
                <a href="{{ route('dashboard') }}" class="flex items-center hover:text-gray-300 transition">لوحة التحكم</a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center hover:text-gray-300 transition">المستخدمين</a>
                <a href="{{ route('products.index') }}" class="flex items-center hover:text-gray-300 transition">منتجات</a>
                <a href="{{ route('admin.admin-requests') }}" class="flex items-center hover:text-gray-300 transition">طلبات الانضمام للإدارة</a>
                <a href="{{ route('admin.users.deleted') }}" class="flex items-center hover:text-gray-300 transition">الحسابات المحذوفة</a>
                <a href="{{ route('profile') }}" class="flex items-center hover:text-gray-300 transition">حسابي</a>
                <a href="{{ route('wallet') }}" class="flex items-center hover:text-gray-300 transition">محفظة</a>
                <a href="{{ route('contact-us') }}" class="flex items-center hover:text-gray-300 transition">تواصل معنا</a>
            @else
                <form action="{{ route('logout') }}" method="POST" class="lg:mr-4">
                    @csrf
                    <button type="submit" class="cursor-pointer rounded-xl bg-red-500 px-3 py-2 hover:bg-red-600 transition">تسجيل الخروج</button>
                </form>
                <a href="{{ route('dashboard') }}" class="flex items-center hover:text-gray-300 transition">لوحة التحكم</a>
                <a href="{{ route('products.index') }}" class="flex items-center hover:text-gray-300 transition">منتجات</a>
                <a href="{{ route('profile') }}" class="flex items-center hover:text-gray-300 transition">حسابي</a>
                <a href="{{ route('wallet') }}" class="flex items-center hover:text-gray-300 transition">محفظة</a>
                <a href="{{ route('contact-us') }}" class="flex items-center hover:text-gray-300 transition">تواصل معنا</a>
                @endguest
        </div>
    </div>
</nav>