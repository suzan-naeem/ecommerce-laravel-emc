
<!-- Navigation Bar-->
<header id="topnav">
    <div class="topbar-main">
        <div class="container">

            <!-- Logo container-->
            <div class="logo">
                <a href="{{ route('dashboard.home') }}"  class="logo">
                    <span>@lang('dashboard.eco')</span>
                </a>
            </div>
        </div>
    </div>

    <div class="navbar-custom">
        <div class="container">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li class="has-submenu">
                        <a href="{{ route('dashboard.index') }}"><i class="fa fa-home"></i>@lang('dashboard.home')</a>
                    </li>

                    <li id="itemSlider" class="has-submenu">
                        <a href="#"><i class="fa fa-picture-o"></i>@lang('dashboard.sliders')</a>
                        <ul class="submenu">
                            <li><a href="{{ route('sliders.index') }}">@lang('dashboard.viewAll')</a></li>
                            <li><a href="{{ route('sliders.create') }}">@lang('dashboard.addImage')</a></li>
                        </ul>
                    </li>
                    

                    <li><a href="{{ route('lang', app()->getLocale() == 'en' ? 'ar' : 'en') }}"><i class="md md-language"></i> <span style="color: black;">@lang('dashboard.lang')</span></a></li>
                   
                    <li class="has-submenu">
                          <a href="logout" onclick="logout(event)"><i class="md md-swap-vert"></i>@lang('dashboard.logout')</a>  
                    </li>
                </ul>
                <!-- End navigation menu -->
            </div>
        </div> <!-- end container -->
    </div> <!-- end navbar-custom -->
    <form id="logout" method="POST" action="{{ route('dashboard.logout') }}">
        @csrf
    </form>
</header>
<!-- End Navigation Bar-->

