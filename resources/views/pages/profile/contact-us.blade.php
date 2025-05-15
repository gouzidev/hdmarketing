<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head dir="rtl">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>hdmarketing</title>
    <script src="https://cdn.tailwindcss.com"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-scripts.tailwind-script />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <x-scripts.fonts-import />
</head>

<body class="overflow-x-hidden relative">
    <x-layout.nav :isHome="false"/>
    {{-- form container --}}
    <x-layout.header :headerText="'تواصل معنا'" :icon="'fas fa-envelope'"/>

    <div class="flex flex-col bg-gray-100 h-[500px] mt-20 w-5/6 mx-auto shadow-lg">
        <div class="flex flex-row gap-20">
            <div class="text-5xl">
                <i class="fas fa-headset" class=""></i>
            </div>
            <div class="flex flex-col text-2xl">
                <div class="">
                    تقديم شكوى للمنصة
                </div>
                <div class="">
                    يمكنك تقديم كافة تفاصيل الشكوى هنا حتى نتمكن من مساعدتك
                </div>
            </div>
        </div>
        <form>
            <div class="w-full">
                <input placeholder="user@example.com"  type="email" name="email" required 
                    class="w-11/12 border-[1px] rounded-md text-lg p-1 focus:outline-none"
                    />
            </div>

            <div class="w-full">
                <input placeholder="subject" type="text" name="subject" required 
                    class="w-11/12 border-[1px] rounded-md text-lg p-1 focus:outline-none"
                    />
            </div>

            <div class="w-full">
                <textarea placeholder="desc" name="desc" required 
                    class="w-11/12 border-[1px] rounded-md text-lg p-1 focus:outline-none"
                    ></textarea>
            </div>
        </form>  
    </div>
    <x-scripts.nav-script />
</body>
</html>