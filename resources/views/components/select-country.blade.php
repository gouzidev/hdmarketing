<select class="bg-transparent border-b-2 border-[#555] w-full text-right outline-none focus:outline-none text-gray" name="country" dir="rtl" required>
    <option disabled value="">البلد</option>
    <option @if ($country == "LY") selected @endif value="LY">ليبيا</option>
    <option @if ($country == "TN") selected @endif value="TN">تونس</option>
    <option @if ($country == "DZ") selected @endif value="DZ">الجزائر</option>
    <option @if ($country == "MR") selected @endif value="MR">موريتانيا</option>
    <option @if ($country == "EG") selected @endif value="EG">مصر</option>
    <option @if ($country == "MA") selected @endif value="MA">المغرب</option>
    <option @if ($country == "JO") selected @endif value="JO">الأردن</option>
    <option @if ($country == "KW") selected @endif value="KW">الكويت</option>
    <option @if ($country == "BH") selected @endif value="BH">البحرين</option>
    <option @if ($country == "QA") selected @endif value="QA">قطر</option>
    <option @if ($country == "OM") selected @endif value="OM">عمان</option>
    <option @if ($country == "LB") selected @endif value="LB">لبنان</option>
    <option @if ($country == "SD") selected @endif value="SD">السودان</option>
    <option @if ($country == "IQ") selected @endif value="IQ">العراق</option>
    <option @if ($country == "YE") selected @endif value="YE">اليمن</option>
    <option @if ($country == "SY") selected @endif value="SY">سوريا</option>
    <option @if ($country == "PS") selected @endif value="PS">فلسطين</option>
    <option @if ($country == "SO") selected @endif value="SO">الصومال</option>
    <option @if ($country == "DJ") selected @endif value="DJ">جيبوتي</option>
    <option @if ($country == "KM") selected @endif value="KM">جزر القمر</option>
    <option @if ($country == "SA") selected @endif value="SA">المملكة العربية السعودية</option>
    <option @if ($country == "AE") selected @endif value="AE">الإمارات العربية المتحدة</option>
    <option @if ($country == "") selected @endif value="">غير محدد</option>
</select>