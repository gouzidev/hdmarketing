<form
    class="flex flex-col items-center w-9/12 mx-auto mb-20"
    action="{{ route('/register') }}" method="POST">

    <div class="w-full mb-20">
        <input class="border-b-2 py-2 border-[#555] w-full  text-right outline-none focus:outline-none" name="name"  placeholder="* اسم المستخدم" required/>
    </div>
    <div class="w-full mb-20">
        <input class="border-b-2 py-2 border-[#555] w-full  text-right outline-none focus:outline-none" name="email" type="email" placeholder="* البريد الإلكتروني" required/>
    </div>
    <div class="w-full mb-20">
        <input class="border-b-2 py-2 border-[#555] w-full  text-right outline-none focus:outline-none" name="password"  placeholder="* كلمة المرور" required/>
    </div>
    <div class="w-full mb-20">
        <input class="border-b-2 py-2 border-[#555] w-full  text-right outline-none focus:outline-none" name="confirm"  placeholder="* تأكيد كلمة المرور" required/>
    </div>
    <div class="w-full mb-20">
        <input class="border-b-2 py-2 border-[#555] w-full  text-right outline-none focus:outline-none" name="phone" placeholder="* رقم الهاتف" required/>
    </div>
    <div class="w-full mb-20">
        <input class="border-b-2 py-2 border-[#555] w-full  text-right outline-none focus:outline-none" name="password"  placeholder="المدينة" required/>
    </div>
    <div class="w-full mb-20">
        <select class="bg-transparent border-b-2 border-[#555] w-full text-right outline-none focus:outline-none text-gray" name="country" dir="rtl" required>
            <option disabled value="">البلد</option>
            <option value="LY">ليبيا</option>
            <option value="TN">تونس</option>
            <option value="DZ">الجزائر</option>
            <option value="MR">موريتانيا</option>
            <option value="EG">مصر</option>
            <option value="MA">المغرب</option>
            <option value="JO">الأردن</option>
            <option value="KW">الكويت</option>
            <option value="BH">البحرين</option>
            <option value="QA">قطر</option>
            <option value="OM">عمان</option>
            <option value="LB">لبنان</option>
            <option value="SD">السودان</option>
            <option value="IQ">العراق</option>
            <option value="YE">اليمن</option>
            <option value="SY">سوريا</option>
            <option value="PS">فلسطين</option>
            <option value="SO">الصومال</option>
            <option value="DJ">جيبوتي</option>
            <option value="KM">جزر القمر</option>
            <option value="SA">المملكة العربية السعودية</option>
            <option value="AE">الإمارات العربية المتحدة</option>
            <option value="">غير محدد</option>
        </select>
    </div>
    <button class="bg-[#0292cf] text-white items-end self-end px-3 py-2 rounded">تسجيل</button>
    <div class="text-red-700 self-start opacity-70">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</form>