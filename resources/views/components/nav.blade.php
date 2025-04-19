<nav class="{{ $isHome ? 'absolute' : 'bg-gray-800' }} h-20 w-full">
    @if ($isHome)
        <div class="bg-black absolute w-full h-full h-20 opacity-5 z-20"></div>
    @else
        {{-- <div class="bg-black  w-full h-full h-20 opacity-100 z-20"></div> --}}
    @endif    
    <div class="px-10 flex justify-between h-20">
        <div class="self-center flex gap-10 z-20 text-white text-sm items-center">
            @guest
                <a href="{{route('register')}}"> <button class="cursor-pointer rounded-xl bg-blue-500 px-3 py-2 ">انشاء حساب جديد</button></a>
                <a href="{{route('login')}}"><button class="cursor-pointer">تسجيل الدخول</button></a>
            @elseif (auth()->user()->is_admin)
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="cursor-pointer rounded-xl bg-red-500 px-3 py-2 ">تسجيل الخروج</button>
                </form>
                <a href="{{ route('dashboard') }}"><button class="cursor-pointer">لوحة التحكم</button></a>
                <a href="{{ route('admin.users.index') }}"><button class="cursor-pointer">المستخدمين</button></a>
                <a href="{{ route('products.index') }}"><button class="cursor-pointer">منتجات</button></a>
                <a href="{{ route('admin.admin-requests') }}"><button class="cursor-pointer">طلبات الانضمام للإدارة</button></a>
                <a href="{{ route('admin.users.deleted') }}"><button class="cursor-pointer">الحسابات المحذوفة</button></a>
                <a href="{{ route('profile') }}"><button class="cursor-pointer">حسابي</button></a>
            @else
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="cursor-pointer rounded-xl bg-red-500 px-3 py-2 ">تسجيل الخروج</button>
                </form>
                <a href="{{ route('dashboard') }}"><button class="cursor-pointer">لوحة التحكم</button></a>
                <a href="{{ route('products.index') }}"><button class="cursor-pointer">منتجات</button></a>
                <a href="{{ route('profile') }}"><button class="cursor-pointer">حسابي</button></a>
            @endguest
        </div>
        <img class="z-30 invert" src="{{asset('images/logo.png')}}" />
    </div>
</nav>