<div class="overflow-x-auto">
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
            <tr class=
            "{{ $user->is_admin ?
                    $user->id == auth()->user()->id ?
                        'bg-yellow-50 hover:bg-yellow-100' : 
                    'hover:bg-gray-200 bg-gray-50' : 'hover:bg-gray-100'
            }}
            cursor-pointer
            ">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-600 font-medium">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        </div>
                        <div class="mr-4">
                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $user->phone }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $user->email }}</div>
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
                    <div>{{ $user->city }}</div>
                    <div class="text-gray-400">{{ $user->country ?? 'N/A' }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    @if ($user->id != auth()->user()->id)
                        @if ($user->is_admin)
                        <button 
                            disabled
                            onclick="openModal('{{ route('admin.users.destroy', $user) }}')" 
                            class="text-red-600 p-1 hover:text-red-900 cursor-not-allowed opacity-20" >
                            <i class="fas fa-trash"></i>
                        </button>
                        <a href=""  onclick="return false;"
                            class="
                                text-indigo-600 hover:text-indigo-900 ml-3 cursor-not-allowed  opacity-20"
                        >
                            <i class="fas fa-edit"></i>
                        </a>
                        @else
                            <button 
                                onclick="openModal('{{ route('admin.users.destroy', $user) }}')" 
                                class="text-red-600 p-1 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                            <a href="{{ route('admin.users.edit', $user) }}" 
                                class="text-indigo-600 hover:text-indigo-900 ml-3">
                                <i class="fas fa-edit"></i>
                            </a>
                        @endif
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
        {{ $users ? 
            $users->links() : 
            ''
        }}
</div>