<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $product->name }} - متجرنا</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <style>
            .image-gallery {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 1rem;
            }
            .main-image {
                grid-column: span 3;
                grid-row: span 2;
            }
            @media (max-width: 768px) {
                .image-gallery {
                    grid-template-columns: 1fr;
                }
                .main-image {
                    grid-column: span 1;
                    grid-row: span 1;
                }
            }
            .zoom-effect {
                transition: transform 0.3s ease;
            }
            .zoom-effect:hover {
                transform: scale(1.03);
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <x-nav :isHome='false'/>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Breadcrumbs -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-yellow-600">
                            <i class="fas fa-home mr-2"></i>
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

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="grid md:grid-cols-2 gap-8 p-6">
                    <!-- Product Images -->
                    <div>
                        <div class="image-gallery">
                            @if($product->primary_image)
                                <div class="main-image bg-gray-100 rounded-lg overflow-hidden">
                                    <img src="{{ route('products.thumbnail', $product) }}" 
                                        alt="{{ $product->name }}" 
                                        class="w-full h-full object-cover cursor-zoom-in zoom-effect">
                                </div>
                            @else
                                <div class="main-image bg-gray-100 rounded-lg overflow-hidden">
                                    <img src="{{ route('products.images.default') }}" 
                                        alt="{{ $product->name }}" 
                                        class="w-full h-full object-cover">
                                </div>
                            @endif

                            @foreach($product->additional_imgs as $image)
                                <div class="bg-gray-100 rounded-lg overflow-hidden cursor-pointer hover:border-2 hover:border-yellow-400 transition-all">
                                    <img src="{{ route('products.images.show', $image->path) }}" 
                                        alt="{{ $product->name }}" 
                                        class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="flex flex-col">
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                        
                        <!-- Price -->
                        <div class="flex items-center mb-4">
                            <span class="text-2xl font-bold text-gray-900">{{ number_format($product->price, 2) }} $</span>
                            @if($product->price > 100) <!-- Example discount logic -->
                                <span class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded">خصم</span>
                            @endif
                        </div>

                        <!-- Rating -->
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= 4) <!-- Example rating -->
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-gray-600 text-sm mr-2">(12 تقييم)</span>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">وصف المنتج</h3>
                            <p class="text-gray-700">{{ $product->desc ?? 'لا يوجد وصف متاح' }}</p>
                        </div>

                        <!-- Stock Status -->
                        <div class="mb-6">
                            @if($product->stock > 0)
                                <span class="text-green-600 flex items-center">
                                    <i class="fas fa-check-circle ml-2"></i>متوفر في المخزون ({{ $product->stock }}) 
                                </span>
                            @else
                                <span class="text-red-600 flex items-center">
                                    <i class="fas fa-times-circle ml-2"></i> غير متوفر
                                </span>
                            @endif
                        </div>

                        <!-- Add to Cart -->
                        @if (!auth()->user()->is_admin)
                            <div class="border-t border-gray-200 pt-6">
                                <div class="flex items-center mb-4 gap-4">
                                    <span class="text-gray-700 mr-3">الكمية:</span>
                                    <div class="flex items-center border border-gray-300 rounded-md">
                                        <button class="px-3 py-1 text-gray-600 hover:bg-gray-100">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" value="1" min="1" max="{{ $product->stock }}" 
                                            class="
                                                    [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none 
                                                w-12 text-center border-0 focus:ring-0">
                                        <button class="px-3 py-1 text-gray-600 hover:bg-gray-100">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <a href="{{ route('products.product.checkout', $product)}}">
                                    <button class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-3 px-4 rounded-md font-medium flex items-center justify-center">
                                        <i class="fas fa-shopping-cart ml-2"></i>
                                        طلب
                                    </button>
                                </a>
                                {{-- <button class="w-full mt-3 bg-white border border-gray-300 hover:bg-gray-50 text-gray-800 py-3 px-4 rounded-md font-medium flex items-center justify-center">
                                    <i class="far fa-heart ml-2"></i>
                                    إضافة إلى المفضلة
                                </button> --}}
                            </div>
                            <!-- Product Meta -->
                            @endif 
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <span class="text-gray-600">رقم المنتج:</span>
                                    <span class="font-medium">#{{ $product->id }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-600">القسم:</span>
                                    <span class="font-medium">{{ $product->category }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            <div class="mt-16">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">منتجات ذات صلة</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Example Related Products - Replace with actual related products -->
                    @for($i = 1; $i <= 4; $i++)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                            <div class="relative flex justify-center items-center">
                                <img src="{{ route('products.images.default') }}" alt="Related Product"
                                    class="w-full h-48 object-cover">
                                @if($i % 2 == 0)
                                    <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded">جديد</span>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-medium text-gray-900 mb-1">منتج مشابه {{ $i }}</h3>
                                <div class="flex items-center mb-2">
                                    <div class="text-yellow-400 text-sm">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-gray-900">${{ rand(50, 200) }}.00</span>
                                    <button class="text-yellow-600 hover:text-yellow-700">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <script>
            // Simple image gallery functionality
            document.addEventListener('DOMContentLoaded', function() {
                const mainImage = document.querySelector('.main-image img');
                const thumbnails = document.querySelectorAll('.image-gallery img:not(.main-image img)');
                
                thumbnails.forEach(thumb => {
                    thumb.addEventListener('click', function() {
                        const tempSrc = mainImage.src;
                        mainImage.src = this.src;
                        this.src = tempSrc;
                    });
                });
                
                // Quantity buttons
                const minusBtn = document.querySelector('button:has(.fa-minus)');
                const plusBtn = document.querySelector('button:has(.fa-plus)');
                const quantityInput = document.querySelector('input[type="number"]');
                
                minusBtn.addEventListener('click', function() {
                    if (parseInt(quantityInput.value) > 1) {
                        quantityInput.value = parseInt(quantityInput.value) - 1;
                    }
                });
                
                plusBtn.addEventListener('click', function() {
                    if (parseInt(quantityInput.value) < parseInt(quantityInput.max)) {
                        quantityInput.value = parseInt(quantityInput.value) + 1;
                    }
                });
            });
        </script>
    </body>
</html>