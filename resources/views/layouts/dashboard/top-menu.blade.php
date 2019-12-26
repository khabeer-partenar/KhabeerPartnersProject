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
        
        <a href="{{ route('logout') }}" class="login">تسجيل الخروج</a>
        <a href="#!" class="login">مرحباً : {{ auth()->user()->name }} </a>

        <span class="clr"></span>
    
    </div>

</nav>


<span class="clr"></span>