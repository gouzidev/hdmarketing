

<form class="flex flex-col items-center w-9/12 mx-auto my-10" action="{{ route('profile.edit') }}" method="POST">
    <!-- Form Header -->
    <div class="w-full mb-10 text-right">
        <h2 class="text-2xl font-bold text-gray-800">تعديل الملف الشخصي</h2>
        <p class="text-gray-600 mt-2">قم بتحديث معلوماتك الشخصية هنا</p>
    </div>

    <!-- Input Fields -->
    <div class="w-full mb-8 relative group">
        <label class="block text-right text-gray-700 mb-1 text-sm">اسم المستخدم</label>
        <div class="flex items-center border-b-2 border-gray-300 focus-within:border-blue-500 transition-colors">
            <input disabled class="disabled:text-gray-300 py-3 px-2 w-full text-right outline-none bg-transparent text-gray-800 placeholder-gray-400" 
                   name="name" placeholder="اسم المستخدم" value="{{ $user['name'] }}"/>
            <button type="button" class="text-blue-500 hover:text-blue-700 px-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
            </button>
        </div>
    </div>

    <div class="w-full mb-8 relative group">
        <label class="block text-right text-gray-700 mb-1 text-sm">البريد الإلكتروني</label>
        <div class="flex items-center border-b-2 border-gray-300 focus-within:border-blue-500 transition-colors">
            <input disabled class="disabled:text-gray-300 py-3 px-2 w-full text-right outline-none bg-transparent text-gray-800 placeholder-gray-400" 
                   name="email" type="email" placeholder="البريد الإلكتروني" value="{{ $user['email'] }}"/>
            <button type="button" class="text-blue-500 hover:text-blue-700 px-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
            </button>
        </div>
    </div>

    <div class="w-full mb-8 relative group">
        <label class="block text-right text-gray-700 mb-1 text-sm">رقم الهاتف</label>
        <div class="flex items-center border-b-2 border-gray-300 focus-within:border-blue-500 transition-colors">
            <input disabled class="disabled:text-gray-300 py-3 px-2 w-full text-right outline-none bg-transparent text-gray-800 placeholder-gray-400" 
                   name="phone" placeholder="رقم الهاتف" value="{{ $user['phone'] }}"/>
            <button type="button" class="text-blue-500 hover:text-blue-700 px-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
            </button>
        </div>
    </div>

    <div class="w-full mb-8 relative group">
        <label class="block text-right text-gray-700 mb-1 text-sm">المدينة</label>
        <div class="flex items-center border-b-2 border-gray-300 focus-within:border-blue-500 transition-colors">
            <input disabled class="disabled:text-gray-300 py-3 px-2 w-full text-right outline-none bg-transparent text-gray-800 placeholder-gray-400" 
                   name="city" placeholder="المدينة" value="{{ $user['city'] }}"/>
            <button type="button" class="text-blue-500 hover:text-blue-700 px-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Password Fields -->
    <div class="w-full mb-8 relative group">
        <label class="block text-right text-gray-700 mb-1 text-sm">كلمة المرور الجديدة</label>
        <div class="flex items-center border-b-2 border-gray-300 focus-within:border-blue-500 transition-colors">
            <input disabled class="disabled:text-gray-300 py-3 px-2 w-full text-right outline-none bg-transparent text-gray-800 placeholder-gray-400" 
                   name="password" type="password" placeholder="كلمة المرور" />
            <button type="button" class="text-blue-500 hover:text-blue-700 px-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
            </button>
        </div>
    </div>

    <div class="w-full mb-8 relative group">
        <label class="block text-right text-gray-700 mb-1 text-sm">تأكيد كلمة المرور</label>
        <div class="flex items-center border-b-2 border-gray-300 focus-within:border-blue-500 transition-colors">
            <input disabled class="disabled:text-gray-300 py-3 px-2 w-full text-right outline-none bg-transparent text-gray-800 placeholder-gray-400" 
                   name="confirm" type="password" placeholder="تأكيد كلمة المرور" />
            <button type="button" class="text-blue-500 hover:text-blue-700 px-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Country Select -->
    <div class="w-full mb-8 relative group">
        <label class="block text-right text-gray-700 mb-1 text-sm">البلد</label>
        <div class="flex items-center border-b-2 border-gray-300 focus-within:border-blue-500 transition-colors">
            <select class="bg-transparent border-b-2 border-[#555] w-full text-right outline-none focus:outline-none text-gray" name="country" dir="rtl" required>
                <option disabled value="">البلد</option>
                <option @if ($user["country"] == "LY") selected @endif value="LY">ليبيا</option>
                <option @if ($user["country"] == "TN") selected @endif value="TN">تونس</option>
                <option @if ($user["country"] == "DZ") selected @endif value="DZ">الجزائر</option>
                <option @if ($user["country"] == "MR") selected @endif value="MR">موريتانيا</option>
                <option @if ($user["country"] == "EG") selected @endif value="EG">مصر</option>
                <option @if ($user["country"] == "MA") selected @endif value="MA">المغرب</option>
                <option @if ($user["country"] == "JO") selected @endif value="JO">الأردن</option>
                <option @if ($user["country"] == "KW") selected @endif value="KW">الكويت</option>
                <option @if ($user["country"] == "BH") selected @endif value="BH">البحرين</option>
                <option @if ($user["country"] == "QA") selected @endif value="QA">قطر</option>
                <option @if ($user["country"] == "OM") selected @endif value="OM">عمان</option>
                <option @if ($user["country"] == "LB") selected @endif value="LB">لبنان</option>
                <option @if ($user["country"] == "SD") selected @endif value="SD">السودان</option>
                <option @if ($user["country"] == "IQ") selected @endif value="IQ">العراق</option>
                <option @if ($user["country"] == "YE") selected @endif value="YE">اليمن</option>
                <option @if ($user["country"] == "SY") selected @endif value="SY">سوريا</option>
                <option @if ($user["country"] == "PS") selected @endif value="PS">فلسطين</option>
                <option @if ($user["country"] == "SO") selected @endif value="SO">الصومال</option>
                <option @if ($user["country"] == "DJ") selected @endif value="DJ">جيبوتي</option>
                <option @if ($user["country"] == "KM") selected @endif value="KM">جزر القمر</option>
                <option @if ($user["country"] == "SA") selected @endif value="SA">المملكة العربية السعودية</option>
                <option @if ($user["country"] == "AE") selected @endif value="AE">الإمارات العربية المتحدة</option>
                <option @if ($user["country"] == "") selected @endif value="">غير محدد</option>
            </select>
        </div>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
    <div class="w-full mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-right">
        <h3 class="text-red-700 font-medium mb-2">يوجد أخطاء في المدخلات:</h3>
        <ul class="text-red-600 list-disc pr-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @elseif (session('success'))
    <div class="text-green-600 mb-4 text-right">
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