<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>إدارة المستخدمين</title>
    <x-imports.index />
    <x-scripts.index />
    <style>
        .scrollbar-visible::-webkit-scrollbar {
            height: 8px;
            width: 8px;
        }
        .scrollbar-visible::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .scrollbar-visible::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        .scrollbar-visible::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        .scrollbar-visible {
            scrollbar-width: thin;
            scrollbar-color: #888 #f1f1f1;
        }
    </style>
</head>
<body class="font-sans antialiased bg-dot-pat bg-gray-50">
    <x-notif /> 
    <x-layout.nav :isHome='false'/>
    <x-layout.sidebar />
    
    <x-layout.header :headerText="'إدارة المستخدمين'" :icon="'fas fa-users'" />
    
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 font-tajawal">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4 border-t-4 border-indigo-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-indigo-100 rounded-md p-3">
                        <i class="fas fa-users text-indigo-600 text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-500">إجمالي المستخدمين</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $users->total() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-4 border-t-4 border-purple-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-100 rounded-md p-3">
                        <i class="fas fa-user-shield text-purple-600 text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-500">المدراء</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $users->where('is_admin', true)->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-4 border-t-4 border-green-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                        <i class="fas fa-user-check text-green-600 text-xl"></i>
                    </div>
                    <div class="mr-4">
                        <p class="text-sm font-medium text-gray-500">المستخدمين الموثقين</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $users->where('verified', true)->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Users Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden border border-gray-200 mb-6">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-l from-indigo-50 to-white flex justify-between items-center">
                <h1 class="text-xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-user-friends text-indigo-600 ml-3"></i>
                    قائمة المستخدمين
                </h1>
            </div>
            
            <div class="relative shadow-md sm:rounded-lg">
                <div class="scrollbar-visible overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    المستخدم
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    معلومات التواصل
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    الحالة
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    الدور
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    الموقع
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    إجراءات
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                            <tr class="{{ $user->is_admin ? 
                                        $user->id == auth()->user()->id ? 
                                            'bg-purple-100 hover:bg-purple-200' : 
                                        'hover:bg-gray-100 bg-gray-50' : 'hover:bg-gray-100'
                                }}
                                cursor-pointer
                                ">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-600 font-medium">{{ strtoupper(substr($user->name, 0, length: 1)) }}</span>
                                        </div>
                                        <div class="mr-4">
                                            <div class="text-md font-semibold text-gray-900">{{ $user->name }}</div>
                                            <div class="text-sm font-normal text-gray-700">{{ $user->phone }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-md text-gray-900">{{ $user->email }}</div>
                                    <div class="text-sm text-gray-500">{{ $user->created_at->format('M d, Y') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->verified ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $user->verified ? 'موثق' : 'قيد الانتظار' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->is_admin ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ $user->is_admin ? 'مدير' : 'مستخدم' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <i class="fas fa-map-marker-alt text-gray-400 ml-2"></i>
                                        <div>
                                            <div>{{ $user->city }}</div>
                                            <div class="text-gray-400">{{ $user->country ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2 space-x-reverse">
                                        @if ($user->id != auth()->user()->id)
                                            @if ($user->is_admin)
                                                <!-- Disabled buttons for admins -->
                                                <button 
                                                    disabled
                                                    class="text-red-600 p-2 rounded-md bg-red-100 opacity-40 cursor-not-allowed" title="حذف">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <button 
                                                    disabled
                                                    class="text-indigo-600 p-2 rounded-md bg-indigo-100 opacity-40 cursor-not-allowed" title="تعديل">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            @else
                                                <!-- Fixed: Change openModal to openDeleteModal -->
                                                <button 
                                                    onclick="openDeleteModal('{{ route('users.destroy', $user) }}', '{{ $user->name }}', 'المستخدم')" 
                                                    class="text-red-600 p-2 rounded-md bg-red-100 hover:bg-red-200" title="حذف">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <a href="{{ route('users.edit', $user) }}" 
                                                    class="text-indigo-600 p-2 rounded-md bg-indigo-100 hover:bg-indigo-200" title="تعديل">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                <div class="pagination-container">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </main>
    
    <x-modal id="appModal" />
    <x-scripts.index />

</body>
</html>