<!DOCTYPE html>
    <html lang="ar" dir="rtl">
    <head dir="rtl">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>hdmarketing</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <x-scripts.fonts-import />
        <x-scripts.index />

    </head>
    <body class=" overflow-x-hidden relative">
        <x-auth.cta title="حسابي - صفحة تسجيل الدخول" message="" />
        <x-auth.hero header="هل تريد كسب المال من خلال التسويق بالعمولة؟" paragraph="مرحبًا بك! يرجى تسجيل الدخول للوصول إلى حسابك والاستفادة من جميع مميزات منصتنا." />
        <x-ui.divider />
        <x-auth.login-form  :pwvisible="true" />
        <x-auth.back-to-home />
        <x-auth.toggle-pw-icon />
        <x-scripts.nav-script />
    </body>
</html>
