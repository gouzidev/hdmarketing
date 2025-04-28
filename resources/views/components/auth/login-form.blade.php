<form
    class="flex flex-col items-start w-9/12 mx-auto mb-20 gap-10"
    action="{{ route('login') }}" method="POST">

    <div class="w-full min-w-[200px]">
        <div class="relative">
          <input type="text" class="w-full pl-3 pr-10 py-2 bg-transparent placeholder:text-slate-400 text-slate-600
           text-lg border border-slate-200 rounded-md transition duration-300 ease focus:outline-none focus:border-slate-400
            hover:border-slate-300 shadow-sm focus:shadow" name="email"  placeholder="*البريد الإلكتروني" required />
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="absolute w-5 h-5 top-2.5 right-2.5 text-slate-600">
            <path d="M4.5 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125
             0 0 1-8.25 0ZM14.25 8.625a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0ZM1.5 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM17.25 19.128l-.001.144a2.25 2.25 0 0 1-.233.96 10.088 10.088 0 0 0 5.06-1.01.75.75 0 0 0 .42-.643 4.875 4.875 0 0 0-6.957-4.611 8.586 8.586 0 0 1 1.71 5.157v.003Z"></path>
          </svg>
        </div>
      </div>

      <div class="w-full min-w-[200px]">
        <div class="relative">
          <input type="{{ $pwvisible ? 'text' : 'password' }}" class="w-full pr-3 pr-10 py-2 bg-transparent placeholder:text-slate-400 text-slate-600
           text-lg border border-slate-200 rounded-md transition duration-300 ease focus:outline-none focus:border-slate-400
            hover:border-slate-300 shadow-sm focus:shadow" name="password"  placeholder="* كلمة المرور" required/>
           <img id="togglePasswordIcon" src="{{ $pwvisible ? asset('images/hide_pw.svg') : asset('images/show_pw.svg') }}" alt="show password" 
            class="contrast-0 cursor-pointer absolute w-5 h-5 top-3 left-2.5 text-slate-600">
        </div>
      </div>

    <div class="flex items-center flex-col-reverse sm:flex-row w-full gap-5 sm:gap-10">
        <a href="{{ route('register') }}">
            <button
                class=" sm:w-full
                transition duration-150
                text-xs sm:text-md xl:text-lg
                hover:border-b-2 border-b-black-700" 
                type="button">
                لا تملك حساباً؟ سجل الآن
            </button>
        </a>
        <button class="
        w-full sm:w-1/4
        px-2 py-2
        sm:px-5 sm:py-2
        rounded bg-yellow-600 border border-transparent
         rounded-md font-semibold  text-xs sm:text-md xl:text-lg text-white
            uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900
            focus:outline-none focus:ring-2 focus:ring-yellow-500
            focus:ring-offset-2 transition ease-in-out duration-150">تسجيل الدخول</button>
        {{-- <button class="bg-[#0292cf] text-white  px-3 py-2 rounded">تسجيل الدخول</button> --}}
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