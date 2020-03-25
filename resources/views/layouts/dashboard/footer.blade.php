<footer>
    <div class="fmenu">
        <ul>

            <li>
                <a href="{{ url('/') }}" title="الرئيسية"><img src="{{ asset('assets/images/f_logo.png') }}"></a>
                جميع الحقوق محفوظة © {{ \App\Classes\Date\CarbonHijri::toHijriFromMiladi(\Carbon\Carbon::today(), 'Y')  }}-{{ \Carbon\Carbon::now()->year }}
            </li>

            <li class="flist">
                <a href="#!">شروط الاستخدام</a>
                <a href="#!">سياسة الخصوصية</a>
                <a href="#!">الأسئلة الشائعة</a>
                <a href="#!">خريطة الموقع</a>
            </li>

            <li class="flist">
                <a href="#!">تعريف بالهيئة</a>
                <a href="#!">تسجيل الموردين</a>
                <a href="#!">تسجيل المستخدمين</a>
                <a href="#!">اتصل بنا</a>
            </li>

            <li class="newsletter">
                <strong>القائمة البريدية</strong>
                <span>اشترك معنا في القائمة البريدية ليصلك جديدنا ...</span>
                <input type="text" value="البريد الإلكتروني ..." onclick="if (this.value == 'البريد الإلكتروني ...') { this.value = '' }" onblur=" if (this.value == '' ) { this.value='البريد الإلكتروني ...' }" />
                <input type="button" value="اشترك" title="اضغط للاشتراك" />
            </li>
        
        </ul>
        
        <span class="clr"></span>
        
    </div>
    
    <div class="bottom_bar">
        <div>
            <a href="#" class="scrollup" title="أعلى الصفحة"><i class="fa fa-angle-double-up" style="color:white"></i></a>

            
            <span class="bb_left">
                <a href="#!" title="title"><img src="{{ asset('assets/images/bb_left_img_04.png') }}"></a>
                <a href="#!" title="title"><img src="{{ asset('assets/images/bb_left_img_03.png') }}"></a>
                <a href="#!" title="title"><img src="{{ asset('assets/images/bb_left_img_02.png') }}"></a>
                <a href="#!" title="title"><img src="{{ asset('assets/images/bb_left_img_01.png') }}"></a>
            </span>
            
            <span class="clr"></span>
        
        </div>
    </div>
                        
</footer>