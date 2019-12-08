<main>
    
    <div class="app_inner_pages_bg">
        
        <div class="container">
        
            <div class="clearfix"></div>
            <div class="inner_pages_main">

            <!-- BEGIN CONTENT BODY -->
            <div class="app_inner_pages_container clearfix">

                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <div class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</div>
                    @endif
                @endforeach

                @yield('page')

                <div class="clearfix"></div>

            </div>
            <!-- END CONTENT BODY -->
        
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            <a href="javascript:;" class="page-quick-sidebar-toggler">
                <i class="icon-login"></i>
            </a>

        </div>
    
    </div>

</main>