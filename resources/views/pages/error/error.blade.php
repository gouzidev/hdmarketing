<!-- filepath: /home/sgouzi/prj/hdmarketing/resources/views/pages/error.blade.php -->
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عفواً، الصفحة غير متوفرة</title>


    <x-scripts.index />
    <x-scripts.fonts-import />


    <style>
        body {
            font-family: 'Noto Kufi Arabic', sans-serif;
        }
        .animated-bg {
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }
        @keyframes gradientBG {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex flex-col min-h-screen justify-center items-center p-6">
        <!-- Logo Section -->
        <div class="w-full max-w-md mb-10 text-center">
            <a href="{{ route('home') }}">
                <img class="h-16 mx-auto" src="{{ asset('images/logo.png') }}" alt="الشعار" />
            </a>
        </div>
        
        <!-- Error Card -->
        <div class="w-full max-w-2xl bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header with gradient -->
            <div class="animated-bg bg-gradient-to-r from-blue-600 via-blue-500 to-indigo-500 p-6 text-white text-center">
                <div class="rounded-full bg-white/20 w-20 h-20 mx-auto mb-4 flex items-center justify-center">
                    <i class="fas fa-map-signs text-3xl"></i>
                </div>
                <h1 class="text-2xl font-bold">عفواً، لا يمكن الوصول للصفحة المطلوبة</h1>
                <p class="mt-2 opacity-90">الصفحة التي تبحث عنها غير متوفرة أو تم نقلها</p>
            </div>
            
            <!-- Content -->
            <div class="p-8">
                <div class="text-center mb-8">
                    <p class="text-gray-600 text-lg">
                        قد تكون الصفحة التي تبحث عنها قد تم نقلها أو حذفها، أو ربما هناك خطأ في الرابط الذي اتبعته.
                    </p>
                </div>
                
                <!-- Suggestions -->
                <div class="grid md:grid-cols-2 gap-6 mb-8">
                    <div class="p-5 border rounded-lg bg-gray-50">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <i class="fas fa-search"></i>
                            </div>
                            <h3 class="text-lg font-semibold mr-3">البحث عما تريد</h3>
                        </div>
                        <p class="text-gray-600">
                            يمكنك استخدام البحث للعثور على ما تبحث عنه بسرعة.
                        </p>
                    </div>
                    
                    <div class="p-5 border rounded-lg bg-gray-50">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center text-amber-600">
                                <i class="fas fa-phone"></i>
                            </div>
                            <h3 class="text-lg font-semibold mr-3">اتصل بنا</h3>
                        </div>
                        <p class="text-gray-600">
                            إذا كنت لا تزال تواجه مشكلة، يمكنك الاتصال بفريق الدعم الخاص بنا.
                        </p>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 md:space-x-reverse justify-center">
                    <a href="{{ route('home') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-center font-medium">
                        <i class="fas fa-home ml-2"></i>
                        العودة للصفحة الرئيسية
                    </a>
                    
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors text-center font-medium">
                            <i class="fas fa-chart-line ml-2"></i>
                            لوحة التحكم
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 border border-gray-300 transition-colors text-center font-medium">
                            <i class="fas fa-sign-in-alt ml-2"></i>
                            تسجيل الدخول
                        </a>
                    @endauth
                </div>
            </div>
            
            <!-- Footer -->
            <div class="p-4 bg-gray-50 border-t border-gray-200 text-center text-gray-500 text-sm">
                إذا كنت تعتقد أن هناك خطأ ما، يرجى 
                <a href="{{ route('contact-us') }}" class="text-blue-600 hover:underline">
                    التواصل مع فريق الدعم
                </a>
            </div>
        </div>
    </div>

    <!-- Simple notification script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.minimalNotify) {
                window.minimalNotify.error('الصفحة التي تبحث عنها غير متوفرة');
            }
        });
    </script>
</body>
</html>