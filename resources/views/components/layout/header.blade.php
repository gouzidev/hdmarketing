<!-- filepath: /home/sgouzi/prj/hdmarketing/resources/views/components/layout/header.blade.php -->
@props([
    'headerText' => '',
    'icon' => '',
    'btnLink' => '',
    'btnText' => '',
    'btnIcon' => '',
    'btnClass' => '',
    'showForUser' => false,
])

<header class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex items-center justify-between">
            <h1 class="text-xl md:text-2xl font-bold text-gray-900 flex items-center">
                @if ($icon)
                    <i class="{{ $icon }} ml-2 text-blue-600"></i>
                @endif
                {{ $headerText }}
            </h1>
            
            @if ($btnLink && $btnText)
                <a href="{{ $btnLink }}" class="{{ $btnClass ?? 'inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out' }}">
                    @if ($btnIcon)
                        <i class="{{ $btnIcon }} ml-2"></i>
                    @endif
                        {{ $btnText }}
                </a>
            @endif
        </div>
    </div>
</header>


<header class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex items-center justify-between">
            <h1 class="text-xl md:text-2xl font-bold text-gray-900 flex items-center">
                @if ($icon)
                    <i class="{{ $icon }} ml-2 text-blue-600"></i>
                @endif
                {{ $headerText }}
            </h1>
            
            @if ($btnLink && $btnText && $showForUser)
                <a href="{{ $btnLink }}" class="{{ $btnClass ?? 'inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out' }}">
                    @if ($btnIcon)
                        <i class="{{ $btnIcon }} ml-2"></i>
                    @endif
                    {{ $btnText }}
                </a>
            @endif
        </div>
    </div>
</header>