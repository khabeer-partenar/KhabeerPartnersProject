<header>
    
    <a class="logo" href="{{ url('/') }}" title="الرئيسية"><img src="{{ asset('assets/images/logo.png') }}"></a>
    
    <ul>
        <li><a href="#!" title="خريطة الموقع"><i class="fa fa-sitemap"></i></a></li>
        <li><a href="#!" title="اتصل بنا"><i class="fa fa-envelope"></i></a></li>
    </ul>
    
    <span class="date">{{ $currentDate }}</span>
    <span class="clr"></span>
</header>

<nav>
    
    <div class="t_menu">
        
        <ul id="menu">
            @foreach($authorizedApps as $app)
                <li>
                    <a href="javascript:;">{{ $app->name }}</a>
                    <ul class="dropdown">
                        @foreach($app->menuChildrenRecursive as $subApp)
                            <li>
                                <a href="{{ url($subApp->frontend_path) }}">{{ $subApp->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
                
        <ul id="menu" style="float: left;">
            <li>
                <a href="javascript:;">مرحباً : {{ auth()->user()->name }} </a>
                <ul class="dropdown">
                    <li>
                        <a href="{{ route('account.edit') }}">الملف الشخصي</a>
                    </li>
                    <li>
                        <a href="{{ route('support.create') }}">طلب دعم</a>
                    </li>
                    <li>
                        <a href="{{ route('account.logout') }}">تسجيل الخروج</a>
                    </li>
                </ul>
            </li>
        </ul>

        <span class="clr"></span>
    
    </div>

</nav>


<span class="clr"></span>