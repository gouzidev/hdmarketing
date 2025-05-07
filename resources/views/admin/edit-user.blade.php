<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المستخدمين</title>
    <script src="https://cdn.tailwindcss.com"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-scripts.tailwind-script />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <x-scripts.fonts-import />
    <style>
        [dir="rtl"] .space-x-reverse > :not([hidden]) ~ :not([hidden]) {
            --tw-space-x-reverse: 0;
            margin-left: 0;
            margin-right: calc(0.75rem * var(--tw-space-x-reverse));
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <x-nav :isHome='false'/>
    
    <div class="flex flex-col items-center w-9/12 mx-auto my-10">
        <!-- Verification Status Section (Standalone) -->
        <div class="w-full mb-6 bg-white p-4 rounded-lg shadow border border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center">
                    @if($user->is_admin)
                        <div class="flex items-center">
                            <i class="fas fa-shield-alt text-purple-600 text-xl ml-2"></i>
                            <div>
                                <h3 class="text-gray-800 font-medium">حساب مدير النظام</h3>
                                <p class="text-sm text-gray-500">لا يمكن تعديل حالة هذا الحساب</p>
                            </div>
                        </div>
                    @else

                        <div class="flex items-center">
                            @if($user->verified)
                                <i class="fas fa-check-circle text-green-500 text-xl ml-2"></i>
                                <div>
                                    <h3 class="text-gray-800 font-medium">الحساب موثّق</h3>
                                    @if ($user->verified_at)
                                        <p class="text-sm text-gray-500">تم التحقق في {{ $user->verified_at->format('Y/m/d') }} </p>
                                    @endif
                                </div>
                            @else
                                <i class="fas fa-clock text-yellow-500 text-xl ml-2"></i>
                                <div>
                                    <h3 class="text-gray-800 font-medium">الحساب قيد المراجعة</h3>
                                    <p class="text-sm text-gray-500">لم يتم التحقق بعد</p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                @if(auth()->user()->is_admin && !$user->is_admin)
                    <div class="flex space-x-3 space-x-reverse">
                        @if(!$user->verified)
                            <form action="{{ route('admin.users.verify', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md transition flex items-center gap-2">
                                    <i class="fas fa-check"></i>
                                    <span>توثيق</span>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.users.verify', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md transition flex items-center gap-2">
                                    <i class="fas fa-times"></i>
                                    <span>إلغاء التوثيق</span>
                                </button>
                            </form>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Main Edit Form (Separate from verification) -->
        <form class="w-full bg-white p-6 rounded-lg shadow border border-gray-200" 
            action="{{ route('admin.users.update', $user) }}" method="POST">
            <!-- Form Header -->
            <div class="w-full mb-6 text-right">
                <h2 class="text-2xl font-bold text-gray-800">تعديل الملف الشخصي</h2>
                <p class="text-gray-600 mt-2">قم بتحديث معلوماتك الشخصية هنا</p>
            </div>

            <!-- Input Fields -->
            <div class="w-full mb-8 relative group">
                <label class="block text-right text-gray-700 mb-1 text-sm">اسم المستخدم</label>
                <div class="flex items-center border-b-2 border-gray-300 focus-within:border-yellow-500 transition-colors">
                    <button type="button" class="text-yellow-500 hover:text-yellow-700 px-2 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </button>
                    <input disabled class="disabled:text-gray-300 py-3 px-2 w-full text-right outline-none bg-transparent text-gray-800 placeholder-gray-400" 
                        name="name" placeholder="اسم المستخدم" value="{{ $user->name }}"/>
                </div>
            </div>
        
            <div class="w-full mb-8 relative group">
                <label class="block text-right text-gray-700 mb-1 text-sm">البريد الإلكتروني</label>
                <div class="flex items-center border-b-2 border-gray-300 focus-within:border-yellow-500 transition-colors">
                    <button type="button" class="text-yellow-500 hover:text-yellow-700 px-2 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </button>
                    <input disabled class="disabled:text-gray-300 py-3 px-2 w-full text-right outline-none bg-transparent text-gray-800 placeholder-gray-400" 
                        name="email" type="email" placeholder="البريد الإلكتروني" value="{{ $user->email }}"/>
                </div>
            </div>
        
            <div class="w-full mb-8 relative group">
                <label class="block text-right text-gray-700 mb-1 text-sm">رقم الهاتف</label>
                <div class="flex items-center border-b-2 border-gray-300 focus-within:border-yellow-500 transition-colors">
                    <button type="button" class="text-yellow-500 hover:text-yellow-700 px-2 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </button>
                    <input disabled class="disabled:text-gray-300 py-3 px-2 w-full text-right outline-none bg-transparent text-gray-800 placeholder-gray-400" 
                        name="phone" placeholder="رقم الهاتف" value="{{ $user->phone }}"/>
                </div>
            </div>
        
            <div class="w-full mb-8 relative group">
                <label class="block text-right text-gray-700 mb-1 text-sm">المدينة</label>
                <div class="flex items-center border-b-2 border-gray-300 focus-within:border-yellow-500 transition-colors">
                    <button type="button" class="text-yellow-500 hover:text-yellow-700 px-2 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </button>
                    <input disabled class="disabled:text-gray-300 py-3 px-2 w-full text-right outline-none bg-transparent text-gray-800 placeholder-gray-400" 
                        name="city" placeholder="المدينة" value="{{ $user->city }}"/>
                </div>
            </div>
        
            <!-- Country Select -->
            <div class="w-full mb-8 relative group">
                <label class="block text-right text-gray-700 mb-1 text-sm">البلد</label>
                <div class="flex items-center border-b-2 border-gray-300 focus-within:border-yellow-500 transition-colors">
                    <x-select-country :country="$user->country" />
                </div>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="w-full mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <h3 class="text-red-700 font-medium mb-2">يوجد أخطاء في المدخلات:</h3>
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
        
            <!-- Submit Button -->
            <div class="w-full mt-6">
                <button type="submit" class="w-full py-3 px-6 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors font-medium text-lg">
                    حفظ التغييرات
                </button>
            </div>
            @csrf
            @method('PUT')
        </form>
    </div>
    <script src="{{ asset('js/profile/edit.js') }}"></script>
</body>
</html>