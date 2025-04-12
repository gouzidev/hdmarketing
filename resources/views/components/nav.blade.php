<nav class="absolute h-20 w-full">
    <div class="bg-black absolute w-full h-full h-20  opacity-5 z-20"></div>
    <div class="px-10 flex justify-between h-20">
        <div class="self-center flex gap-10 z-20 text-white text-sm items-center">
            <a href="{{route('/register')}}"> <button class="cursor-pointer rounded-xl bg-blue-500 px-3 py-2 ">انشاء حساب جديد</button></a>
            <a href="{{route('/login')}}"><button class="cursor-pointer">تسجيل الدخول</button></a>
        </div>
        <img class="z-30 invert" src="{{asset('images/logo.png')}}" />
    </div>
</nav>