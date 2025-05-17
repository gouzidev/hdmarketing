

<form class="flex flex-col items-center max-w-7xl mx-auto my-10 bg-white rounded-xl p-5 shadow-lg" action="{{ route('profile.edit') }}" method="POST">
    <!-- Input Fields -->
    <div class="w-full mb-8 relative group">
        <label class="block text-right text-gray-700 mb-1 text-sm">اسم المستخدم</label>
        <div class="flex items-center border-b-2 border-gray-300 focus-within:border-blue-500 transition-colors">
            <button type="button" class="text-blue-500 hover:text-blue-700 px-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
            </button>
            <input disabled class="disabled:text-gray-300 py-3 px-2 w-full text-right outline-none bg-transparent text-gray-800 placeholder-gray-400" 
                   name="name" placeholder="اسم المستخدم" value="{{ $user['name'] }}"/>
        </div>
    </div>

    <div class="w-full mb-8 relative group">
        <label class="block text-right text-gray-700 mb-1 text-sm">البريد الإلكتروني</label>
        <div class="flex items-center border-b-2 border-gray-300 focus-within:border-blue-500 transition-colors">
            <button type="button" class="text-blue-500 hover:text-blue-700 px-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
            </button>
            <input disabled class="disabled:text-gray-300 py-3 px-2 w-full text-right outline-none bg-transparent text-gray-800 placeholder-gray-400" 
                   name="email" type="email" placeholder="البريد الإلكتروني" value="{{ $user['email'] }}"/>
        </div>
    </div>

    <div class="w-full mb-8 relative group">
        <label class="block text-right text-gray-700 mb-1 text-sm">رقم الهاتف</label>
        <div class="flex items-center border-b-2 border-gray-300 focus-within:border-blue-500 transition-colors">
            <button type="button" class="text-blue-500 hover:text-blue-700 px-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
            </button>
            <input disabled class="disabled:text-gray-300 py-3 px-2 w-full text-right outline-none bg-transparent text-gray-800 placeholder-gray-400" 
                   name="phone" placeholder="رقم الهاتف" value="{{ $user['phone'] }}"/>
        </div>
    </div>

    <div class="w-full mb-8 relative group">
        <label class="block text-right text-gray-700 mb-1 text-sm">المدينة</label>
        <div class="flex items-center border-b-2 border-gray-300 focus-within:border-blue-500 transition-colors">
            <button type="button" class="text-blue-500 hover:text-blue-700 px-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
            </button>
            <input disabled class="disabled:text-gray-300 py-3 px-2 w-full text-right outline-none bg-transparent text-gray-800 placeholder-gray-400" 
                   name="city" placeholder="المدينة" value="{{ $user['city'] }}"/>
        </div>
    </div>

    <!-- Password Fields -->
    <div class="w-full mb-8 relative group">
        <label class="block text-right text-gray-700 mb-1 text-sm">كلمة المرور الجديدة</label>
        <div class="flex items-center border-b-2 border-gray-300 focus-within:border-blue-500 transition-colors">
            <button type="button" class="text-blue-500 hover:text-blue-700 px-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
            </button>
            <input disabled class="disabled:text-gray-300 py-3 px-2 w-full text-right outline-none bg-transparent text-gray-800 placeholder-gray-400" 
                   name="password" type="password" placeholder="كلمة المرور" />
        </div>
    </div>

    <div class="w-full mb-8 relative group">
        <label class="block text-right text-gray-700 mb-1 text-sm">تأكيد كلمة المرور</label>
        <div class="flex items-center border-b-2 border-gray-300 focus-within:border-blue-500 transition-colors">
            <button type="button" class="text-blue-500 hover:text-blue-700 px-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
            </button>
            <input disabled class="disabled:text-gray-300 py-3 px-2 w-full text-right outline-none bg-transparent text-gray-800 placeholder-gray-400" 
                   name="confirm" type="password" placeholder="تأكيد كلمة المرور" />
        </div>
    </div>

    <!-- Country Select -->
    <div class="w-full mb-8 relative group">
        <label class="block text-right text-gray-700 mb-1 text-sm">البلد</label>
        <div class="flex items-center border-b-2 border-gray-300 focus-within:border-blue-500 transition-colors">
            <x-select-country :country="$user['country']" />
        </div>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
    <div class="w-full mb-6 p-4 bg-red-50 border border-red-200 rounded-lg self-start">
        <h3 class="text-red-700 font-medium mb-2">يوجد أخطاء في المدخلات:</h3>
        <ul class="text-red-600 list-disc pr-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @elseif (session('success'))
        <div class="text-green-600 mb-4 self-start">
            {{ session('success') }}
        </div>
    @endif

    <!-- Submit Button -->
    <div class="w-full mt-6">
        <button type="submit" class="w-full py-3 px-6 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors font-medium text-lg">
            حفظ التغييرات
        </button>
    </div>

    @csrf
</form>