<form
    class="flex flex-col items-center w-9/12 mx-auto mb-20"
    action="{{ route('/login') }}" method="POST">

    <div class="w-full mb-20">
        <input class="border-b-2 py-2 border-[#555] w-full  text-right outline-none focus:outline-none" name="email"  placeholder="*البريد الإلكتروني" required/>
    </div>
    <div class="w-full mb-20">
        <input class="border-b-2 py-2 border-[#555] w-full  text-right outline-none focus:outline-none" name="password"  placeholder="* كلمة المرور" required/>
    </div>
    <div class="self-end flex items-center gap-10">
        <a href="{{ route('/register') }}">
            <button
                class="transition duration-150 hover:border-b-2 border-b-black-700" 
                type="button">لا تملك حساباً؟ سجل الآن</button>
        </a>
        <button class="bg-[#0292cf] text-white  px-3 py-2 rounded">تسجيل الدخول</button>
    </div>
    
    @csrf
    @if ($errors->any())
    <div class="text-red-700 self-end opacity-70 mt-5 text-right">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="mt-1">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</form>