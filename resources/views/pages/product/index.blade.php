<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المنتجات</title>
    <x-scripts.index />
    <x-scripts.fonts-import />

    <style>
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <x-layout.nav :isHome='false'/>
    <div class="min-h-screen w-full mx-auto">
        <!-- Page Heading -->

        <x-layout.header
        :headerText="'إدارة المنتجات'"
        :icon="'fas fa-box'"
        :btnLink="route('products.create') "
        :btnText="'إضافة منتج '"
        :btnIcon="'fas fa-plus'"
        :btnClass="'
            inline-flex items-center px-4 py-2 
            bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white
            uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900
            focus:outline-none focus:ring-2 focus:ring-yellow-500
            focus:ring-offset-2 transition ease-in-out duration-150'"
        />
        <!-- Add this search div right here -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 ">
            <div class="flex items-center flex-row gap-10 w-full ">
                <form class="flex justify-between flex-row gap-2 w-1/2"
                    action="{{ route('products.search') }}" method="GET">
                    <input type="text" id="product-search" placeholder="ابحث عن منتج..." 
                    class="bg-white border border-gray-300 
                        focus:outline-none text-gray-900 text-sm rounded-lg
                         focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5"
                    dir="rtl"
                    name="search"
                    >
                    <button 
                        class="flex w-20 justify-center items-center text-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs 
                            text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 
                            focus:outline-none  focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                
                <div class="text-gray-700">
                    @if(isset($search) && $search != '')
                        <div class="flex items-center justify-center text-gray-600 w-full">
                            نتائج البحث عن: "{{ $search }}"
                        </div>
                    @endif
                </div>
            </div>
        </div>


        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden product-card transition-all duration-300">
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
                                <span class="font-bold text-gray-900">{{ number_format($product->price, 2) }} $</span>
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-box ml-1"></i> {{ $product->stock }}
                                </span>
                            </div>
                        </div>
                    </a>
                    
                    <!-- Action Buttons (outside the main link) -->
                    <div class="px-4 pb-4 border-t border-gray-100">
                        <div class="flex justify-between gap-2 mt-3">
                            <a href="{{ route('products.product', $product) }}" class="flex-1 text-center py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-md text-sm font-medium transition-colors">
                                <i class="fas fa-eye ml-1"></i> عرض
                            </a>
                            @if(auth()->user()->is_admin)
                                <a href="{{ route('products.product.edit', $product) }}" class="flex-1 text-center py-2 bg-blue-100 hover:bg-blue-200 text-blue-800 rounded-md text-sm font-medium transition-colors">
                                    <i class="fas fa-edit ml-1"></i> تعديل
                                </a>
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
</body>
</html>