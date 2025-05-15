<main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 font-tajawal">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200 ">
            <!-- Table Header with Actions -->
            <div class="flex justify-between  mb-6">
                <form class="w-full flex flex-row gap-5 relative" action="{{ route('admin.users.search') }}" action="GET">
                    <button 
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs 
                            text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fas fa-search"></i>
                    </button>
                    <input 
                        name="search"
                        type="text" placeholder="...بحث عن مستخدمين" 
                        class="text-right 
                        focus:outline-none
                        w-1/2 pr-2 py-2  border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        @if(isset($search) && $search != '')
                            <div class="flex items-center justify-center text-gray-600 w-full">
                                نتائج البحث عن: "{{ $search }}"
                            </div>
                        @endif
                </form>
            </div>

            <!-- Users Table -->
            <x-admin.users-table :users="$users" />
        </div>
    </div>
</main>