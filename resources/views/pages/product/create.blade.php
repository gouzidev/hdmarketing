<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة منتج جديد</title>
    <x-imports.index />
</head>
<body class="font-sans antialiased bg-dot-pat bg-gray-50">
    <x-layout.nav :isHome='false'/>
    <x-layout.sidebar />
    
    <x-layout.header :headerText="'إضافة منتج جديد'" :btnText="'العودة للمنتجات'"
        :btnLink="route('products.index')"
        :btnClass="'inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-medium text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 shadow-sm transition-colors'"
        :btnIcon="'fas fa-arrow-right'"
        :icon="'fas fa-box'"
    />
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Progress Steps -->
        <div class="mb-8 px-4">
            <div class="flex items-center justify-between">
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 rounded-full bg-yellow-500 flex items-center justify-center text-white shadow-md">
                        <i class="fas fa-info-circle text-lg"></i>
                    </div>
                    <span class="mt-2 text-sm font-medium text-gray-700">المعلومات</span>
                </div>
                <div class="flex-1 h-1 bg-gray-300 mx-3 md:mx-4">
                    <div class="h-full bg-yellow-500 w-1/3"></div>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 shadow">
                        <i class="fas fa-tags text-lg"></i>
                    </div>
                    <span class="mt-2 text-sm font-medium text-gray-500">التصنيف</span>
                </div>
                <div class="flex-1 h-1 bg-gray-300 mx-3 md:mx-4"></div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 shadow">
                        <i class="fas fa-images text-lg"></i>
                    </div>
                    <span class="mt-2 text-sm font-medium text-gray-500">الصور</span>
                </div>
            </div>
        </div>
        
        <!-- Product Form -->
        <form id="productForm" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            
            <!-- Product Info Card -->
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
                            <input type="text" name="name" id="name" 
                                class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 outline-none transition duration-200"
                                placeholder="مثال: هاتف آيفون 14 برو ماكس" required>
                        </div>
                        
                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-money-bill-wave text-yellow-600 ml-1"></i>
                                السعر <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" step="0.01" name="price" id="price" 
                                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 outline-none transition duration-200 pl-16"
                                    placeholder="0.00" min="0" required>
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
                                <input type="number" name="stock" id="stock" 
                                    class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 outline-none transition duration-200"
                                    placeholder="0" min="0" required>
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
                                placeholder="اكتب وصفًا تفصيليًا للمنتج..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Categories Card -->
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
                            <input type="radio" name="category" id="category-clothes" value="clothes" class="hidden peer" required>
                            <label for="category-clothes" class="flex flex-col items-center justify-center w-28 h-28 p-4 bg-white border-2 border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 peer-checked:bg-yellow-500 peer-checked:border-yellow-600 peer-checked:text-white transition-all duration-200">
                                <i class="fas fa-tshirt text-2xl mb-2 peer-checked:text-white"></i>
                                <span class="text-sm font-medium text-center">ملابس</span>
                            </label>
                        </div>
                        
                        <!-- Home & Kitchen Category -->
                        <div>
                            <input type="radio" name="category" id="category-kitchen_home" value="kitchen_home" class="hidden peer">
                            <label for="category-kitchen_home" class="flex flex-col items-center justify-center w-28 h-28 p-4 bg-white border-2 border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 peer-checked:bg-yellow-500 peer-checked:border-yellow-600 peer-checked:text-white transition-all duration-200">
                                <i class="fas fa-home text-2xl mb-2"></i>
                                <span class="text-sm font-medium text-center">المنزل و المطبخ</span>
                            </label>
                        </div>
                        
                        <!-- Health & Beauty Category -->
                        <div>
                            <input type="radio" name="category" id="category-beauty_health" value="beauty_health" class="hidden peer">
                            <label for="category-beauty_health" class="flex flex-col items-center justify-center w-28 h-28 p-4 bg-white border-2 border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 peer-checked:bg-yellow-500 peer-checked:border-yellow-600 peer-checked:text-white transition-all duration-200">
                                <i class="fas fa-spa text-2xl mb-2"></i>
                                <span class="text-sm font-medium text-center">الصحة و الجمال</span>
                            </label>
                        </div>
                        
                        <!-- Electronics Category -->
                        <div>
                            <input type="radio" name="category" id="category-electronics" value="electronics" class="hidden peer">
                            <label for="category-electronics" class="flex flex-col items-center justify-center w-28 h-28 p-4 bg-white border-2 border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 peer-checked:bg-yellow-500 peer-checked:border-yellow-600 peer-checked:text-white transition-all duration-200">
                                <i class="fas fa-mobile-alt text-2xl mb-2"></i>
                                <span class="text-sm font-medium text-center">هواتف و إلكترونيات</span>
                            </label>
                        </div>
                        
                        <!-- Real Estate Category -->
                        <div>
                            <input type="radio" name="category" id="category-real_estate" value="real_estate" class="hidden peer">
                            <label for="category-real_estate" class="flex flex-col items-center justify-center w-28 h-28 p-4 bg-white border-2 border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 peer-checked:bg-yellow-500 peer-checked:border-yellow-600 peer-checked:text-white transition-all duration-200">
                                <i class="fas fa-building text-2xl mb-2"></i>
                                <span class="text-sm font-medium text-center">بيع العقار</span>
                            </label>
                        </div>
                        
                        <!-- Cars Category -->
                        <div>
                            <input type="radio" name="category" id="category-cars" value="cars" class="hidden peer">
                            <label for="category-cars" class="flex flex-col items-center justify-center w-28 h-28 p-4 bg-white border-2 border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 peer-checked:bg-yellow-500 peer-checked:border-yellow-600 peer-checked:text-white transition-all duration-200">
                                <i class="fas fa-car text-2xl mb-2"></i>
                                <span class="text-sm font-medium text-center">بيع السيارات</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Image Upload Card -->
            <div class="bg-white shadow rounded-lg overflow-hidden mb-6 border border-gray-200">
                <div class="p-5 border-b border-gray-200 bg-gradient-to-l from-yellow-50 to-white">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-images text-yellow-600 ml-3"></i>
                        صور المنتج
                    </h2>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Primary Image Field -->
                        <div>
                            <div class="mb-4">
                                <h3 class="text-lg font-medium text-gray-800 mb-2 flex items-center">
                                    <i class="fas fa-image text-yellow-600 ml-2"></i>
                                    الصورة الرئيسية <span class="text-red-500">*</span>
                                </h3>
                                <p class="text-sm text-gray-500">هذه الصورة هي التي ستظهر في القائمة الرئيسية للمنتجات</p>
                            </div>
                            
                            <div class="border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 hover:bg-gray-100 transition duration-300" id="primary-dropzone">
                                <input type="file" name="primary_image" id="primary_image" accept="image/*" class="hidden" required>
                                <label for="primary_image" class="cursor-pointer flex flex-col items-center justify-center p-8">
                                    <div id="primary-default" class="flex flex-col items-center">
                                        <div class="w-16 h-16 mb-4 flex items-center justify-center rounded-full bg-yellow-100">
                                            <i class="fas fa-cloud-upload-alt text-2xl text-yellow-600"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-600">اضغط لاختيار الصورة الرئيسية</p>
                                        <p class="text-xs text-gray-500 mt-1">jpg أو png (أقصى حجم: 2MB)</p>
                                    </div>
                                    <div id="primary-preview-container" class="hidden w-full">
                                        <div class="flex flex-col items-center">
                                            <img id="primary-preview-img" src="" alt="معاينة الصورة" class="max-h-48 max-w-full rounded-lg shadow-md mb-3 object-contain">
                                            <p id="primary-filename" class="text-sm text-gray-600 font-medium mb-2"></p>
                                            <button type="button" id="remove-primary" class="text-xs bg-red-500 text-white px-3 py-1 rounded-full hover:bg-red-600 transition">
                                                <i class="fas fa-times ml-1"></i> إزالة
                                            </button>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Additional Images Field -->
                        <div>
                            <div class="mb-4">
                                <h3 class="text-lg font-medium text-gray-800 mb-2 flex items-center">
                                    <i class="fas fa-images text-yellow-600 ml-2"></i>
                                    صور إضافية (اختياري)
                                </h3>
                                <p class="text-sm text-gray-500">يمكنك إضافة المزيد من الصور لعرض تفاصيل المنتج</p>
                            </div>
                            
                            <div class="border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 hover:bg-gray-100 transition duration-300" id="additional-dropzone">
                                <input type="file" name="additional_images[]" id="additional_images" multiple accept="image/*" class="hidden">
                                <label for="additional_images" class="cursor-pointer flex flex-col items-center justify-center p-8">
                                    <div class="w-16 h-16 mb-4 flex items-center justify-center rounded-full bg-blue-100">
                                        <i class="fas fa-plus-circle text-2xl text-blue-600"></i>
                                    </div>
                                    <p class="text-sm font-medium text-gray-600">اضغط لاختيار صور إضافية</p>
                                    <p class="text-xs text-gray-500 mt-1">يمكنك اختيار عدة صور</p>
                                </label>
                            </div>
                            
                            <div id="additional-preview" class="grid grid-cols-2 sm:grid-cols-3 gap-3 mt-4"></div>
                        </div>
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
            
            <!-- Submit Buttons -->
            <div class="flex justify-between">
                <a href="{{ route('products.index') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition flex items-center">
                    <i class="fas fa-arrow-right ml-2"></i>
                    رجوع إلى المنتجات
                </a>
                
                <button type="submit" class="px-6 py-3 bg-yellow-600 rounded-lg text-white font-medium hover:bg-yellow-700 transition flex items-center shadow-md">
                    <i class="fas fa-save ml-2"></i>
                    حفظ المنتج
                </button>
            </div>
        </form>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Primary Image Preview
        const primaryInput = document.getElementById('primary_image');
        const primaryDefault = document.getElementById('primary-default');
        const primaryPreviewContainer = document.getElementById('primary-preview-container');
        const primaryPreviewImg = document.getElementById('primary-preview-img');
        const primaryFilename = document.getElementById('primary-filename');
        const removeButtonPrimary = document.getElementById('remove-primary');
        
        primaryInput.addEventListener('change', function(e) {
            if (this.files.length > 0) {
                const file = this.files[0];
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        primaryPreviewImg.src = e.target.result;
                        primaryFilename.textContent = file.name;
                        primaryDefault.classList.add('hidden');
                        primaryPreviewContainer.classList.remove('hidden');
                    }
                    
                    reader.readAsDataURL(file);
                }
            }
        });
        
        removeButtonPrimary.addEventListener('click', function() {
            primaryInput.value = '';
            primaryDefault.classList.remove('hidden');
            primaryPreviewContainer.classList.add('hidden');
        });
        
        // Additional Images Preview
        const additionalInput = document.getElementById('additional_images');
        const additionalPreview = document.getElementById('additional-preview');
        
        additionalInput.addEventListener('change', function(e) {
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
                        img.className = 'h-24 w-full object-cover';
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
                            for (let j = 0; j < additionalInput.files.length; j++) {
                                if (additionalInput.files[j].name !== file.name) {
                                    dataTransfer.items.add(additionalInput.files[j]);
                                }
                            }
                            additionalInput.files = dataTransfer.files;
                            previewItem.remove();
                        };
                        
                        previewItem.appendChild(img);
                        previewItem.appendChild(filename);
                        previewItem.appendChild(removeButton);
                        additionalPreview.appendChild(previewItem);
                    }
                    
                    reader.readAsDataURL(file);
                }
            }
        });
        
        // Drag and Drop
        const dropzones = document.querySelectorAll('#primary-dropzone, #additional-dropzone');
        
        dropzones.forEach(dropzone => {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, preventDefaults, false);
            });
            
            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, function() {
                    this.classList.add('border-yellow-500', 'bg-yellow-50');
                });
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, function() {
                    this.classList.remove('border-yellow-500', 'bg-yellow-50');
                });
            });
            
            dropzone.addEventListener('drop', function(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                
                if (dropzone.id === 'primary-dropzone' && files.length > 0) {
                    document.getElementById('primary_image').files = files;
                    const event = new Event('change');
                    document.getElementById('primary_image').dispatchEvent(event);
                } else if (dropzone.id === 'additional-dropzone') {
                    const additionalInput = document.getElementById('additional_images');
                    const dataTransfer = new DataTransfer();
                    
                    if (additionalInput.files) {
                        for (let i = 0; i < additionalInput.files.length; i++) {
                            dataTransfer.items.add(additionalInput.files[i]);
                        }
                    }
                    
                    for (let i = 0; i < files.length; i++) {
                        if (files[i].type.startsWith('image/')) {
                            dataTransfer.items.add(files[i]);
                        }
                    }
                    
                    additionalInput.files = dataTransfer.files;
                    const event = new Event('change');
                    additionalInput.dispatchEvent(event);
                }
            });
        });
    });
    </script>
    <x-scripts.index />
</body>
</html>