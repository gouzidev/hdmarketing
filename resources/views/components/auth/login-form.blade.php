<form
    class="flex flex-col items-center w-9/12 mx-auto mb-20"
    action="{{ route('/login') }}" method="POST">

    <div class="w-full mb-20">
        <input class="border-b-2 py-2 border-[#555] w-full  text-right outline-none focus:outline-none" name="email"  placeholder="*البريد الإلكتروني" required/>
    </div>
    <div class="w-full mb-20">
        <input class="border-b-2 py-2 border-[#555] w-full  text-right outline-none focus:outline-none" name="password"  placeholder="* كلمة المرور" required/>
    </div>
    <button class="bg-[#0292cf] text-white items-end self-end px-3 py-2 rounded">تسجيل الدخول</button>
    @csrf
    @if ($errors->any())
    <div class="text-red-700 self-start opacity-70">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</form>