<div class="page-wrapper" id="vue-app">
    
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
    
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner">
        
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <br />
                <a href="{{ url('/') }}">{{ __('messages.title') }}</a>
                <div id="menu-toggler-sidebar-btn" class="menu-toggler sidebar-toggler">
                    <span></span>
                </div>
            </div>
            <!-- END LOGO -->
            
            <!-- BEGIN TOP NAVIGATION MENU -->
            @include('layouts.dashboard.top-menu')
            <!-- END TOP NAVIGATION MENU -->
        
        </div>
        <!-- END HEADER INNER -->
    
    </div>
    <!-- END HEADER -->

    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"></div>
    
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
            
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">

            <!-- BEGIN SIDEBAR -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <div class="page-sidebar navbar-collapse collapse">
                <side-menu-wrapper></side-menu-wrapper>
            </div>
            <!-- END SIDEBAR -->
        </div>

        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">

                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <div class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</div>
                    @endif
                @endforeach
                
                @yield('page')
                
                <div class="clearfix"></div>
                <!-- END DASHBOARD STATS 1-->

            </div>
            <!-- END CONTENT BODY -->

        </div>
        
        <!-- END CONTENT -->
        <!-- BEGIN QUICK SIDEBAR -->
        <a href="javascript:;" class="page-quick-sidebar-toggler">
            <i class="icon-login"></i>
        </a>

        <!-- END QUICK SIDEBAR -->
    
    </div>
    <!-- END CONTAINER -->
    
    <!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="page-footer-inner">
            <a target="_blank" href=""></a> &nbsp;|&nbsp;
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- END FOOTER -->

</div>
