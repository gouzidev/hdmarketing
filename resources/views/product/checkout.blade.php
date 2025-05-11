<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إتمام الطلب - {{ $product->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-gray-100">
    <x-nav :isHome='false'/>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Title -->
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">إتمام الطلب</h2>
            <p class="text-gray-600 mt-2">أنت على بعد خطوات قليلة من الحصول على منتجك</p>
        </div>
        
        <!-- Progress Steps -->
        <div class="flex justify-center mb-12 [counter-reset:step]">
            <div class="flex items-center font-medium text-green-600 before:[counter-increment:step] before:flex before:items-center before:justify-center before:w-10 before:h-10 before:rounded-full before:bg-green-100 before:text-green-800 before:font-bold before:ml-2 before:content-[counter(step)] before:shadow-sm">
                <span class="text-sm md:text-base">المعلومات</span>
            </div>
            <div class="mx-4 flex items-center text-gray-400">
                <i class="fas fa-chevron-left"></i>
            </div>
            
            <div class="flex items-center text-gray-500 before:[counter-increment:step] before:flex before:items-center before:justify-center before:w-10 before:h-10 before:rounded-full before:bg-gray-200 before:text-gray-600 before:font-bold before:ml-2 before:content-[counter(step)] before:shadow-sm">
                <span class="text-sm md:text-base">التأكيد</span>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Product Summary -->
            <div class="md:col-span-1 order-2 md:order-1">
                <div class="bg-white shadow rounded-lg overflow-hidden sticky top-4 border border-gray-200">
                    <div class="p-6 border-b border-gray-200 bg-gradient-to-l from-yellow-50 to-white">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center">
                            <i class="fas fa-shopping-cart text-yellow-600 ml-2"></i>
                            ملخص المنتج
                        </h3>
                    </div>
                    
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-24 w-24 rounded-md overflow-hidden bg-gray-100 border border-gray-200 shadow-sm">
                                @if($product->primary_image)
                                    <img src="{{ route('products.thumbnail', $product) }}" 
                                        alt="{{ $product->name }}" 
                                        class="w-full h-full object-cover">
                                @else
                                    <img src="{{ route('products.images.default') }}" 
                                        alt="{{ $product->name }}" 
                                        class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="mr-4 flex-1">
                                <h4 class="text-md font-bold text-gray-900">{{ $product->name }}</h4>
                                <p class="text-sm text-gray-500 flex items-center">
                                    <i class="fas fa-tag text-yellow-600 ml-1"></i>
                                    {{ $product->category }}
                                </p>
                                <div class="mt-3">
                                    <label class="text-sm font-medium text-gray-700 mb-1 block">الكمية:</label>
                                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden shadow-sm w-28">
                                        <!-- Plus Button -->
                                        <button 
                                            type="button" 
                                            id="increment-btn"
                                            class="w-8 px-2 py-1 text-gray-600 hover:bg-gray-100 focus:outline-none transition-opacity duration-200 bg-gray-50"
                                            {{ $product->stock <= 1 ? 'disabled' : '' }}
                                        >
                                            <i class="fa-solid fa-plus text-green-700"></i>
                                        </button>
                                        
                                        <!-- Quantity Input -->
                                        <input 
                                            type="number" 
                                            id="quantity-input"
                                            value="{{ $quantity }}" 
                                            min="1" 
                                            max="{{ $product->stock }}" 
                                            class="w-12 text-center border-0 focus:ring-0 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none bg-white"
                                        >
                                        
                                        <!-- Minus Button -->
                                        <button 
                                            type="button" 
                                            id="decrement-btn"
                                            class="w-8 px-2 py-1 text-gray-600 hover:bg-gray-100 focus:outline-none transition-opacity duration-200 opacity-50 cursor-not-allowed bg-gray-50"
                                            disabled
                                        >
                                            <i class="fa-solid fa-minus text-red-700"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="text-lg font-bold text-yellow-600">{{ number_format($product->price, 2) }} $</div>
                        </div>
                    </div>
                    
                    <div class="p-6 space-y-4 bg-gray-50">
                        <div class="flex justify-between items-center text-sm text-gray-600">
                            <span class="flex items-center">
                                <i class="fas fa-tag text-gray-500 ml-2"></i>
                                سعر المنتج الأصلي
                            </span>
                            <span class="font-medium">{{ number_format($product->price, 2) }} $</span>
                        </div>

                        <div class="border-b border-gray-200 pb-4">
                            <div class="flex justify-between items-center">
                                <label for="affiliate_price" class="flex items-center text-sm font-medium text-gray-700">
                                    <i class="fas fa-money-bill text-yellow-600 ml-2"></i>
                                    سعر البيع للعميل
                                </label>
                                <div class="relative mt-1 rounded-md shadow-sm w-24">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <span class="text-gray-500 sm:text-sm">$</span>
                                    </div>
                                    <input
                                     dir="rtl" type="number" 
                                           name="affiliate_price" 
                                           id="affiliate_price" 
                                           value="{{ number_format($product->price * 1.1, 2) }}"
                                           class="
                                           [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none 
                                                border-0 focus:ring-0
                                            font-medium
                                           block w-full rounded-md border-gray-300 pr-1 pl-2 active:outline-none focus:outline-none 
                                           transition hover:shadow-[0_0_4px_-1px_rgba(0,0,0,1)] py-1
                                           shadow-[0_0_3px_-1px_rgba(0,0,0,1)] focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm text-left"
                                    >
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2 mr-1">
                                <i class="fas fa-info-circle mr-1"></i>
                                يمكنك تعديل سعر البيع للعميل حسب رغبتك
                            </p>
                        </div>
                        
                        <div class="flex justify-between text-sm text-gray-600">
                            <span class="flex items-center">
                                <i class="fas fa-truck text-gray-500 ml-2"></i>
                                الشحن
                            </span>
                            <span class="font-medium" id="shipping-price">0.00 $</span>
                        </div>
                        
                        <div class="flex justify-between pt-4 border-t border-gray-200 text-base font-bold">
                            <span class="text-gray-800">المجموع</span>
                            <span class="text-yellow-600" id="total-price">{{ number_format($product->price, 2) }} $</span>
                        </div>
                        
                        <div class="text-xs text-gray-500 text-center mt-2 pt-3 border-t border-gray-200">
                            <i class="fas fa-shield-alt ml-1"></i>
                            جميع المعاملات مؤمنة ومشفرة
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg overflow-hidden mt-4 border border-gray-200 p-4">

                    @if ($errors->any())
                        <div class="text-red-700 opacity-70 mb-5 text-right">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="mt-1">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif (session('success'))
                        <div class="w-full mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <h4 class="font-bold text-gray-700 flex items-center">
                        <i class="fas fa-headset text-yellow-600 ml-2"></i>
                        تحتاج للمساعدة؟
                    </h4>
                    <p class="text-sm text-gray-600 mt-2">
                        فريق خدمة العملاء جاهز للمساعدة في أي وقت
                    </p>
                    <div class="mt-3 flex items-center text-yellow-600 text-sm font-medium">
                        <i class="fas fa-phone-alt ml-1"></i>
                        <span>اتصل بنا: 123-456-7890</span>
                    </div>
                </div>
            </div>
            
            <!-- Checkout Form -->
            <div class="md:col-span-2 order-1 md:order-2">
                <div class="bg-white shadow rounded-lg overflow-hidden border border-gray-200">
                    <div class="p-6 border-b border-gray-200 bg-gradient-to-l from-yellow-50 to-white">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center">
                            <i class="fas fa-user text-yellow-600 ml-2"></i>
                            معلومات المشتري
                        </h3>
                    </div>
                    
                    <form class="p-6" action="{{ route('products.product.checkout-process', $product) }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1" id="form-quantity">
                        <input type="hidden" name="total_price" value="{{ $product->price }}" id="form-total-price">
                        <input type="hidden" name="affiliate_price" value="" id="form-affiliate_price">
                        <input type="hidden" name="shipping_id" value="" id="form-shipping-id">
                        
                        <!-- Contact Information -->
                        <div class="mb-8">
                            <h4 class="text-md font-bold text-gray-800 mb-4 flex items-center">
                                <span class="inline-flex items-center justify-center bg-yellow-100 rounded-full w-6 h-6 text-sm text-yellow-800 font-bold ml-2">1</span>
                                معلومات التواصل
                            </h4>
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 shadow-sm">
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    <div>
                                        <label for="name" class="text-sm font-medium text-gray-700 mb-1 flex items-center">
                                            <i class="fas fa-user text-gray-400 ml-1"></i>
                                            الاسم الكامل
                                        </label>
                                        <input type="text" id="name" name="name" required 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                                    </div>
                                    <div>
                                        <label for="email" class="text-sm font-medium text-gray-700 mb-1 flex items-center">
                                            <i class="fas fa-envelope text-gray-400 ml-1"></i>
                                            البريد الإلكتروني
                                        </label>
                                        <input type="email" id="email" name="email" required 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                                    </div>
                                    <div>
                                        <label for="phone" class="text-sm font-medium text-gray-700 mb-1 flex items-center">
                                            <i class="fas fa-phone text-gray-400 ml-1"></i>
                                            رقم الهاتف
                                        </label>
                                        <input type="tel" id="phone" name="phone" required 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Shipping Address -->
                        <div class="mb-8">
                            <h4 class="text-md font-bold text-gray-800 mb-4 flex items-center">
                                <span class="inline-flex items-center justify-center bg-yellow-100 rounded-full w-6 h-6 text-sm text-yellow-800 font-bold ml-2">2</span>
                                عنوان الشحن
                            </h4>
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 shadow-sm">
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    <!-- Custom Shipping Selector -->
                                    <div class="sm:col-span-2">
                                        <label class="text-sm font-medium text-gray-700 mb-1 flex items-center">
                                            <i class="fas fa-truck text-gray-400 ml-1"></i>
                                            اختر منطقة الشحن
                                        </label>
                                        <div class="relative">
                                            <button type="button" id="shipping-selector-btn" class="relative w-full bg-white border border-gray-300 rounded-lg shadow-sm pl-3 pr-5 py-2 text-right cursor-default focus:outline-none focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500">
                                                <span id="selected-shipping-text" class="block truncate text-gray-500">اختر منطقة الشحن...</span>
                                                <span class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
                                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                                </span>
                                            </button>
                                            
                                            <!-- Shipping Options Dropdown -->
                                            <div id="shipping-options" class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm hidden">
                                                @foreach($shippings as $shipping)
                                                <div data-id="{{ $shipping->id }}" 
                                                     data-country="{{ $shipping->country }}" 
                                                     data-city="{{ $shipping->city }}" 
                                                     data-street="{{ $shipping->street }}"
                                                     data-price="{{ $shipping->price }}"
                                                     class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-4 hover:bg-yellow-50">
                                                    <div class="flex items-center">
                                                        <span class="font-medium block truncate">{{ $shipping->city }}, {{ $shipping->country }}</span>
                                                        <span class="text-xs text-gray-500 mr-1">{{ $shipping->street }}</span>
                                                    </div>
                                                    <span class="text-yellow-600 font-medium absolute inset-y-0 left-0 flex items-center pl-3">
                                                        {{ number_format($shipping->price) }} $
                                                    </span>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="sm:col-span-2">
                                        <label for="address" class="text-sm font-medium text-gray-700 mb-1 flex items-center">
                                            <i class="fas fa-map-marker-alt text-gray-400 ml-1"></i>
                                            العنوان التفصيلي
                                        </label>
                                        <input type="text" id="address" name="address" required 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                                    </div>
                                    
                                    <!-- Read-only fields filled from shipping selection -->
                                    <div>
                                        <label class="text-sm font-medium text-gray-700 mb-1 flex items-center">
                                            <i class="fas fa-globe text-gray-400 ml-1"></i>
                                            البلد
                                        </label>
                                        <input type="text" id="country-display" readonly
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm bg-gray-50 cursor-not-allowed">
                                        <input type="hidden" id="country" name="country">
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-700 mb-1 flex items-center">
                                            <i class="fas fa-city text-gray-400 ml-1"></i>
                                            المدينة
                                        </label>
                                        <input type="text" id="city-display" readonly
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm bg-gray-50 cursor-not-allowed">
                                        <input type="hidden" id="city" name="city">
                                    </div>

                                    <div>
                                        <label class="text-sm font-medium text-gray-700 mb-1 flex items-center">
                                            <i class="fas fa-city text-gray-400 ml-1"></i>
                                            الشارع
                                        </label>
                                        <input type="text" id="street-display" readonly
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm bg-gray-50 cursor-not-allowed">
                                        <input type="hidden" id="street" name="street">
                                    </div>

                                    <div>
                                        <label for="postal_code" class="text-sm font-medium text-gray-700 mb-1 flex items-center">
                                            <i class="fas fa-mail-bulk text-gray-400 ml-1"></i>
                                            الرمز البريدي
                                        </label>
                                        <input type="text" id="postal_code" name="postal_code" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Payment Method -->
                        <div class="mb-8">
                            <h4 class="text-md font-bold text-gray-800 mb-4 flex items-center">
                                <span class="inline-flex items-center justify-center bg-yellow-100 rounded-full w-6 h-6 text-sm text-yellow-800 font-bold ml-2">3</span>
                                طريقة الدفع
                            </h4>
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 shadow-sm">
                                <div class="space-y-3">
                                    <div class="flex items-center p-3 border border-gray-200 rounded-lg bg-white hover:bg-yellow-50 transition-colors cursor-pointer">
                                        <input id="cash_on_delivery" name="payment_method" type="radio" value="cash_on_delivery" checked disabled
                                            class="focus:ring-yellow-500 h-4 w-4 text-yellow-600 border-gray-300">
                                        <label for="cash_on_delivery" class="mr-3 text-sm font-medium text-gray-700 flex items-center">
                                            <i class="fas fa-money-bill-wave text-green-600 ml-2 text-lg"></i>
                                            الدفع عند الاستلام
                                            <span class="mr-auto text-xs text-green-600 font-normal">
                                                (الخيار الأكثر شيوعاً)
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Terms and Conditions -->
                        <div class="flex items-start mb-6 bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                            <div class="flex items-center h-5">
                                <input id="terms" name="terms" type="checkbox" required 
                                    class="focus:ring-yellow-500 h-5 w-5 text-yellow-600 border-gray-300 rounded">
                            </div>
                            <div class="mr-3 text-sm">
                                <label for="terms" class="font-medium text-gray-700">أوافق على <a href="#" class="text-yellow-600 hover:text-yellow-700 underline">الشروط والأحكام</a> وسياسة الخصوصية</label>
                                <p class="text-gray-500 mt-1">بالضغط على "تأكيد الطلب" أنت توافق على شروط الشراء والبيع.</p>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <button type="submit" id="submit-button"
                            class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-4 px-4 rounded-lg font-bold flex items-center justify-center transition-colors duration-300 shadow-md">
                            <i class="fas fa-shopping-bag ml-2"></i>
                            تأكيد الطلب - <span id="button-price">{{ number_format($product->price, 2) }}</span> $
                        </button>
                        
                        <div class="mt-4 flex items-center justify-center text-gray-500 text-sm">
                            <i class="fas fa-lock ml-2"></i>
                            جميع البيانات مشفرة ومحمية
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('quantity-input');
        const incrementBtn = document.getElementById('increment-btn');
        const decrementBtn = document.getElementById('decrement-btn');
        const maxQuantity = parseInt(quantityInput.max);
        const formQuantity = document.getElementById('form-quantity');
        const formTotalPrice = document.getElementById('form-total-price');
        const formAffiliatePrice = document.getElementById('form-affiliate_price');
        const formShippingId = document.getElementById('form-shipping-id');
        const totalPriceDisplay = document.getElementById('total-price');
        const shippingPriceDisplay = document.getElementById('shipping-price');
        const buttonPriceDisplay = document.getElementById('button-price');
        const affiliatePriceInput = document.getElementById('affiliate_price');
        
        // Custom Shipping Selector
        const shippingSelectorBtn = document.getElementById('shipping-selector-btn');
        const shippingOptions = document.getElementById('shipping-options');
        const selectedShippingText = document.getElementById('selected-shipping-text');
        const shippingOptionItems = document.querySelectorAll('#shipping-options div[data-id]');
        const countryDisplay = document.getElementById('country-display');
        const cityDisplay = document.getElementById('city-display');
        const streetDisplay = document.getElementById('street-display');
        const countryInput = document.getElementById('country');
        const cityInput = document.getElementById('city');
        const streetInput = document.getElementById('street');
        
        // Initial values
        const basePrice = {{ $product->price }};
        let affiliatePrice = basePrice * 1.1; // Default 10% markup
        let shippingPrice = 0;
        
        // Toggle shipping options dropdown
        shippingSelectorBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            shippingOptions.classList.toggle('hidden');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            shippingOptions.classList.add('hidden');
        });
        
        // Handle shipping option selection
        shippingOptionItems.forEach(option => {
            option.addEventListener('click', function(e) {
                e.stopPropagation();
                
                const id = this.getAttribute('data-id');
                const country = this.getAttribute('data-country');
                const city = this.getAttribute('data-city');
                const street = this.getAttribute('data-street');
                const price = parseFloat(this.getAttribute('data-price'));
                
                // Update selected display
                selectedShippingText.textContent = `${city}, ${country}`;
                selectedShippingText.classList.remove('text-gray-500');
                selectedShippingText.classList.add('text-gray-900');
                
                // Update form fields
                countryDisplay.value = country;
                cityDisplay.value = city;
                streetDisplay.value = street;
                countryInput.value = country;
                cityInput.value = city;
                streetInput.value = street;
                formShippingId.value = id;
                
                // Update shipping price
                shippingPrice = price;
                shippingPriceDisplay.textContent = price.toFixed(2) + ' $';
                
                // Update total price
                updateTotalPrice();
                
                // Close dropdown
                shippingOptions.classList.add('hidden');
                
                // Highlight selected option
                shippingOptionItems.forEach(item => {
                    item.classList.remove('bg-yellow-100');
                });
                this.classList.add('bg-yellow-100');
            });
        });
        
        function updateButtons() {
            const currentValue = parseInt(quantityInput.value);
            
            // Update minus button
            decrementBtn.disabled = currentValue <= 1;
            decrementBtn.classList.toggle('opacity-50', currentValue <= 1);
            decrementBtn.classList.toggle('cursor-not-allowed', currentValue <= 1);
            
            // Update plus button
            incrementBtn.disabled = currentValue >= maxQuantity;
            incrementBtn.classList.toggle('opacity-50', currentValue >= maxQuantity);
            incrementBtn.classList.toggle('cursor-not-allowed', currentValue >= maxQuantity);
        }
        
        function updateTotalPrice() {
            const quantity = parseInt(quantityInput.value);
            const currentAffiliatePrice = parseFloat(affiliatePriceInput.value);
            
            // Update form values
            formAffiliatePrice.value = currentAffiliatePrice;
            formQuantity.value = quantity;
            
            // Calculate total price (quantity * affiliate price + shipping)
            const productTotal = quantity * currentAffiliatePrice;
            const totalPrice = productTotal + shippingPrice;
            
            // Update displays
            totalPriceDisplay.textContent = totalPrice.toFixed(2) + ' $';
            buttonPriceDisplay.textContent = totalPrice.toFixed(2);
            
            // Update hidden form value
            formTotalPrice.value = totalPrice;
        }

        // Initial setup
        updateButtons();
        updateTotalPrice();

        // Quantity button handlers
        incrementBtn.addEventListener('click', function() {
            if (parseInt(quantityInput.value) < maxQuantity) {
                quantityInput.value = parseInt(quantityInput.value) + 1;
                updateButtons();
                updateTotalPrice();
            }
        });

        decrementBtn.addEventListener('click', function() {
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
                updateButtons();
                updateTotalPrice();
            }
        });

        quantityInput.addEventListener('change', function() {
            if (this.value < 1) this.value = 1;
            if (this.value > maxQuantity) this.value = maxQuantity;
            updateButtons();
            updateTotalPrice();
        });
        
        // Affiliate price change handler
        affiliatePriceInput.addEventListener('change', function() {
            if (this.value < basePrice) this.value = basePrice;
            updateTotalPrice();
        });
        
        affiliatePriceInput.addEventListener('input', function() {
            updateTotalPrice();
        });
        
        // Form submission handler
        const form = document.querySelector('form');
        const submitButton = document.getElementById('submit-button');
        
        form.addEventListener('submit', function(e) {
            const termsChecked = document.getElementById('terms').checked;
            if (!termsChecked) {
                e.preventDefault();
                alert('الرجاء الموافقة على الشروط والأحكام قبل المتابعة');
            } else {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin ml-2"></i> جاري المعالجة...';
            }
        });
    });
    </script>
</body>
</html>