
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الشحن</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-gray-100">
    <x-nav :isHome='false'/>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center mb-6">
            <a href="{{ route('admin.shipping.index') }}" class="text-gray-600 hover:text-gray-900 ml-2">
                <i class="fas fa-arrow-right"></i>
            </a>
            <h2 class="text-2xl font-bold text-gray-800">إضافة طريقة شحن جديدة</h2>
        </div>

        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
            <div class="p-6 bg-gradient-to-l from-yellow-50 to-white border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                    <i class="fas fa-truck text-yellow-600 ml-2"></i>
                    تفاصيل طريقة الشحن
                </h3>
                <p class="text-gray-600 mt-1">أدخل معلومات طريقة الشحن الجديدة</p>
            </div>
            
            <form action="{{ route('admin.shipping.store') }}" method="POST" class="p-6">
                @csrf
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="country" class="text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="fas fa-globe text-gray-400 ml-1"></i>
                            الدولة
                        </label>
                        <input type="text" name="country" id="country" value="{{ old('country') }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                        @error('country')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="city" class="text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="fas fa-city text-gray-400 ml-1"></i>
                            المدينة
                        </label>
                        <input type="text" name="city" id="city" value="{{ old('city') }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                        @error('city')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="street" class="text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="fas fa-road text-gray-400 ml-1"></i>
                            الشارع
                        </label>
                        <input type="text" name="street" id="street" value="{{ old('street') }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                        @error('street')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="price" class="text-sm font-medium text-gray-700 mb-1 flex items-center">
                            <i class="fas fa-dollar-sign text-gray-400 ml-1"></i>
                            سعر الشحن
                        </label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" name="price" id="price" value="{{ old('price') }}" required min="0" step="0.01"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 pr-8">
                        </div>
                        @error('price')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 text-left">
                    <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white py-2 px-4 rounded-lg font-medium flex items-center transition-colors duration-300 shadow-md">
                        <i class="fas fa-save ml-2"></i>
                        حفظ طريقة الشحن
                    </button>
                </div>
                @if ($errors->any())
                    <div class="text-red-700 opacity-70 mt-5 text-right">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="mt-1">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @elseif (session('success'))
                    <div class="w-full mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700">
                        {{ session('success') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
  
</body>
</html>