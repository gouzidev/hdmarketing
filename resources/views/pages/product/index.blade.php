<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <!-- Your existing head content -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>إدارة المنتجات</title>
    <x-imports.index />
    <style>
        .animation-countdown {
            width: 100%;
            transform-origin: right;
            animation: countdown 3s linear forwards;
        }
        
        @keyframes countdown {
            from {
                transform: scaleX(1);
            }
            to {
                transform: scaleX(0);
            }
        }
        
        .fade-out {
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 300ms, transform 300ms;
        }
    </style>
</head>

<body class="font-sans antialiased bg-dot-pat bg-gray-50">
    <!-- Navigation -->
    <x-notif />

    <x-layout.nav :isHome='false'/>
    
    <!-- Sidebar -->
    <x-layout.sidebar />
    
    <!-- Main Content -->
    <div class="">
        <!-- Page Header -->
        <x-layout.header
            :headerText="'إدارة المنتجات'"
            :icon="'fas fa-box'"
            :btnLink="route('products.create')"
            :btnText="'إضافة منتج'"
            :btnIcon="'fas fa-plus'"
            :showForUser="false"
            :btnClass="'inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150'"
        />
        
        <!-- Your existing content... -->

        <!-- Products Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($products as $product)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:translate-y-[-5px] hover:shadow-lg transition-all duration-300">
                    <a href="{{ route('products.product', $product) }}" class="block">
                        <!-- Product Image -->
                        <div class="relative h-48 bg-gray-100 overflow-hidden">
                            <img src="{{ route('products.thumbnail', $product) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover hover:opacity-90 transition-opacity">
                            @if($product->stock <= 0)
                                <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded">
                                    نفذ من المخزون
                                </span>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="p-4">
                            <h3 class="font-medium text-gray-900 mb-1 truncate">{{ $product->name }}</h3>
                            <p class="text-gray-600 text-sm mb-2 line-clamp-2 h-10">{{ $product->desc }}</p>
                            
                            <div class="flex items-center justify-between mt-4">
                            <span class="font-bold text-gray-900">{{ number_format($product->price, 2) }} LYD</span>
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-box ml-1"></i> {{ $product->stock }}
                                </span>
                            </div>
                        </div>
                    </a>
                    
                    <!-- Action Buttons -->
                    <div class="px-4 pb-4 border-t border-gray-100">
                        <div class="flex justify-between gap-2 mt-3">
                            <a href="{{ route('products.product', $product) }}" class="flex-1 text-center py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-md text-sm font-medium transition-colors">
                                <i class="fas fa-eye ml-1"></i> عرض
                            </a>
                            @if(auth()->user()->is_admin)
                                <a href="{{ route('products.product.edit', $product) }}" class="flex-1 text-center py-2 bg-blue-100 hover:bg-blue-200 text-blue-800 rounded-md text-sm font-medium transition-colors">
                                    <i class="fas fa-edit ml-1"></i> تعديل
                                </a>
                                <button type="button" 
                                    onclick="openDeleteModal('{{ route('products.product.destroy', $product) }}', '{{ $product->name }}')"
                                    class="flex-1 text-center py-2 bg-red-100 hover:bg-red-200 text-red-800 rounded-md text-sm font-medium transition-colors">
                                    <i class="fas fa-trash ml-1"></i> حذف
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            
                        <!-- Pagination -->
                        @if($products->hasPages())
                        <div class="mt-8">
                            {{ $products->links() }}
                        </div>
                    @endif
        
                    <!-- Empty State -->
                    @if($products->isEmpty())
                        <div class="text-center py-12">
                            <div class="mx-auto w-24 h-24 text-gray-400 mb-4">
                                <i class="fas fa-box-open text-5xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">لا توجد منتجات</h3>
                            <p class="text-gray-500 mb-4">لم يتم إضافة أي منتجات بعد</p>
                            @if(auth()->user()->is_admin)
                            <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <i class="fas fa-plus ml-2"></i> إضافة منتج جديد
                            </a>
                            @endif
                        </div>
                    @endif
        </div>
    </div>
    
    <x-scripts.index />

    <x-modal />
</body>
</html>