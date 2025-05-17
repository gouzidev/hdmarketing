<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل المنتج</title>
    <x-imports.index />
    
</head>
<body class="font-sans antialiased bg-dot-pat bg-gray-50">
    <x-layout.nav :isHome='false'/>
    <x-layout.sidebar />
    
    <x-layout.header :headerText="'تعديل المنتج: ' . $product->name" :btnText="'العودة للمنتجات'"
        :btnLink="route('products.index')"
        :btnClass="'inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-medium text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 shadow-sm transition-colors'"
        :btnIcon="'fas fa-arrow-right'"
        :icon="'fas fa-edit'"
    />
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Product Info Form -->
        <form id="productForm" method="POST" action="{{ route('products.product.update', $product) }}">
            @csrf
            @method('PUT')
            
            <div class="bg-white shadow rounded-lg overflow-hidden mb-6 border border-gray-200">
                <div class="p-5 border-b border-gray-200 bg-gradient-to-l from-yellow-50 to-white">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-box-open text-yellow-600 ml-3"></i>
                        معلومات المنتج الأساسية
                    </h2>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Product Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-tag text-yellow-600 ml-1"></i>
                                اسم المنتج <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ $product->name }}"
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 outline-none transition duration-200"
                                required>
                        </div>
                        
                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-money-bill-wave text-yellow-600 ml-1"></i>
                                السعر <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" step="0.01" name="price" id="price" value="{{ $product->price }}"
                                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 outline-none transition duration-200 pl-16"
                                    min="0" required>
                                <div class="absolute inset-y-0 left-0 flex items-center px-4 bg-gray-100 rounded-l-lg border-l-2 border-gray-300">
                                    <span class="text-gray-500 font-medium">LYD</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Stock -->
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-cubes text-yellow-600 ml-1"></i>
                                المخزون <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" name="stock" id="stock" value="{{ $product->stock }}"
                                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 outline-none transition duration-200"
                                    min="0" required>
                                <div class="absolute inset-y-0 left-0 flex items-center px-4 pointer-events-none">
                                    <span class="text-gray-400">قطعة</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="desc" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-align-left text-yellow-600 ml-1"></i>
                                وصف المنتج
                            </label>
                            <textarea name="desc" id="desc" rows="4" 
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 outline-none transition duration-200"
                                placeholder="اكتب وصفًا تفصيليًا للمنتج...">{{ $product->desc }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Categories -->
            <div class="bg-white shadow rounded-lg overflow-hidden mb-6 border border-gray-200">
                <div class="p-5 border-b border-gray-200 bg-gradient-to-l from-yellow-50 to-white">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-tags text-yellow-600 ml-3"></i>
                        تصنيف المنتج
                    </h2>
                </div>
                
                <div class="p-6">
                    <div class="flex flex-wrap gap-4 justify-center">
                        <!-- Clothing Category -->
                        <div>
                            <input type="radio" name="category" id="category-clothes" value="clothes" 
                                {{ $product->category == "clothes" ? 'checked' : '' }} class="hidden peer">
                            <label for="category-clothes" class="flex flex-col items-center justify-center w-28 h-28 p-4 bg-white border-2 border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 peer-checked:bg-yellow-500 peer-checked:border-yellow-600 peer-checked:text-white transition-all duration-200">
                                <i class="fas fa-tshirt text-2xl mb-2"></i>
                                <span class="text-sm font-medium">ملابس</span>
                            </label>
                        </div>
                        
                        <!-- Home & Kitchen Category -->
                        <div>
                            <input type="radio" name="category" id="category-kitchen_home" value="kitchen_home"
                                {{ $product->category == "kitchen_home" ? 'checked' : '' }} class="hidden peer">
                            <label for="category-kitchen_home" class="flex flex-col items-center justify-center w-28 h-28 p-4 bg-white border-2 border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 peer-checked:bg-yellow-500 peer-checked:border-yellow-600 peer-checked:text-white transition-all duration-200">
                                <i class="fas fa-home text-2xl mb-2"></i>
                                <span class="text-sm font-medium">المنزل و المطبخ</span>
                            </label>
                        </div>
                        
                        <!-- Health & Beauty Category -->
                        <div>
                            <input type="radio" name="category" id="category-beauty_health" value="beauty_health"
                                {{ $product->category == "beauty_health" ? 'checked' : '' }} class="hidden peer">
                            <label for="category-beauty_health" class="flex flex-col items-center justify-center w-28 h-28 p-4 bg-white border-2 border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 peer-checked:bg-yellow-500 peer-checked:border-yellow-600 peer-checked:text-white transition-all duration-200">
                                <i class="fas fa-spa text-2xl mb-2"></i>
                                <span class="text-sm font-medium">الصحة و الجمال</span>
                            </label>
                        </div>
                        
                        <!-- Electronics Category -->
                        <div>
                            <input type="radio" name="category" id="category-electronics" value="electronics"
                                {{ $product->category == "electronics" ? 'checked' : '' }} class="hidden peer">
                            <label for="category-electronics" class="flex flex-col items-center justify-center w-28 h-28 p-4 bg-white border-2 border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 peer-checked:bg-yellow-500 peer-checked:border-yellow-600 peer-checked:text-white transition-all duration-200">
                                <i class="fas fa-mobile-alt text-2xl mb-2"></i>
                                <span class="text-sm font-medium">هواتف و إلكترونيات</span>
                            </label>
                        </div>
                        
                        <!-- Real Estate Category -->
                        <div>
                            <input type="radio" name="category" id="category-real_estate" value="real_estate"
                                {{ $product->category == "real_estate" ? 'checked' : '' }} class="hidden peer">
                            <label for="category-real_estate" class="flex flex-col items-center justify-center w-28 h-28 p-4 bg-white border-2 border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 peer-checked:bg-yellow-500 peer-checked:border-yellow-600 peer-checked:text-white transition-all duration-200">
                                <i class="fas fa-building text-2xl mb-2"></i>
                                <span class="text-sm font-medium">بيع العقار</span>
                            </label>
                        </div>
                        
                        <!-- Cars Category -->
                        <div>
                            <input type="radio" name="category" id="category-cars" value="cars"
                                {{ $product->category == "cars" ? 'checked' : '' }} class="hidden peer">
                            <label for="category-cars" class="flex flex-col items-center justify-center w-28 h-28 p-4 bg-white border-2 border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 peer-checked:bg-yellow-500 peer-checked:border-yellow-600 peer-checked:text-white transition-all duration-200">
                                <i class="fas fa-car text-2xl mb-2"></i>
                                <span class="text-sm font-medium">بيع السيارات</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Submit buttons for info form -->
            <div class="flex justify-end mb-6">
                <a href="{{ route('products.index') }}" class="px-5 py-2 mr-2 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition flex items-center">
                    <i class="fas fa-times ml-1"></i>
                    إلغاء
                </a>
                
                <button type="submit" class="px-5 py-2 bg-yellow-600 rounded-lg text-white font-medium hover:bg-yellow-700 transition flex items-center shadow-md">
                    <i class="fas fa-save ml-1"></i>
                    حفظ التعديلات
                </button>
            </div>
        </form>
        
        <!-- Images Section -->
        <div class="bg-white shadow rounded-lg overflow-hidden mb-6 border border-gray-200">
            <div class="p-5 border-b border-gray-200 bg-gradient-to-l from-yellow-50 to-white">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-images text-yellow-600 ml-3"></i>
                    صور المنتج
                </h2>
            </div>
            
            <div class="p-6">
                <!-- Current Images -->
                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center mr-2">
                            <i class="fas fa-image text-yellow-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">الصورة الرئيسية</h3>
                    </div>
                    
                    <div class="flex justify-center md:justify-start">
                        <div class="relative bg-white rounded-lg border border-gray-200 p-2 shadow-sm hover:shadow-md transition-shadow">
                            <img src="{{ route('products.thumbnail', $product) }}" alt="{{ $product->name }}" class="w-64 h-64 object-contain">
                            <form class="absolute top-2 right-2" action="{{ route('products.images.destroy', $product->primary_image) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" 
                                    class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors"
                                    title="حذف الصورة"
                                    onclick="return confirm('هل أنت متأكد من حذف هذه الصورة؟')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Additional Images -->
                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mr-2">
                            <i class="fas fa-images text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">الصور الإضافية</h3>
                    </div>
                    
                    @if(count($product->additional_imgs) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($product->additional_imgs as $img)
                                <div class="relative bg-white rounded-lg border border-gray-200 p-2 shadow-sm hover:shadow-md transition-shadow">
                                    <img src="{{ route('products.images.show', $img->path) }}" alt="{{ $product->name }}" class="w-full h-40 object-contain">
                                    <form class="absolute top-2 right-2" action="{{ route('products.images.destroy', $img->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" 
                                            class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors"
                                            title="حذف الصورة"
                                            onclick="return confirm('هل أنت متأكد من حذف هذه الصورة؟')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-gray-50 border border-dashed border-gray-300 rounded-lg p-8 text-center">
                            <i class="fas fa-image text-gray-400 text-3xl mb-2"></i>
                            <p class="text-gray-500">لا توجد صور إضافية</p>
                        </div>
                    @endif
                </div>
                
                <!-- Add New Images -->
                <div class="border-t border-gray-200 pt-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-2">
                            <i class="fas fa-plus text-green-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">إضافة صور جديدة</h3>
                    </div>
                    
                    <form action="{{ route('products.images.store', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Replace Primary Image -->
                            <div>
                                <h4 class="text-md font-medium text-gray-700 mb-2">تغيير الصورة الرئيسية</h4>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 hover:bg-gray-100 transition duration-300">
                                    <input type="file" name="primary_image" id="new_primary_image" accept="image/*" class="hidden">
                                    <label for="new_primary_image" class="cursor-pointer flex flex-col items-center justify-center p-6">
                                        <div id="primary-upload-default" class="flex flex-col items-center">
                                            <i class="fas fa-exchange-alt text-xl text-gray-500 mb-2"></i>
                                            <p class="text-sm font-medium text-gray-600">اختيار صورة جديدة</p>
                                        </div>
                                        <div id="primary-upload-preview-container" class="hidden w-full">
                                            <div class="flex flex-col items-center">
                                                <img id="primary-upload-preview-img" src="" alt="معاينة الصورة" class="max-h-32 max-w-full rounded-lg shadow-sm mb-2">
                                                <p id="primary-upload-filename" class="text-xs text-gray-600 font-medium mb-2"></p>
                                                <button type="button" id="remove-primary-upload" class="text-xs bg-red-500 text-white px-2 py-1 rounded-full hover:bg-red-600 transition">
                                                    <i class="fas fa-times mr-1"></i> إزالة
                                                </button>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Add Additional Images -->
                            <div>
                                <h4 class="text-md font-medium text-gray-700 mb-2">إضافة صور إضافية</h4>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 hover:bg-gray-100 transition duration-300">
                                    <input type="file" name="additional_images[]" id="new_additional_images" multiple accept="image/*" class="hidden">
                                    <label for="new_additional_images" class="cursor-pointer flex flex-col items-center justify-center p-6">
                                        <i class="fas fa-plus-circle text-xl text-gray-500 mb-2"></i>
                                        <p class="text-sm font-medium text-gray-600">إضافة صور جديدة</p>
                                        <p id="additional-upload-count" class="text-xs text-gray-500 mt-1">يمكنك اختيار عدة صور</p>
                                    </label>
                                </div>
                                <div id="additional-upload-preview" class="grid grid-cols-2 sm:grid-cols-3 gap-2 mt-3"></div>
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="px-5 py-2 bg-green-600 rounded-lg text-white font-medium hover:bg-green-700 transition flex items-center shadow-md">
                                <i class="fas fa-cloud-upload-alt ml-2"></i>
                                رفع الصور
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Error/Success Messages -->
        @if($errors->any())
            <div class="bg-red-50 border-r-4 border-red-500 rounded-lg p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-times-circle text-red-500 text-xl"></i>
                    </div>
                    <div class="mr-3">
                        <h3 class="text-red-800 font-bold">يوجد أخطاء في المدخلات:</h3>
                        <div class="mt-1 text-sm text-red-700">
                            <ul class="list-disc space-y-1 pr-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @elseif (session('success'))
            <div class="bg-green-50 border-r-4 border-green-500 rounded-lg p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500 text-xl"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Primary Image Preview for Upload Form
        const primaryUploadInput = document.getElementById('new_primary_image');
        const primaryUploadDefault = document.getElementById('primary-upload-default');
        const primaryUploadPreviewContainer = document.getElementById('primary-upload-preview-container');
        const primaryUploadPreviewImg = document.getElementById('primary-upload-preview-img');
        const primaryUploadFilename = document.getElementById('primary-upload-filename');
        const removePrimaryUploadButton = document.getElementById('remove-primary-upload');
        
        if (primaryUploadInput) {
            primaryUploadInput.addEventListener('change', function(e) {
                if (this.files.length > 0) {
                    const file = this.files[0];
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            primaryUploadPreviewImg.src = e.target.result;
                            primaryUploadFilename.textContent = file.name;
                            primaryUploadDefault.classList.add('hidden');
                            primaryUploadPreviewContainer.classList.remove('hidden');
                        }
                        
                        reader.readAsDataURL(file);
                    }
                }
            });
            
            removePrimaryUploadButton.addEventListener('click', function() {
                primaryUploadInput.value = '';
                primaryUploadDefault.classList.remove('hidden');
                primaryUploadPreviewContainer.classList.add('hidden');
            });
        }
        
        // Additional Images Preview for Upload Form
        const additionalUploadInput = document.getElementById('new_additional_images');
        const additionalUploadPreview = document.getElementById('additional-upload-preview');
        const additionalUploadCount = document.getElementById('additional-upload-count');
        
        if (additionalUploadInput) {
            additionalUploadInput.addEventListener('change', function(e) {
                additionalUploadPreview.innerHTML = '';
                additionalUploadCount.textContent = this.files.length > 0 ? 
                    `تم اختيار ${this.files.length} صورة` : 'يمكنك اختيار عدة صور';
                
                for (let i = 0; i < this.files.length; i++) {
                    const file = this.files[i];
                    
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            const previewItem = document.createElement('div');
                            previewItem.className = 'relative bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden';
                            previewItem.dataset.filename = file.name;
                            
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'h-24 w-full object-contain p-1';
                            img.alt = 'معاينة الصورة';
                            
                            const filename = document.createElement('div');
                            filename.className = 'text-xs p-1 text-center text-gray-500 bg-gray-50 border-t border-gray-200 truncate';
                            filename.textContent = file.name;
                            
                            const removeButton = document.createElement('button');
                            removeButton.type = 'button';
                            removeButton.className = 'absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center';
                            removeButton.innerHTML = '<i class="fas fa-times text-xs"></i>';
                            removeButton.onclick = function() {
                                const dataTransfer = new DataTransfer();
                                for (let j = 0; j < additionalUploadInput.files.length; j++) {
                                    if (additionalUploadInput.files[j].name !== file.name) {
                                        dataTransfer.items.add(additionalUploadInput.files[j]);
                                    }
                                }
                                additionalUploadInput.files = dataTransfer.files;
                                previewItem.remove();
                                additionalUploadCount.textContent = additionalUploadInput.files.length > 0 ? 
                                    `تم اختيار ${additionalUploadInput.files.length} صورة` : 'يمكنك اختيار عدة صور';
                            };
                            
                            previewItem.appendChild(img);
                            previewItem.appendChild(filename);
                            previewItem.appendChild(removeButton);
                            additionalUploadPreview.appendChild(previewItem);
                        }
                        
                        reader.readAsDataURL(file);
                    }
                }
            });
        }
    });
    </script>
    <x-scripts.index />
</body>
</html>