<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المنتجات</title>
    <script src="https://cdn.tailwindcss.com"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-scripts.tailwind-script />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <x-scripts.fonts-import />
    <style>
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <x-nav :isHome='false'/>
    <div class="min-h-screen">
        <!-- Page Heading -->
        <header class="bg-yellow-200 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    تعديل المنتج
                </h2>
                @if (auth()->user()->is_admin)
                    <a href="{{ route('products.create') }}" 
                        class="inline-flex items-center px-4 py-2 
                            bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white
                            uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900
                            focus:outline-none focus:ring-2 focus:ring-yellow-500
                            focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fas fa-plus ml-2"></i> إضافة منتج جديد
                    </a>
                @endif
            </div>
        </header>

<!-- After the header and before the products grid -->
    <header class="bg-yellow-200 shadow">

    </header>
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form id="productForm" method="POST" action="{{ route('products.product.update', $product) }}" class="flex flex-col gap-6">
                    @csrf
                    @method('PUT')
                    <h3 class="text-lg font-medium text-gray-900">معلومات المنتج</h3>
                    <div class="flex flex-col gap-4">
                        <!-- Product Name -->
                        <div class="flex flex-col">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">اسم المنتج</label>
                            <input type="text" value="{{ $product->name }}" name="name" id="name" class="text-right w-full rounded-md shadow-sm focus:border-b-1 border-[yellow] focus:outline-none" required>
                        </div>
                        
                        <!-- Price -->
                        <div class="flex flex-col">
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">السعر</label>
                            <div class="relative">
                                <input value="700.00" type="number" step="any" name="price" id="price" 
                                    class="text-right w-full rounded-md shadow-sm focus:border-b-1
                                        [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none
                                    border-[yellow] focus:outline-none" min="0" required
                                    value={{ $product->price }}
                                    >
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">بالدولار $</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Stock -->
                        <div class="flex flex-col">
                            <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">المخزون</label>
                            <input 
                                value={{ $product->stock }}
                                value="24" type="number" 
                                name="stock" id="stock" 
                                class="
                                    [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none
                                    text-right w-full rounded-md shadow-sm focus:border-b-1 border-[yellow] focus:outline-none" min="0" required>
                        </div>
                        
                        <!-- Description -->
                        <div class="flex flex-col">
                            <label for="desc" class="block text-sm font-medium text-gray-700 mb-1">وصف المنتج</label>
                            <textarea name="desc" id="desc" class="px-2 text-right w-full h-20 shadow-sm focus:border-b-1 border-[yellow] transition focus:outline-none">
                                {{ $product->desc }}
                            </textarea>
                        </div>
                    </div>
                    
                    <!-- Image Upload Section -->

                    <div class="w-100 h-100 flex justify-center items-center">
                        <img class="
                        h-full w-full object-contain" src="{{ route('products.thumbnail', $product) }}" alt="">
                    </div>
                    {{-- <div class="flex flex-col gap-4">
                        <h3 class="text-lg font-medium text-gray-900">صور المنتج</h3>
                        
                        <!-- Primary Image Field -->
                        <div class="flex flex-col">
                            <label class="block text-sm font-medium text-gray-700 mb-1">الصورة الرئيسية (مطلوبة)</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center" id="primary-dropzone">
                                <input type="file" 
                                    name="primary_image" 
                                    id="primary_image" accept="image/*"
                                    class="hidden" required>
                                <label for="primary_image" class="cursor-pointer">
                                    <div class="flex flex-col items-center gap-1">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                                        <p class="text-sm text-gray-600">انقر لاختيار الصورة الرئيسية</p>
                                        <p class="text-xs text-gray-500">jpg, png (حجم أقل من 2MB)</p>
                                    </div>
                                </label>
                            </div>
                            <!-- Primary Image Preview -->
                            <div id="primary-preview" class="mt-2 flex flex-wrap gap-4"></div>
                        </div>
                        
                        <!-- Additional Images Field -->
                        <div class="flex flex-col">
                            <label class="block text-sm font-medium text-gray-700 mb-1">صور إضافية (اختيارية)</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center" id="additional-dropzone">
                                <input type="file" name="additional_images[]" id="additional_images" multiple accept="image/*" class="hidden">
                                <label for="additional_images" class="cursor-pointer">
                                    <div class="flex flex-col items-center gap-1">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                                        <p class="text-sm text-gray-600">اسحب وأفلت الصور هنا أو انقر للاختيار</p>
                                        <p class="text-xs text-gray-500">يمكنك تحميل عدة صور (jpg, png)</p>
                                    </div>
                                </label>
                            </div>
                            <!-- Additional Images Preview -->
                            <div id="additional-preview" class="mt-2 flex flex-wrap gap-4"></div>
                        </div>
                    </div> --}}

                    @if($errors->any())
                    <div class="w-full mb-6 p-4 bg-red-50 border border-red-200 rounded-lg self-start">
                        <h3 class="text-red-700 font-medium mb-2">يوجد أخطاء في المدخلات:</h3>
                        <ul class="text-red-600 list-disc pr-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @elseif (@session('error'))
                        <div class="mt-4 p-4 bg-red-50 text-red-700 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @elseif (@session('warning'))
                        <div class="mt-4 p-4 bg-yellow-50 text-yellow-700 rounded-lg">
                            test
                        </div>
                    @elseif (session('success'))
                        <div class="text-green-600 mb-4 self-start">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Submit Buttons -->
                    <div class="flex justify-end gap-3">
                        <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 mr-3">
                            إلغاء
                        </button>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700
                            active:bg-yellow-900 focus:outline-none 
                            focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="fas fa-save ml-2"></i> حفظ المنتج
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    </div>
</body>
</html>