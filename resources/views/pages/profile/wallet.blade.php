<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head dir="rtl">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المحفظة - hdmarketing</title>
    <x-scripts.tailwind-script />
    <x-imports.index />
    <x-imports.fa />
</head>

<body class="overflow-x-hidden relative bg-gray-50">
    <x-layout.nav :page="''"/>
    <x-layout.sidebar />
    <x-layout.header :headerText="'المحفظة'" :icon="'fas fa-wallet'" />

    <!-- Stats Cards -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Sales Card -->
            <div class="bg-gradient-to-b from-blue-800 to-blue-700 rounded-md p-1 shadow-lg">
                <div class="bg-white rounded p-4 h-full">
                    <div class="flex items-center mb-3">
                        <div class="bg-blue-100 p-2 rounded">
                            <i class="fa-solid fa-money-check-dollar text-blue-600"></i>
                        </div>
                        <h3 class="mr-3 font-medium text-gray-700">مجموع المبيعات</h3>
                    </div>
                    <div class="bg-gray-100 rounded-md p-4 text-center">
                        <div class="text-sm text-gray-500">دينار</div>
                        <div class="text-2xl font-bold text-gray-900">{{ number_format($totalSales) }}</div>
                    </div>
                </div>
            </div>

            <!-- Total Profit Card -->
            <div class="bg-gradient-to-b from-blue-800 to-blue-700 rounded-md p-1 shadow-lg">
                <div class="bg-white rounded p-4 h-full">
                    <div class="flex items-center mb-3">
                        <div class="bg-green-100 p-2 rounded">
                            <i class="fa-solid fa-building-columns text-green-600"></i>
                        </div>
                        <h3 class="mr-3 font-medium text-gray-700">مجموع الارباح</h3>
                    </div>
                    <div class="bg-gray-100 rounded-md p-4 text-center">
                        <div class="text-sm text-gray-500">دينار</div>
                        <div class="text-2xl font-bold text-gray-900">{{ number_format($totalProfit) }}</div>
                    </div>
                </div>
            </div>
            
            <!-- Orders Profit Card -->
            <div class="bg-gradient-to-b from-blue-800 to-blue-700 rounded-md p-1 shadow-lg">
                <div class="bg-white rounded p-4 h-full">
                    <div class="flex items-center mb-3">
                        <div class="bg-indigo-100 p-2 rounded">
                            <i class="fa-solid fa-money-check-dollar text-indigo-600"></i>
                        </div>
                        <h3 class="mr-3 font-medium text-gray-700">مجموع الارباح من الطلبات</h3>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-gray-100 rounded-md p-2 text-center">
                            <div class="text-xs text-gray-500 mb-1">الطلبات</div>
                            <div class="text-lg font-bold text-gray-900">{{ number_format($numOrders) }}</div>
                        </div>
                        
                        <div class="bg-gray-100 rounded-md p-2 text-center">
                            <div class="text-xs text-gray-500 mb-1">دينار</div>
                            <div class="text-lg font-bold text-gray-900">{{ number_format($totalProfit) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Expected Profit Card -->
            <div class="bg-gradient-to-b from-blue-800 to-blue-700 rounded-md p-1 shadow-lg">
                <div class="bg-white rounded p-4 h-full">
                    <div class="flex items-center mb-3">
                        <div class="bg-yellow-100 p-2 rounded">
                            <i class="fa-solid fa-chart-line text-yellow-600"></i>
                        </div>
                        <h3 class="mr-3 font-medium text-gray-700">ربح متوقع من الطلبات</h3>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-gray-100 rounded-md p-2 text-center">
                            <div class="text-xs text-gray-500 mb-1">الطلبات</div>
                            <div class="text-lg font-bold text-gray-900">{{ number_format($numNextOrders) }}</div>
                        </div>
                        
                        <div class="bg-gray-100 rounded-md p-2 text-center">
                            <div class="text-xs text-gray-500 mb-1">دينار</div>
                            <div class="text-lg font-bold text-gray-900">{{ number_format($nextProfit) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Withdrawal Requests Section -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="border-b border-gray-200">
                    <div class="p-5 flex items-center">
                        <div class="p-2 bg-blue-100 rounded-md">
                            <i class="fa-solid fa-file-invoice-dollar text-blue-700"></i>
                        </div>
                        <h2 class="text-xl font-medium text-gray-800 mr-3">طلبات السحب</h2>
                    </div>
                </div>
                
                <div class="p-5 border-b border-gray-200">
                    <button disabled class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gray-300 text-gray-700 rounded-md opacity-60 cursor-not-allowed">
                        <i class="fa-solid fa-money-bill"></i>
                        <span class="font-medium">طلب السحب</span>
                    </button>
                    <div class="mt-2 text-center text-sm text-gray-500">لا يوجد رصيد كافي للسحب</div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    طريقة الدفع
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    الحالة
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    التاريخ والوقت
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50 transition-colors cursor-pointer">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <span class="text-blue-500 ml-2">
                                            <i class="fab fa-paypal"></i>
                                        </span>
                                        <div class="text-sm font-medium text-gray-900">salahgouzi Paypal</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-medium rounded-full bg-green-100 text-green-800">
                                        قيد الانتظار
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <i class="far fa-calendar-alt ml-2"></i>
                                        <span>2023-12-12</span>
                                        <span class="mx-2">|</span>
                                        <i class="far fa-clock ml-2"></i>
                                        <span>02:33:54</span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition-colors cursor-pointer">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <span class="text-blue-500 ml-2">
                                            <i class="fab fa-paypal"></i>
                                        </span>
                                        <div class="text-sm font-medium text-gray-900">Jihad Moussawi Paypal</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-medium rounded-full bg-yellow-100 text-yellow-800">
                                        موثق
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <i class="far fa-calendar-alt ml-2"></i>
                                        <span>2025-08-24</span>
                                        <span class="mx-2">|</span>
                                        <i class="far fa-clock ml-2"></i>
                                        <span>08:56:14</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Money Request Form -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="p-5 flex items-center border-b border-gray-200">
                    <div class="p-2 bg-green-100 rounded-md">
                        <i class="fa-solid fa-hand-holding-dollar text-green-700"></i>
                    </div>
                    <h2 class="text-xl font-medium text-gray-800 mr-3">طلب سحب الأموال</h2>
                </div>
                
                <div class="p-6">
                    <form class="space-y-4">
                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">المبلغ</label>
                            <div class="relative rounded-md shadow-sm">
                                <input type="number" name="amount" id="amount" class="block w-full pr-12 pl-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="أدخل المبلغ">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">دينار</span>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">طريقة الدفع</label>
                            <select id="payment_method" name="payment_method" class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="paypal">PayPal</option>
                                <option value="bank">تحويل بنكي</option>
                                <option value="wallet">محفظة إلكترونية</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="payment_details" class="block text-sm font-medium text-gray-700 mb-1">بيانات الدفع</label>
                            <input type="text" name="payment_details" id="payment_details" class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="البريد الإلكتروني أو رقم الحساب">
                        </div>
                        
                        <div>
                            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                تقديم طلب السحب
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-scripts.index />
</body>
</html>