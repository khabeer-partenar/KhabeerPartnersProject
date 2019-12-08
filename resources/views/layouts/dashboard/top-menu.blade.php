<header>
    
    <a class="logo" href="{{ url('/') }}" title="الرئيسية"><img src="{{ asset('assets/images/logo.png') }}"></a>
    
    <ul>
        <li><a href="#!" title="خريطة الموقع"><i class="fas fa-sitemap"></i></a></li>
        <li><a href="#!" title="اتصل بنا"><i class="far fa-envelope"></i></a></li>
    </ul>
    
    <span class="date">16 ربيع الأول 1441 هـ الموافق 13 نوفمبر 2019 م</span> <span class="clr"></span>
</header>

<nav>
    
    <div class="t_menu">
        
        <top-menu-wrapper></top-menu-wrapper>
        
        <a href="#!" class="login">مرحباً : {{ auth()->user()->name }} </a>

        <span class="clr"></span>
    
    </div>

</nav>


<span class="clr"></span>