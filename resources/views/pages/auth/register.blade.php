<!DOCTYPE html>
    <html lang="ar" dir="rtl">

    <head dir="rtl">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>hdmarketing</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Configure Tailwind -->
        <x-imports.index />
        <x-scripts.index />

    </head>
    <body class=" overflow-x-hidden relative">
        <x-auth.cta title="صفحة التسجيل" message="انضم إلى منصتنا وابدأ بجني الأرباح الآن!" />
        <x-auth.hero header="" paragraph="سجّل الآن في منصتنا وابدأ رحلتك في تحقيق الدخل الإضافي من خلال نظام التسويق بالعمولة بنظام الدفع عند الاستلام (COD). منصتنا توفر لك فرصة الترويج لمجموعة متنوعة من المنتجات وكسب عمولات مجزية بكل سهولة." />
        <x-ui.divider />
        <x-auth.register-form  :pwvisible="true" />
        <x-auth.back-to-home />
        <x-auth.toggle-pw-icon />
        <x-scripts.nav-script />
    </body>
</html>

