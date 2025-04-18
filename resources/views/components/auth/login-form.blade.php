<form
    class="flex flex-col items-start w-9/12 mx-auto mb-20"
    action="{{ route('login') }}" method="POST">

    <div class="w-full mb-20">
        <input class="border-b-2 py-2 border-[#555] w-full  text-right outline-none focus:outline-none" name="email"  placeholder="*البريد الإلكتروني" required/>
    </div>
    <div class="w-full mb-20">
        <input class="border-b-2 py-2 border-[#555] w-full  text-right outline-none focus:outline-none" name="password"  placeholder="* كلمة المرور" required/>
    </div>
    <div class="flex items-center gap-10">
        <a href="{{ route('register') }}">
            <button
                class="transition duration-150 hover:border-b-2 border-b-black-700" 
                type="button">
                لا تملك حساباً؟ سجل الآن
            </button>
        </a>
        <button class="bg-[#0292cf] text-white  px-3 py-2 rounded">تسجيل الدخول</button>
    </div>
    
    @csrf
    @if($errors->any())
    <div class="w-full mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
        <h3 class="text-red-700 font-medium mb-2">يوجد خطأ:</h3>
        <ul class="text-red-600 list-disc pr-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @elseif (session('success'))
        <div class="w-full mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700">
            {{ session('success') }}
        </div>
    @endif
</form>