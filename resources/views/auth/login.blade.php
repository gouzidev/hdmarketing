<!DOCTYPE html>
    <html lang="ar" dir="rtl">
    <head dir="rtl">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>hdmarketing</title>
        
        <script src="https://cdn.tailwindcss.com"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <!-- Configure Tailwind -->
        <x-tailwind-script />
        <x-fonts-import />

        </head>
    <body class=" overflow-x-hidden relative">
        <x-auth.cta title="حسابي - صفحة تسجيل الدخول" message="" />
        <x-auth.hero header="هل تريد كسب المال من خلال التسويق بالعمولة؟" paragraph="مرحبًا بك! يرجى تسجيل الدخول للوصول إلى حسابك والاستفادة من جميع مميزات منصتنا." />
        <x-ui.divider />
        <x-auth.login-form  :pwvisible="true" />
        <x-back-to-home />
        <x-auth.toggle-pw-icon />
    </body>

</html>
