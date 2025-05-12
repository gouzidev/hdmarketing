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
        /* Updated selector for radio buttons */
        .category-container input[type=radio]:checked + label {
            background: black;
            color: yellow;
        }
        /* Ensure hover doesn't override selected state */
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
                                <input type="number" step="any" name="price" id="price" 
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
                                value={{ $product->stock }} type="number" 
                                name="stock" id="stock" 
                                class="
                                    [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none
                                    text-right w-full rounded-md shadow-sm focus:border-b-1 border-[yellow] focus:outline-none" min="0" required>
                        </div>
                        
                        <!-- Description -->
                        <div class="flex flex-col">
                            <label for="desc" class="block text-sm font-medium text-gray-700 mb-1">وصف المنتج</label>
                            <textarea name="desc" id="desc" class="px-2 text-right w-full h-20 shadow-sm focus:border-b-1 border-[yellow] transition focus:outline-none">{{ $product->desc }}</textarea>
                        </div>
                    </div>
                    
                    {{-- Categories --}}
                    <div class="flex flex-col my-2">
                        <label class="underline underline-offset-8 text-sm block md:text-lg xl:text-2xl font-medium text-gray-700 mb-5">التصنيف</label>
                        <div class="flex flex-row flex-wrap justify-center xl:justify-start gap-10">
                            {{-- ملابس (Clothing) --}}
                            <div class="category-container">
                                <input type="radio" name="category" hidden value="clothes" 
                                {{ $product->category == "clothes" ? 'checked' : '' }}
                                id="category-clothes" />
                                <label for="category-clothes" class="flex flex-col items-center justify-center transition p-4 cursor-pointer border-4 border-gray-300 hover:bg-gray-200 text-gray-900 rounded-xl min-w-[100px] h-[100px] lg:h-[120px] lg:min-w-[120px] xl:h-[140px] xl:min-w-[140px]">
                                    <i class="fas fa-tshirt text-2xl lg:text-3xl mb-2"></i>
                                    <div class="text-sm sm:text-xl">ملابس</div>
                                </label>
                            </div>
                    
                            {{-- المنزل و المطبخ (Home & Kitchen) --}}
                            <div class="category-container">
                                <input type="radio" name="category" hidden value="kitchen_home" 
                                {{ $product->category == "kitchen_home" ? 'checked' : '' }}
                                id="category-kitchen_home" />
                                <label for="category-kitchen_home" class="flex flex-col items-center justify-center transition p-4 cursor-pointer border-4 border-gray-300 hover:bg-gray-200 text-gray-900 rounded-xl min-w-[100px] h-[100px] lg:h-[120px] lg:min-w-[120px] xl:h-[140px] xl:min-w-[140px]">
                                    <i class="fas fa-home text-2xl lg:text-3xl mb-2"></i>
                                    <div class="text-sm sm:text-xl">المنزل و المطبخ</div>
                                </label>
                            </div>
                    
                            {{-- الصحة و الجمال (Health & Beauty) --}}
                            <div class="category-container">
                                <input type="radio" name="category" hidden value="beauty_health" 
                                {{ $product->category == "beauty_health" ? 'checked' : '' }}
                                id="category-beauty_health" />
                                <label for="category-beauty_health" class="flex flex-col items-center justify-center transition p-4 cursor-pointer border-4 border-gray-300 hover:bg-gray-200 text-gray-900 rounded-xl min-w-[100px] h-[100px] lg:h-[120px] lg:min-w-[120px] xl:h-[140px] xl:min-w-[140px]">
                                    <i class="fas fa-spa text-2xl lg:text-3xl mb-2"></i>
                                    <div class="text-sm sm:text-xl">الصحة و الجمال</div>
                                </label>
                            </div>
                    
                            {{-- هواتف و اجهزة ذكيه (Electronics) --}}
                            <div class="category-container">
                                <input type="radio" name="category" hidden value="electronics" 
                                {{ $product->category == "electronics" ? 'checked' : '' }}
                                id="category-electronics" />
                                <label for="category-electronics" class="flex flex-col items-center justify-center transition p-4 cursor-pointer border-4 border-gray-300 hover:bg-gray-200 text-gray-900 rounded-xl min-w-[100px] h-[100px] lg:h-[120px] lg:min-w-[120px] xl:h-[140px] xl:min-w-[140px]">
                                    <i class="fas fa-mobile-alt text-2xl lg:text-3xl mb-2"></i>
                                    <div class="text-sm sm:text-xl">هواتف و أجهزة ذكية</div>
                                </label>
                            </div>
                    
                            {{-- بيع العقار (Real Estate) --}}
                            <div class="category-container">
                                <input type="radio" name="category" hidden value="real_estate" 
                                {{ $product->category == "" ? 'checked' : '' }}
                                id="category-real_estate" />
                                <label for="category-real_estate" class="flex flex-col items-center justify-center transition p-4 cursor-pointer border-4 border-gray-300 hover:bg-gray-200 text-gray-900 rounded-xl min-w-[100px] h-[100px] lg:h-[120px] lg:min-w-[120px] xl:h-[140px] xl:min-w-[140px]">
                                    <i class="fas fa-building text-2xl lg:text-3xl mb-2"></i>
                                    <div class="text-sm sm:text-xl">بيع العقار</div>
                                </label>
                            </div>
                    
                            {{-- بيع السيارات (Cars) --}}
                            <div class="category-container">
                                <input type="radio" name="category" hidden value="cars" 
                                {{ $product->category == "" ? 'checked' : '' }}
                                id="category-cars" />
                                <label for="category-cars" class="flex flex-col items-center justify-center transition p-4 cursor-pointer border-4 border-gray-300 hover:bg-gray-200 text-gray-900 rounded-xl min-w-[100px] h-[100px] lg:h-[120px] lg:min-w-[120px] xl:h-[140px] xl:min-w-[140px]">
                                    <i class="fas fa-car text-2xl lg:text-3xl mb-2"></i>
                                    <div class="text-sm sm:text-xl">بيع السيارات</div>
                                </label>
                            </div>
                        </div>
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

                <div class="w-[300px] h-[300px] flex justify-center items-center relative">
                    <form class="absolute top-2 right-2" action="{{ route('products.images.destroy', $product->primary_image) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" 
                            class=" text-red-600 hover:text-red-900 bg-red-100 p-3 rounded-md" 
                            title="حذف">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                    <img class="h-full w-full object-contain" src="{{ route('products.thumbnail', $product) }}" alt="">
                </div>
            </div>
        </div>
    </main>
    </div>

        <script>
            // Image Gallery Functionality
            function changeMainImage(src, element) {
                const mainImage = document.getElementById('mainImage');
                mainImage.src = src;
                
                // Update active thumbnail
                document.querySelectorAll('.gallery-thumbnail').forEach(thumb => {
                    thumb.classList.remove('active');
                });
                element.classList.add('active');
            }
            
            
            
            // Quantity buttons
            document.addEventListener('DOMContentLoaded', function() {
                const decreaseBtn = document.getElementById('decreaseQuantity');
                const increaseBtn = document.getElementById('increaseQuantity');
                const quantityInput = document.getElementById('quantityInput');
                
                if (decreaseBtn && increaseBtn && quantityInput) {
                    decreaseBtn.addEventListener('click', function() {
                        if (parseInt(quantityInput.value) > 1) {
                            quantityInput.value = parseInt(quantityInput.value) - 1;
                        }
                    });
                    
                    increaseBtn.addEventListener('click', function() {
                        if (parseInt(quantityInput.value) < parseInt(quantityInput.max)) {
                            quantityInput.value = parseInt(quantityInput.value) + 1;
                        }
                    });
                }
            });
            
            // Modal functions
            function openModal(deleteUrl) {
                document.getElementById('deleteForm').action = deleteUrl;
                document.getElementById('deleteModal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('deleteModal').classList.add('hidden');
            }

            window.onclick = function(event) {
                const modal = document.getElementById('deleteModal');
                if (event.target == modal) {
                    closeModal();
                }
            }
        </script>

</body>
</html>