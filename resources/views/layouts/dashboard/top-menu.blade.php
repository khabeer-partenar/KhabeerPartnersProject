<div class="top-menu">
    
    <ul class="nav navbar-nav pull-right">
        
        <!-- BEGIN USER LOGIN DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <li class="dropdown dropdown-user">
        
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <img alt="" class="img-circle" src="" />
                <span class="username username-hide-on-mobile"> {{ auth()->user()->name }}</span>
                <i class="fa fa-angle-down"></i>
            </a>
            
            <ul class="dropdown-menu dropdown-menu-default">

                {{-- <li>
                    <a href="#">تجربة ١</a>
                </li>
                
                <li class="divider"></li> --}}

                <li>
                    <a href="{{ route('logout') }}">{{ __('messages.logout') }}</a>
                </li>
            
            </ul>
        
        </li>
    
    </ul>

</div>
    