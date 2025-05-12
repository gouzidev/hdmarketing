<select class="w-full pl-10 pr-10 py-2 bg-transparent text-slate-600 text-lg border border-slate-200 rounded-md 
        transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 
        shadow-sm focus:shadow appearance-none rtl" name="country" dir="rtl" required>
    <option disabled value="">البلد</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "ly") selected @endif value="ly">ليبيا</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "tn") selected @endif value="tn">تونس</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "dz") selected @endif value="dz">الجزائر</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "mr") selected @endif value="mr">موريتانيا</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "eg") selected @endif value="eg">مصر</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "ma") selected @endif value="ma">المغرب</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "jo") selected @endif value="jo">الأردن</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "kw") selected @endif value="kw">الكويت</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "bh") selected @endif value="bh">البحرين</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "qa") selected @endif value="qa">قطر</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "om") selected @endif value="om">عمان</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "lb") selected @endif value="lb">لبنان</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "sd") selected @endif value="sd">السودان</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "iq") selected @endif value="iq">العراق</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "ye") selected @endif value="ye">اليمن</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "sy") selected @endif value="sy">سوريا</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "ps") selected @endif value="ps">فلسطين</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "so") selected @endif value="so">الصومال</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "dj") selected @endif value="dj">جيبوتي</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "km") selected @endif value="km">جزر القمر</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "sa") selected @endif value="sa">المملكة العربية السعودية</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "ae") selected @endif value="ae">الإمارات العربية المتحدة</option>
    <option
        class="bg-white text-slate-700 p-2 focus:checked:text-white focus:checked:bg-yellow-400 hover:bg-yellow-100"
         @if ($country == "") selected @endif value="">غير محدد</option>
</select>