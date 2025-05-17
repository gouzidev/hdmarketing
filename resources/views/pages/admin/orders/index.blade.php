<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>إدارة الطلبات</title>
        <x-imports.index />

        <style>
            
            .status-badge {
                padding: 0.25rem 0.5rem;
                border-radius: 9999px;
                font-size: 0.75rem;
                font-weight: 600;
            }
            .order-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>
    <body class="bg-dot-pat bg-gray-50">
        <x-layout.nav />
        <!-- Navigation -->
        <x-notif />

        <x-layout.sidebar />
    
        {{-- <x-layout.nav /> --}}

        <x-layout.header :headerText="'إدارة الطلبات'"   :icon="'fas fa-shopping-cart'"/>

        <!-- Main Content -->
        
        <main class="max-w-7xl mx-auto py-6 sm:px-6 px-4 lg:px-8 font-tajawal ">
            <!-- Stats Cards -->

            <div class="grid sm:grid-cols-4  grid-cols-2  md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow p-4 border-t-4 border-indigo-500">
                    <div class="text-gray-500">الطلبات الجديدة</div>
                    <div class="text-2xl font-bold">{{ $thisWeekOrderCount }}</div>
                    <div class="@if ($orderCountPerc < 0) text-red-500 @else text-green-500 @endif text-sm mt-1">
                        @if ($orderCountPerc < 0) <i class="fas fa-arrow-down"></i> @else <i class="fas fa-arrow-up"></i> @endif
                        %
                        <span dir="ltr">{{ $orderCountPerc }}</span>
                        من الأسبوع الماضي
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4 border-t-4 border-blue-500">
                    <div class="text-gray-500">قيد المعالجة</div>
                    <div class="text-2xl font-bold">{{ $totalOrderProcessingCount }}</div>
                    <div class="@if ($orderProcessingCountPerc < 0) text-red-500 @else text-green-500 @endif text-sm mt-1">
                        @if ($orderProcessingCountPerc < 0) <i class="fas fa-arrow-down"></i> @else <i class="fas fa-arrow-up"></i> @endif
                        %
                        <span dir="ltr">{{ $orderProcessingCountPerc }}</span>
                        من الأسبوع الماضي
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4 border-t-4 border-yellow-500">
                    <div class="text-gray-500">قيد الشحن</div>
                    <div class="text-2xl font-bold">{{ $totalOrderShippingProcessingCount }}</div>
                    <div class="@if ($orderShippingProcessingCountPerc < 0) text-red-500 @else text-green-500 @endif text-sm mt-1">
                        @if ($orderShippingProcessingCountPerc < 0) <i class="fas fa-arrow-down"></i> @else <i class="fas fa-arrow-up"></i> @endif
                        %
                        <span dir="ltr">{{ $orderShippingProcessingCountPerc }}</span>
                        من الأسبوع الماضي

                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4 border-t-4 border-green-500">
                    <div class="text-gray-500">تم التوصيل</div>
                    <div class="text-2xl font-bold">{{$totalOrderShippingDeliveredCount}} </div>
                    <div class="@if ($orderShippingDeliveredCountPerc < 0) text-red-500 @else text-green-500 @endif text-sm mt-1">
                        @if ($orderShippingDeliveredCountPerc < 0) <i class="fas fa-arrow-down"></i> @else <i class="fas fa-arrow-up"></i> @endif
                        %
                        <span dir="ltr">{{ $orderShippingDeliveredCountPerc }}</span>
                        من الأسبوع الماضي
                    </div>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        جميع الطلبات
                    </h3>
                    {{-- <div class="flex space-x-3 space-x-reverse">
                        <button class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-md text-sm hover:bg-indigo-200">
                            <i class="fas fa-filter mr-1"></i> تصفية
                        </button>
                    </div> --}}
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    رقم الطلب
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    العميل
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    المنتج
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    الكمية
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    السعر
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    حالة الطلب
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    حالة الشحن
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    تاريخ الطلب
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    إجراءات
                                </th>
                            </tr>
                        </thead>
                        <tbody dir="rtl" class="bg-white divide-y divide-gray-200">
                            @foreach ($orders as $order)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    ORD-{{ $order->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex flex-col">
                                            @if ($order->affiliate)
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $order->affiliate->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $order->affiliate->email }}
                                                </div>
                                            @else
                                                <div class="text-sm font-medium text-gray-900 mb-2">
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                        مجهول
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $order->product->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $order->product->category }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $order->quantity }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $order->product->price }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                        @switch($order->status)
                                            @case("accepted")
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    مقبول
                                                </span>
                                                @break
                                            @case("rejected")
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                مرفوض
                                            </span>
                                            @break
                                            @default
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                قيد المعالجة   
                                            </span>
                                        @endswitch

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($order->shipping_status)
                                        @case("shipped")
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                شحنت
                                            </span>
                                            @break
                                        @case("delivred")
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            وصلت
                                        </span>
                                        @break
                                        @default
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            قيد الشحن   
                                        </span>
                                    @endswitch

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{  $order->created_at->locale('ar')->isoFormat('D MMMM YYYY') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex gap-5">

                                    <a href="{{ route('orders.show', $order) }}" class="text-blue-600 hover:text-blue-900 bg-blue-100 p-2 rounded-md" title="عرض ">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <button 
                                        onclick="openDeleteModal('{{ route('order.destroy', $order) }}', 'ORD-{{ $order->id }} - {{ $order->product->name }}', 'الطلب')" 
                                        class="text-red-600 p-2 rounded-md bg-red-100 hover:bg-red-200" title="حذف">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
            </div>
            {{ $orders->links() }}

        </main>

        <x-modal id="appModal" />

        <x-scripts.index />

    </body>
</html>