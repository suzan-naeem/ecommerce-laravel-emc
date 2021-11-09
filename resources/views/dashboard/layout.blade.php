<!DOCTYPE html>
<html>
<head>
    @include('dashboard.layouts.heads')
    @stack('custom-css')
</head>
<body @if(app()->isLocale('ar')) dir="rtl" @endif>
    @include('dashboard.layouts.leftSidebar')
    @yield('content')
    @include('dashboard.layouts.footer_text')
    @include('dashboard.layouts.footer')
    @stack('custom-scripts')
</body>
</html>
