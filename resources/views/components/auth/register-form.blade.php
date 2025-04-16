<form
    class="flex flex-col items-start w-9/12 mx-auto mb-20"
    action="{{ route('register') }}" method="POST">

    <div class="w-full mb-20">
        <input class="border-b-2 py-2 border-[#555] w-full  text-right outline-none focus:outline-none" name="name"  placeholder="* اسم المستخدم" value="sgouzi" required/>
    </div>
    <div class="w-full mb-20">
        <input class="border-b-2 py-2 border-[#555] w-full  text-right outline-none focus:outline-none" name="email" type="email" placeholder="* البريد الإلكتروني" value="helloworld@gmail.com" required/>
    </div>
    <div class="w-full mb-20">
        <input class="border-b-2 py-2 border-[#555] w-full  text-right outline-none focus:outline-none" name="password"  placeholder="* كلمة المرور" value="123456789" required/>
    </div>
    <div class="w-full mb-20">
        <input class="border-b-2 py-2 border-[#555] w-full  text-right outline-none focus:outline-none" name="confirm"  placeholder="* تأكيد كلمة المرور" value="123456789" required/>
    </div>
    <div class="w-full mb-20">
        <input class="border-b-2 py-2 border-[#555] w-full  text-right outline-none focus:outline-none" name="phone" placeholder="* رقم الهاتف" value="0627748714" required/>
    </div>
    <div class="w-full mb-20">
        <input class="border-b-2 py-2 border-[#555] w-full  text-right outline-none focus:outline-none" name="city"  placeholder="المدينة" value="rabat" />
    </div>
    <div class="w-full mb-20">
        <x-select-country :country="" />
    </div>
    <div class="flex items-center gap-10">
        <a href="{{ route('login') }}">
            <button
                class="transition duration-150 hover:border-b-2 border-b-black-700" 
                type="button">لديك حساب؟ سجل الدخول</button>
        </a>
        <button class="bg-[#0292cf] text-white px-3 py-2 rounded">تسجيل</button>
    </div>
    <div class="text-red-700 self-end opacity-70 mt-5 text-right">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="mt-1">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @csrf
</form>