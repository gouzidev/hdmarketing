<select class="w-full pl-10 pr-10 py-2 bg-transparent text-slate-600 text-lg border border-slate-200 rounded-md 
        transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 
        shadow-sm focus:shadow appearance-none rtl" name="country" dir="rtl" required>
    <option disabled value="">البلد</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "LY") selected @endif value="LY">ليبيا</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "TN") selected @endif value="TN">تونس</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "DZ") selected @endif value="DZ">الجزائر</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "MR") selected @endif value="MR">موريتانيا</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "EG") selected @endif value="EG">مصر</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "MA") selected @endif value="MA">المغرب</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "JO") selected @endif value="JO">الأردن</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "KW") selected @endif value="KW">الكويت</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "BH") selected @endif value="BH">البحرين</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "QA") selected @endif value="QA">قطر</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "OM") selected @endif value="OM">عمان</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "LB") selected @endif value="LB">لبنان</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "SD") selected @endif value="SD">السودان</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "IQ") selected @endif value="IQ">العراق</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "YE") selected @endif value="YE">اليمن</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "SY") selected @endif value="SY">سوريا</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "PS") selected @endif value="PS">فلسطين</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "SO") selected @endif value="SO">الصومال</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "DJ") selected @endif value="DJ">جيبوتي</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "KM") selected @endif value="KM">جزر القمر</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "SA") selected @endif value="SA">المملكة العربية السعودية</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "AE") selected @endif value="AE">الإمارات العربية المتحدة</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "") selected @endif value="">غير محدد</option>
</select>