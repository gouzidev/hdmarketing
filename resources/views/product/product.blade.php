<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $product->name }} - متجرنا</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <style>
            .gallery-thumbnail {
                transition: all 0.3s ease;
                border: 2px solid transparent;
            }
            .gallery-thumbnail:hover, .gallery-thumbnail.active {
                border-color: #f59e0b;
            }
            .main-image {
                transition: transform 0.3s ease;
            }
            .main-image:hover {
                transform: scale(1.02);
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <x-nav :isHome='false'/>
        
        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="fixed z-50 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-right overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fas fa-exclamation-triangle text-red-600"></i>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:mr-4 sm:text-right">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    تأكيد الحذف النهائي
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        هل أنت متأكد من رغبتك في حذف هذا المنتج نهائياً؟ لا يمكن استعادته بعد الحذف.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <form id="deleteForm" method="POST" action="{{ route('products.product.destroy', $product) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                نعم، احذف نهائياً
                            </button>
                        </form>
                        <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            إلغاء
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Page Header -->
            <div class="bg-white shadow rounded-lg overflow-hidden mb-6">
                <div class="p-6 bg-gradient-to-l from-yellow-50 to-white flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-box-open text-yellow-600 ml-3"></i>
                        تفاصيل المنتج
                    </h1>
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-yellow-600">
                                    <i class="fas fa-home ml-2"></i>
                                    الرئيسية
                                </a>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <i class="fas fa-chevron-left text-gray-400 mx-2"></i>
                                    <span class="text-sm font-medium text-gray-500">{{ $product->name }}</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Main Product Section -->
            <div class="bg-white shadow rounded-lg overflow-hidden mb-6">
                <div class="grid md:grid-cols-2 gap-8 p-6">
                    <!-- Product Images - Amazon-style gallery -->
                    <div class="space-y-4">
                        <!-- Main Image -->
                        <div class="bg-gray-100 rounded-lg overflow-hidden h-96 flex items-center justify-center">
                            @if($product->primary_image)
                                <img id="mainImage" src="{{ route('products.thumbnail', $product) }}" 
                                    alt="{{ $product->name }}" 
                                    class="main-image w-full h-full object-cover cursor-zoom-in">
                            @else
                                <img id="mainImage" src="{{ route('products.images.default') }}" 
                                    alt="{{ $product->name }}" 
                                    class="main-image w-full h-full object-cover">
                            @endif
                        </div>
                        
                        <!-- Thumbnail Gallery -->
                        <div class="grid grid-cols-5 gap-2">
                            @if($product->primary_image)
                                <div class="gallery-thumbnail active bg-gray-100 rounded overflow-hidden h-20 cursor-pointer" onclick="changeMainImage('{{ route('products.thumbnail', $product) }}', this)">
                                    <img src="{{ route('products.thumbnail', $product) }}" 
                                        alt="{{ $product->name }}" 
                                        class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="bg-gray-100 rounded overflow-hidden h-20 flex items-center justify-center opacity-40">
                                    <i class="fas fa-image text-gray-400 text-xl"></i>
                                </div>
                            @endif
                            
                            @foreach($product->additional_imgs as $image)
                                <div class="gallery-thumbnail bg-gray-100 rounded overflow-hidden h-20 cursor-pointer" onclick="changeMainImage('{{ route('products.images.show', $image->path) }}', this)">
                                    <img src="{{ route('products.images.show', $image->path) }}" 
                                        alt="{{ $product->name }}" 
                                        class="w-full h-full object-cover">
                                </div>
                            @endforeach
                            
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="flex flex-col">
                        <div class="mb-4">
                            <h1 class="text-2xl font-bold text-gray-900 mt-1">{{ $product->name }}</h1>
                        </div>
                        
                        <!-- Price -->
                        <div class="py-4 border-t border-gray-200">
                            <div class="flex items-center">
                                <span class="text-2xl font-bold text-gray-900">{{ number_format($product->price, 2) }} ر.س</span>
                            </div>
                            <div class="text-sm text-gray-500 mt-1">شامل الضريبة</div>
                        </div>
                        
                        <!-- Highlights -->
                        <div class="my-2 p-2">
                            <div class="tab-content active">
                                <h3 class="text-lg font-medium text-gray-900 mb-3">تفاصيل المنتج</h3>
                                <div class="prose max-w-none text-gray-700">
                                    {{ !$product->desc || $product->desc == "" ? 'لا يوجد وصف مفصل متاح لهذا المنتج حالياً.' : $product->desc }}
                                </div>
                            </div>
                        </div>
                        
                        <!-- Stock Status -->

                        
                        <!-- Add to Cart -->
                        @if (!auth()->user()->is_admin)

                            @if (Auth::user()->verified)

                                @if($product->stock > 0)
                                    <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                                        <span class="text-green-600 flex items-center">
                                            <i class="fas fa-check-circle ml-2"></i> 
                                            متوفر في المخزون ({{ $product->stock }} قطعة)
                                        </span>
                                        <div class="text-sm text-gray-500 mt-1">التوصيل خلال 2-4 أيام عمل</div>
                                    </div>
                                    <form class="border-t border-gray-200 pt-4" action="{{ route('products.product.checkout', $product)}}">
                                        <div class="flex items-center mb-4">
                                            <span class="text-gray-700 ml-3">الكمية:</span>
                                            <div class="flex items-center border border-gray-300 rounded-md">
                                                <button type="button" class="px-3 py-1 text-gray-600 hover:bg-gray-100" id="decreaseQuantity">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input name='quantity' type="number" value="1" min="1" max="{{ $product->stock }}" id="quantityInput"
                                                    class="w-12 text-center border-0 focus:ring-0 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                                <button type="button" class="px-3 py-1 text-gray-600 hover:bg-gray-100" id="increaseQuantity">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
    
                                        <div class="space-y-3">
                                                <button class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-3 px-4 rounded-md font-medium flex items-center justify-center shadow-sm transition-colors">
                                                    <i class="fas fa-shopping-cart ml-2"></i>
                                                    أضف إلى السلة
                                                </button>
                                                <button class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-800 py-3 px-4 rounded-md font-medium flex items-center justify-center shadow-sm transition-colors">
                                                    <i class="far fa-heart ml-2"></i>
                                                    أضف إلى المفضلة
                                                </button>
                                        </div>
                                    </form>
                                
                                @else
                                    <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                                        <span class="text-red-600 flex items-center gap-2">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                            غير متوفر في المخزون  
                                        </span>
                                    </div>
                                @endif
                            @else
                                <div class="text-red-700">
                                    يجب ان يكون حسابك موثقا لكي تسجل طلبا
                                </div>
                            @endif
                        @else
                            <div class="mt-4 flex gap-3">
                                <a href="{{ route('products.product.edit', $product) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-colors">
                                    <i class="fas fa-edit ml-2"></i> تعديل
                                </a>
                                
                                <button onclick="openModal('{{ route('products.product.destroy', $product) }}')" 
                                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-sm transition-colors">
                                    <i class="fas fa-trash-alt ml-2"></i> حذف
                                </button>
                            </div>
                        @endif
                        
                        <!-- Product Meta -->
                        <div class="mt-6 pt-2 border-t border-gray-200">
                            <div class="grid grid-cols-2 gap-3">
                                <div class="p-3">
                                    <span class="text-gray-600 block mb-1 text-sm">التصنيف:</span>
                                    <span class="font-medium text-gray-900">{{ $product->category }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Related Products -->
            <div class="bg-white shadow rounded-lg overflow-hidden p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-900">عملاء يشترون أيضاً</h2>
                    <a href="#" class="text-yellow-600 hover:text-yellow-700 flex items-center">
                        عرض المزيد <i class="fas fa-arrow-left ml-1"></i>
                    </a>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @for($i = 1; $i <= 4; $i++)
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                            <div class="relative h-48 bg-gray-100 flex items-center justify-center p-4">
                                <img src="{{ route('products.images.default') }}" alt="منتج مشابه {{ $i }}"
                                    class="w-full h-full object-contain">
                                @if($i % 2 == 0)
                                    <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded">جديد</span>
                                @endif
                            </div>
                            <div class="p-3">
                                <h3 class="font-medium text-gray-900 text-sm mb-1 truncate">منتج مكمل {{ $i }}</h3>
                                <div class="flex items-center mb-2">
                                    <div class="text-yellow-400 text-xs">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-gray-900 text-sm">{{ rand(50, 200) }} ر.س</span>
                                    <button class="text-yellow-600 hover:text-yellow-700 bg-yellow-100 hover:bg-yellow-200 p-1 rounded">
                                        <i class="fas fa-shopping-cart text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
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