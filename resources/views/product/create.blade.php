<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المستخدمين</title>
    <script src="https://cdn.tailwindcss.com"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-tailwind-script />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <x-fonts-import />
</head>
<body class="font-sans antialiased bg-gray-50">
    <x-nav :isHome='false'/>
    <div class="min-h-screen">
        <!-- Page Heading -->
        <header class="bg-yellow-200 shadow">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight py-6 px-4 sm:px-6 lg:px-8 text-right">
                إضافة منتج جديد
            </h2>
            @if (auth()->user()->is_admin)
                <a href="{{ route('products.index') }}" ><button class="" >المنتجات</button></a>
            @endif
        </header>

        <!-- Delete Confirmation Modal -->
        <div class="min-h-screen">
            <!-- Page Content -->
            <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form id="productForm" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="flex flex-col gap-6">
                            @csrf
                            <h3 class="text-lg font-medium text-gray-900">معلومات المنتج</h3>
                            
                            <div class="flex flex-col gap-4">
                                <!-- Product Name -->
                                <div class="flex flex-col my-2">
                                    <label for="name" class="underline underline-offset-8 text-sm block md:text-lg xl:text-2xl font-medium text-gray-700 mb-1">اسم المنتج</label>
                                    <input type="text" value="Ex Drops" name="name" id="name" class="lg:text-xl text-sm 2xl:text-2xl text-right w-full rounded-md shadow-sm focus:border-b-1 border-[yellow] focus:outline-none" required>
                                </div>
                                
                                <!-- Price -->
                                <div class="flex flex-col my-2">
                                    <label for="price" class="underline underline-offset-8 text-sm block md:text-lg xl:text-2xl font-medium text-gray-700 mb-1">السعر</label>
                                    <div class="relative">
                                        <input value="700.00" type="number" step="any" name="price" id="price" 
                                            class="lg:text-xl text-sm 2xl:text-2xl text-right w-full rounded-md shadow-sm focus:border-b-1
                                                [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none 
                                                [&::-webkit-inner-spin-button]:appearance-none
                                            border-[yellow] focus:outline-none" min="0" required>
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">بالدولار $</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Stock -->
                                <div class="flex flex-col my-2">
                                    <label for="stock" class="underline underline-offset-8 text-sm block md:text-lg xl:text-2xl font-medium text-gray-700 mb-1">المخزون</label>
                                    <input value="24" type="number" 
                                        name="stock" id="stock" 
                                        class="
                                            lg:text-xl text-sm 2xl:text-2xl
                                            [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none
                                            text-right w-full rounded-md shadow-sm focus:border-b-1 border-[yellow] focus:outline-none" min="0" required>
                                </div>
                                
                                <!-- Description -->
                                <div class="flex flex-col my-2">
                                    <label for="desc" class="underline underline-offset-8 text-sm block md:text-lg xl:text-2xl font-medium text-gray-700 mb-1">وصف المنتج</label>
                                    <textarea  name="desc" id="desc" class="lg:text-xl text-sm 2xl:text-2xl px-2 text-right w-full h-20 shadow-md focus:border-b-1 border-[yellow] transition focus:outline-none"></textarea>
                                </div>
                            </div>
                            <style>
                                /* Updated selector for radio buttons */
                                .category-container input[type=radio]:checked + label {
                                    background: black;
                                    color: yellow;
                                }
                                /* Ensure hover doesn't override selected state */
                        
                            </style>
                            
                            {{-- Categories --}}
                            <div class="flex flex-col my-2">
                                <label class="underline underline-offset-8 text-sm block md:text-lg xl:text-2xl font-medium text-gray-700 mb-5">التصنيف</label>
                                <div class="flex flex-row flex-wrap justify-center xl:justify-start gap-10">
                                    {{-- ملابس (Clothing) --}}
                                    <div class="category-container">
                                        <input type="radio" name="category" hidden value="clothes" id="category-clothes" />
                                        <label for="category-clothes" class="flex flex-col items-center justify-center transition p-4 cursor-pointer border-4 border-gray-300 hover:bg-gray-200 text-gray-900 rounded-xl min-w-[100px] h-[100px] lg:h-[120px] lg:min-w-[120px] xl:h-[140px] xl:min-w-[140px]">
                                            <i class="fas fa-tshirt text-2xl lg:text-3xl mb-2"></i>
                                            <div class="text-sm sm:text-xl">ملابس</div>
                                        </label>
                                    </div>
                            
                                    {{-- المنزل و المطبخ (Home & Kitchen) --}}
                                    <div class="category-container">
                                        <input type="radio" name="category" hidden value="kitchen_home" id="category-kitchen_home" />
                                        <label for="category-kitchen_home" class="flex flex-col items-center justify-center transition p-4 cursor-pointer border-4 border-gray-300 hover:bg-gray-200 text-gray-900 rounded-xl min-w-[100px] h-[100px] lg:h-[120px] lg:min-w-[120px] xl:h-[140px] xl:min-w-[140px]">
                                            <i class="fas fa-home text-2xl lg:text-3xl mb-2"></i>
                                            <div class="text-sm sm:text-xl">المنزل و المطبخ</div>
                                        </label>
                                    </div>
                            
                                    {{-- الصحة و الجمال (Health & Beauty) --}}
                                    <div class="category-container">
                                        <input type="radio" name="category" hidden value="beauty_health" id="category-beauty_health" />
                                        <label for="category-beauty_health" class="flex flex-col items-center justify-center transition p-4 cursor-pointer border-4 border-gray-300 hover:bg-gray-200 text-gray-900 rounded-xl min-w-[100px] h-[100px] lg:h-[120px] lg:min-w-[120px] xl:h-[140px] xl:min-w-[140px]">
                                            <i class="fas fa-spa text-2xl lg:text-3xl mb-2"></i>
                                            <div class="text-sm sm:text-xl">الصحة و الجمال</div>
                                        </label>
                                    </div>
                            
                                    {{-- هواتف و اجهزة ذكيه (Electronics) --}}
                                    <div class="category-container">
                                        <input type="radio" name="category" hidden value="electronics" id="category-electronics" />
                                        <label for="category-electronics" class="flex flex-col items-center justify-center transition p-4 cursor-pointer border-4 border-gray-300 hover:bg-gray-200 text-gray-900 rounded-xl min-w-[100px] h-[100px] lg:h-[120px] lg:min-w-[120px] xl:h-[140px] xl:min-w-[140px]">
                                            <i class="fas fa-mobile-alt text-2xl lg:text-3xl mb-2"></i>
                                            <div class="text-sm sm:text-xl">هواتف و أجهزة ذكية</div>
                                        </label>
                                    </div>
                            
                                    {{-- بيع العقار (Real Estate) --}}
                                    <div class="category-container">
                                        <input type="radio" name="category" hidden value="real_estate" id="category-real_estate" />
                                        <label for="category-real_estate" class="flex flex-col items-center justify-center transition p-4 cursor-pointer border-4 border-gray-300 hover:bg-gray-200 text-gray-900 rounded-xl min-w-[100px] h-[100px] lg:h-[120px] lg:min-w-[120px] xl:h-[140px] xl:min-w-[140px]">
                                            <i class="fas fa-building text-2xl lg:text-3xl mb-2"></i>
                                            <div class="text-sm sm:text-xl">بيع العقار</div>
                                        </label>
                                    </div>
                            
                                    {{-- بيع السيارات (Cars) --}}
                                    <div class="category-container">
                                        <input type="radio" name="category" hidden value="cars" id="category-cars" />
                                        <label for="category-cars" class="flex flex-col items-center justify-center transition p-4 cursor-pointer border-4 border-gray-300 hover:bg-gray-200 text-gray-900 rounded-xl min-w-[100px] h-[100px] lg:h-[120px] lg:min-w-[120px] xl:h-[140px] xl:min-w-[140px]">
                                            <i class="fas fa-car text-2xl lg:text-3xl mb-2"></i>
                                            <div class="text-sm sm:text-xl">بيع السيارات</div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Image Upload Section -->
                            <div class="flex flex-col my-2 gap-4">
                                <h3 class="text-lg font-medium text-gray-700 underline underline-offset-8 text-sm block md:text-lg xl:text-2xl">صور المنتج</h3>
                                
                                <!-- Primary Image Field -->
                                <div class="flex flex-col">
                                    <label class="block  font-medium text-gray-700 mb-1 text-sm lg:text-lg">الصورة الرئيسية (مطلوبة)</label>
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
                                    <label class="block font-medium text-gray-700 mb-1 text-sm lg:text-lg">صور إضافية (اختيارية)</label>
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
                            </div>

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
    
        <script>
        // Primary Image Preview with better styling
        document.getElementById('primary_image').addEventListener('change', function(e) {
            const previewContainer = document.getElementById('primary-preview');
            previewContainer.innerHTML = '';
            
            if (this.files.length > 0) {
                const file = this.files[0];
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const previewItem = document.createElement('div');
                        previewItem.className = 'relative group w-40 border-2 border-yellow-400 rounded-lg p-1';
                        
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'h-40 w-full object-cover rounded-md';
                        img.alt = 'Primary product image';
                        
                        const badge = document.createElement('div');
                        badge.className = 'absolute top-2 left-2 bg-yellow-500 text-white text-xs px-2 py-1 rounded';
                        badge.textContent = 'رئيسية';
                        
                        const removeButton = document.createElement('button');
                        removeButton.type = 'button';
                        removeButton.className = 'absolute top-2 right-2 bg-red-500 text-white rounded-full p-1';
                        removeButton.innerHTML = '<i class="fas fa-times"></i>';
                        removeButton.onclick = function() {
                            previewContainer.innerHTML = '';
                            document.getElementById('primary_image').value = '';
                        };
                        
                        previewItem.appendChild(img);
                        previewItem.appendChild(badge);
                        previewItem.appendChild(removeButton);
                        previewContainer.appendChild(previewItem);
                    }
                    
                    reader.readAsDataURL(file);
                }
            }
        });

        // Additional Images Preview
        document.getElementById('additional_images').addEventListener('change', function(e) {
            const previewContainer = document.getElementById('additional-preview');
            
            // Clear existing previews but keep track of existing files
            const existingPreviews = Array.from(previewContainer.children);
            
            // Process new files
            for (let i = 0; i < this.files.length; i++) {
                const file = this.files[i];
                if (file.type.startsWith('image/')) {
                    // Check if this file already has a preview
                    const alreadyHasPreview = existingPreviews.some(preview => {
                        return preview.dataset.filename === file.name;
                    });
                    
                    if (!alreadyHasPreview) {
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            const previewItem = document.createElement('div');
                            previewItem.className = 'relative group w-40 border border-gray-200 rounded-lg p-1';
                            previewItem.dataset.filename = file.name;
                            
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'h-40 w-full object-cover rounded-md';
                            img.alt = 'Additional product image';
                            
                            const removeButton = document.createElement('button');
                            removeButton.type = 'button';
                            removeButton.className = 'absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity';
                            removeButton.innerHTML = '<i class="fas fa-times"></i>';
                            removeButton.onclick = function() {
                                // Remove the file from the input
                                const dataTransfer = new DataTransfer();
                                const input = document.getElementById('additional_images');
                                for (let j = 0; j < input.files.length; j++) {
                                    if (input.files[j].name !== file.name) {
                                        dataTransfer.items.add(input.files[j]);
                                    }
                                }
                                input.files = dataTransfer.files;
                                previewItem.remove();
                            };
                            
                            previewItem.appendChild(img);
                            previewItem.appendChild(removeButton);
                            previewContainer.appendChild(previewItem);
                        }
                        
                        reader.readAsDataURL(file);
                    }
                }
            }
        });

        // Drag and drop functionality for additional images
        const additionalDropzone = document.getElementById('additional-dropzone');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            additionalDropzone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            additionalDropzone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            additionalDropzone.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            additionalDropzone.classList.add('border-yellow-500', 'bg-yellow-50');
        }

        function unhighlight() {
            additionalDropzone.classList.remove('border-yellow-500', 'bg-yellow-50');
        }

        additionalDropzone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            const fileInput = document.getElementById('additional_images');
            
            // Create a DataTransfer object to update the FileList of the input element
            const dataTransfer = new DataTransfer();
            
            // Add existing files if any
            if (fileInput.files) {
                for (let i = 0; i < fileInput.files.length; i++) {
                    dataTransfer.items.add(fileInput.files[i]);
                }
            }
            
            // Add new files
            for (let i = 0; i < files.length; i++) {
                if (files[i].type.startsWith('image/')) {
                    dataTransfer.items.add(files[i]);
                }
            }
            
            fileInput.files = dataTransfer.files;
            
            // Trigger change event
            const event = new Event('change');
            fileInput.dispatchEvent(event);
        }
        </script>
    </body>
</html>