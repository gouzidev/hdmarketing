<div class="min-h-[200px] flex items-center justify-center relative text-white">
    <!-- Dark overlay on top of background image -->
    <div class="absolute inset-0 bg-[url(/images/cta-1.png)] bg-cover bg-center opacity-100"></div>
    
    <!-- Dark semi-transparent overlay -->
    <div class="absolute inset-0 bg-black opacity-80"></div>
    
    <!-- Content (on top of the darkened background) -->
    <div class="text-center sm:min-h-[100px] min-h-[0px] justify-between flex flex-col items-center z-10 relative">
        <h1 class="font-kufi w-5/6 sm:w-full text-md sm:text-xl md:text-2xl xl:text-5xl font-black">{{ $title }}</h1>
        <span>{{ $message }}</span>
    </div>
</div>