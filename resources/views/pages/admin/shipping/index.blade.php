<!-- resources/views/admin/shipping/index.blade.php -->
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الشحن</title>
    <x-scripts.fonts-import />
    <x-scripts.index />
</head>
<body class="font-sans antialiased bg-gray-100">
    <x-layout.nav :isHome='false'/>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="bg-white shadow rounded-lg overflow-hidden mb-6 border border-gray-200">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-l from-yellow-50 to-white flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-truck text-yellow-600 ml-3"></i>
                    إدارة الشحن
                </h1>
                <a href="{{ route('admin.shipping.create') }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-medium text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 shadow-sm transition-colors">
                    <i class="fas fa-plus ml-2"></i>
                    إضافة شحن جديد
                </a>
            </div>
            
            <!-- Stats Summary -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6 bg-gray-50">
                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                            <i class="fas fa-globe text-blue-600 text-xl"></i>
                        </div>
                        <div class="mr-4">
                            <p class="text-sm font-medium text-gray-500">إجمالي الدول</p>
                            <p class="text-lg font-bold text-gray-900">{{ $shippings->unique('country')->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                            <i class="fas fa-city text-green-600 text-xl"></i>
                        </div>
                        <div class="mr-4">
                            <p class="text-sm font-medium text-gray-500">إجمالي المدن</p>
                            <p class="text-lg font-bold text-gray-900">{{ $shippings->unique('city')->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-100 rounded-md p-3">
                            <i class="fas fa-money-bill-wave text-yellow-600 text-xl"></i>
                        </div>
                        <div class="mr-4">
                            <p class="text-sm font-medium text-gray-500">متوسط تكلفة الشحن</p>
                            <p class="text-lg font-bold text-gray-900">{{ number_format($shippings->avg('price'), 2) }} $</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Filters -->
        {{-- <div class="bg-white shadow rounded-lg overflow-hidden mb-6 border border-gray-200">
            <div class="p-4 border-b border-gray-200 bg-gray-50">
                <h2 class="text-lg font-medium text-gray-700">فلترة النتائج</h2>
            </div>
            <div class="p-4">
                <form action="{{ route('admin.shipping.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700 mb-1">الدولة</label>
                        <select id="country" name="country" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200">
                            <option value="">كل الدول</option>
                            @foreach($shippings->unique('country')->pluck('country') as $country)
                                <option value="{{ $country }}" {{ request('country') == $country ? 'selected' : '' }}>{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">المدينة</label>
                        <select id="city" name="city" class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200">
                            <option value="">كل المدن</option>
                            @foreach($shippings->unique('city')->pluck('city') as $city)
                                <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="price_min" class="block text-sm font-medium text-gray-700 mb-1">السعر الأدنى</label>
                        <input type="number" id="price_min" name="price_min" value="{{ request('price_min') }}" min="0" 
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200">
                    </div>
                    
                    <div>
                        <label for="price_max" class="block text-sm font-medium text-gray-700 mb-1">السعر الأقصى</label>
                        <input type="number" id="price_max" name="price_max" value="{{ request('price_max') }}" min="0" 
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200">
                    </div>
                    
                    <div class="md:col-span-4 flex justify-end space-x-2 space-x-reverse">
                        <button type="reset" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            <i class="fas fa-redo ml-1"></i>
                            إعادة تعيين
                        </button>
                        <button type="submit" class="px-4 py-2 bg-yellow-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            <i class="fas fa-search ml-1"></i>
                            بحث
                        </button>
                    </div>
                </form>
            </div>
        </div> --}}
        
        <!-- Shipping Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                الدولة
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                المدينة
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                الشارع
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                السعر
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                الإجراءات
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($shippings as $shipping)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $shipping->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="fas fa-globe text-blue-500 ml-2"></i>
                                        <div class="text-sm font-medium text-gray-900">{{ $shipping->country }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="fas fa-city text-green-500 ml-2"></i>
                                        <div class="text-sm font-medium text-gray-900">{{ $shipping->city }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="fas fa-road text-gray-500 ml-2"></i>
                                        <div class="text-sm text-gray-500">{{ $shipping->street }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ number_format($shipping->price, 2) }} $
                                    </span>
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap text-left text-sm font-medium">
                                    <div class="flex space-x-2 space-x-reverse">
                                        <a href="{{ route('admin.shipping.show', $shipping) }}" class="text-blue-600 hover:text-blue-900 bg-blue-100 p-2 rounded-md" title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.shipping.edit', $shipping) }}" class="text-yellow-600 hover:text-yellow-900 bg-yellow-100 p-2 rounded-md" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                onclick="confirmDelete({{ $shipping->id }})" 
                                                class="text-red-600 hover:text-red-900 bg-red-100 p-2 rounded-md" 
                                                title="حذف">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fas fa-box-open text-gray-400 text-5xl mb-4"></i>
                                        <p class="text-xl font-medium">لا توجد بيانات شحن</p>
                                        <p class="mt-1">قم بإضافة بيانات شحن جديدة</p>
                                        <a href="{{ route('admin.shipping.create') }}" class="mt-3 inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-medium text-white hover:bg-yellow-700">
                                            <i class="fas fa-plus ml-2"></i>
                                            إضافة شحن جديد
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
            <!-- Pagination -->
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $shippings->links() }}
            </div>
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div class="inline-block align-bottom bg-white rounded-lg text-right overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:mr-4 sm:text-right">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                حذف بيانات الشحن
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    هل أنت متأكد من رغبتك في حذف بيانات الشحن هذه؟ لا يمكن التراجع عن هذا الإجراء.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            تأكيد الحذف
                        </button>
                    </form>
                    <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        إلغاء
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function confirmDelete(id) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            
            form.action = `/admin/shipping/${id}`;
            modal.classList.remove('hidden');
        }
        
        function closeModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>