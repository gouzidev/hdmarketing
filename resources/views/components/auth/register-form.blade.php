<form
    class="flex flex-col items-center  w-9/12 sm:w-full mx-auto mb-5 mt-5 gap-5"
    action="{{ route('register') }}" method="POST">

    <div class="relative sm:w-5/6 w-full ">
        <input type="text" class="w-full pl-3 pr-10 py-2 bg-transparent placeholder:text-slate-400 text-slate-600
         text-lg border border-slate-200 rounded-md transition duration-300 ease focus:outline-none focus:border-slate-400
          hover:border-slate-300 shadow-sm focus:shadow"  name="name"  placeholder="* اسم المستخدم" required/>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="absolute w-5 h-5 top-2.5 right-2.5 text-slate-600">
          <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
        </svg>
      </div>
   
    <div class="relative sm:w-5/6 w-full ">
        <input class="w-full pl-3 pr-10 py-2 bg-transparent placeholder:text-slate-400 text-slate-600
         text-lg border border-slate-200 rounded-md transition duration-300 ease focus:outline-none focus:border-slate-400
          hover:border-slate-300 shadow-sm focus:shadow" name="email" type="email" placeholder="* البريد الإلكتروني" required/>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="absolute w-5 h-5 top-2.5 right-2.5 text-slate-600">
          <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
          <path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
        </svg>
    </div>
    <div class="relative sm:w-5/6 w-full ">
        <input class="w-full pl-3 pr-10 py-2 bg-transparent placeholder:text-slate-400 text-slate-600
         text-lg border border-slate-200 rounded-md transition duration-300 ease focus:outline-none focus:border-slate-400
          hover:border-slate-300 shadow-sm focus:shadow" name="password" type="password" placeholder="* كلمة المرور" required/>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="absolute w-5 h-5 top-2.5 right-2.5 text-slate-600">
          <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
        </svg>
    </div>
    <div class="relative sm:w-5/6 w-full ">
        <input class="w-full pl-3 pr-10 py-2 bg-transparent placeholder:text-slate-400 text-slate-600
         text-lg border border-slate-200 rounded-md transition duration-300 ease focus:outline-none focus:border-slate-400
          hover:border-slate-300 shadow-sm focus:shadow" name="confirm" type="password" placeholder="* تأكيد كلمة المرور" required/>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="absolute w-5 h-5 top-2.5 right-2.5 text-slate-600">
          <path fill-rule="evenodd" d="M15.75 1.5a6.75 6.75 0 00-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 00-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 00.75-.75v-1.5h1.5A.75.75 0 009 19.5V18h1.5a.75.75 0 00.53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1015.75 1.5zm0 3a.75.75 0 000 1.5A2.25 2.25 0 0118 8.25a.75.75 0 001.5 0 3.75 3.75 0 00-3.75-3.75z" clip-rule="evenodd" />
        </svg>
    </div>
    <div class="relative sm:w-5/6 w-full ">
        <input class="w-full pl-3 pr-10 py-2 bg-transparent placeholder:text-slate-400 text-slate-600
         text-lg border border-slate-200 rounded-md transition duration-300 ease focus:outline-none focus:border-slate-400
          hover:border-slate-300 shadow-sm focus:shadow" name="phone" placeholder="* رقم الهاتف" required/>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="absolute w-5 h-5 top-2.5 right-2.5 text-slate-600">
          <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z" clip-rule="evenodd" />
        </svg>
    </div>
    <div class="relative sm:w-5/6 w-full ">
        <input class="w-full pl-3 pr-10 py-2 bg-transparent placeholder:text-slate-400 text-slate-600
         text-lg border border-slate-200 rounded-md transition duration-300 ease focus:outline-none focus:border-slate-400
          hover:border-slate-300 shadow-sm focus:shadow" name="city"  placeholder="المدينة" />
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="absolute w-5 h-5 top-2.5 right-2.5 text-slate-600">
          <path fill-rule="evenodd" d="M8.161 2.58a1.875 1.875 0 011.678 0l4.993 2.498c.106.052.23.052.336 0l3.869-1.935A1.875 1.875 0 0121.75 4.82v12.485c0 .71-.401 1.36-1.037 1.677l-4.875 2.437a1.875 1.875 0 01-1.676 0l-4.994-2.497a.375.375 0 00-.336 0l-3.868 1.935A1.875 1.875 0 012.25 19.18V6.695c0-.71.401-1.36 1.036-1.677l4.875-2.437zM9 6a.75.75 0 01.75.75V15a.75.75 0 01-1.5 0V6.75A.75.75 0 019 6zm6.75.75a.75.75 0 00-1.5 0V15a.75.75 0 001.5 0V6.75z" clip-rule="evenodd" />
        </svg>
    </div>
    <div class="relative sm:w-5/6 w-full ">
        <x-select-country country="" />
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" 
            class="absolute w-5 h-5 top-2.5 right-2.5 text-slate-600 pointer-events-none">
            <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
        </svg>
    </div>
    <div class="flex items-center gap-10  relative sm:w-5/6 w-full">
        <button class="
        w-full 
        px-5 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-md text-white
            uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900
            focus:outline-none focus:ring-2 focus:ring-yellow-500
            focus:ring-offset-2 transition ease-in-out duration-150">
            انشاء الحساب</button>

            
    </div>
    <div class="text-red-700  opacity-70 mt-5 sm:w-5/6 w-full">
      <ul>
            @foreach ($errors->all() as $error)
                <li class="mt-1">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @csrf
</form>