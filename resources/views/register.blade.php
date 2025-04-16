<!DOCTYPE html>
<<<<<<< HEAD
    <html lang="ar" dir="rtl">

=======
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
>>>>>>> 6247367bf80c05edaa1fd52f1e955bbfe9dbbb3c
    <head dir="rtl">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>hdmarketing</title>
        
        <script src="https://cdn.tailwindcss.com"></script>
<<<<<<< HEAD
=======
    
>>>>>>> 6247367bf80c05edaa1fd52f1e955bbfe9dbbb3c
        <!-- Configure Tailwind -->
        <x-tailwind-script />
        <x-fonts-import />

        </head>
    <body class=" overflow-x-hidden relative">
        <x-auth.cta title="صفحة التسجيل" message="انضم إلى منصتنا وابدأ بجني الأرباح الآن!" />
        <x-auth.hero header="هل تريد كسب المال من خلال التسويق بالعمولة؟" paragraph="سجّل الآن في منصتنا وابدأ رحلتك في تحقيق الدخل الإضافي من خلال نظام التسويق بالعمولة بنظام الدفع عند الاستلام (COD). منصتنا توفر لك فرصة الترويج لمجموعة متنوعة من المنتجات وكسب عمولات مجزية بكل سهولة." />
        <x-ui.divider />
        <x-auth.register-form />
        <x-back-to-home />
    </body>
</html>

