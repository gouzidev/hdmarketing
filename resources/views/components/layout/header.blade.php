<div class="p-6 border-b border-gray-200 bg-gradient-to-bl from-yellow-200 to-white  mb-5 w-full mx-auto px-4 sm:px-6 lg:px-8 py-4">
    <div class="flex justify-between    max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center  max-w-7xl ">
            @if ($icon) 
                <i class="{{ $icon }} text-yellow-600 ml-3"></i>
            @endif
            {{ $headerText }}
        </h1>
        @if ($btnText)  
                <a href="{{ $btnLink }}" class="{{ $btnClass }} }}">
                    <i class="{{ $btnIcon }} ml-2"></i> {{ $btnText }}
                </a>
        @endif
    </div>
</div>